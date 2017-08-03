<?php

namespace Xi\Netvisor\Resource\Xml;

use Xi\Netvisor\Resource\Xml\Component\AttributeElement;
use Xi\Netvisor\Resource\Xml\Component\WrapperElement;
use Xi\Netvisor\Resource\Xml\SalesInvoice;
use Xi\Netvisor\Resource\Xml\VoucherLine;
use Xi\Netvisor\XmlTestCase;

class SalesInvoiceTest extends XmlTestCase
{
    /**
     * @var SalesInvoice
     */
    private $invoice;

    public function setUp()
    {
        parent::setUp();

        $this->invoice = new SalesInvoice(
            \DateTime::createFromFormat('Y-m-d', '2014-01-20'),
            '5,00',
            'Open',
            '616',
            14
        );
    }

    /**
     * @test
     */
    public function hasDtd()
    {
        $this->assertNotNull($this->invoice->getDtdPath());
    }

    /**
     * @test
     */
    public function xmlHasRequiredSalesInvoiceValues()
    {
        $xml = $this->toXml($this->invoice->getSerializableObject());

        $this->assertXmlContainsTagWithCDATAValue('salesinvoicedate', '2014-01-20', $xml);
        $this->assertXmlContainsTagWithCDATAValue('salesinvoiceamount', '5,00', $xml);

        $this->assertXmlContainsTagWithCDATAValue('salesinvoicestatus', 'Open', $xml);
        $this->assertXmlContainsTagWithAttributes('salesinvoicestatus', array('type' => 'netvisor'), $xml);

        $this->assertXmlContainsTagWithCDATAValue('invoicingcustomeridentifier', '616', $xml);
        $this->assertXmlContainsTagWithAttributes('invoicingcustomeridentifier', array('type' => 'netvisor'), $xml);
    }

    /**
     * @test
     */
    public function xmlHasAddedSalesInvoiceProductLines()
    {
        $this->invoice->addSalesInvoiceProductLine(
            new SalesInvoiceProductLine('1', 'A', array('amount' => '1,00', 'type' => 'net'), array('percentage' => '24', 'code' => 'KOMY'), '1'));
        $this->invoice->addSalesInvoiceProductLine(
            new SalesInvoiceProductLine('2', 'B', array('amount' => '1,00', 'type' => 'gross'), array('percentage' => '24', 'code' => 'KOMY'), '1'));

        $xml = $this->toXml($this->invoice->getSerializableObject());

        $this->assertContains('invoicelines', $xml);
        $this->assertContains('invoiceline', $xml);
        $this->assertContains('salesinvoiceproductline', $xml);

        $this->assertXmlContainsTagWithCDATAValue('productidentifier', '1', $xml);
        $this->assertXmlContainsTagWithCDATAValue('productidentifier', '2', $xml);

        $this->assertTrue($this->validate->isValid($xml, $this->invoice->getDtdPath()));
    }

    /**
     * @test
     */
    public function xmlHasAddedSalesInvoiceVoucherLines()
    {
        $this->invoice->addSalesInvoiceProductLine(
            new SalesInvoiceProductLine('1', 'A', array('amount' => '1,00', 'type' => 'net'), array('percentage' => '24', 'code' => 'KOMY'), '1'));
        $this->invoice->addVoucherLine(new VoucherLine(
            array('amount' => -10, 'type' => 'net'),
            'Testvoucher',
            '3020',
            array('percentage' => '24', 'code' => 'KOMY'))
        );

        $this->invoice->addVoucherLine(new VoucherLine(
            array('amount' => 10, 'type' => 'net'),
            'Testvoucher 2',
            '3020',
            array('percentage' => '0', 'code' => 'NONE'))
        );

        $xml = $this->toXml($this->invoice->getSerializableObject());

        $this->assertContains('voucherlines', $xml);
        $this->assertContains('voucherline', $xml);

        $this->assertXmlContainsTagWithCDATAValue('accountnumber', '3020', $xml);
        $this->assertXmlContainsTagWithValue('linesum', 10, $xml);
        $this->assertXmlContainsTagWithValue('linesum', -10, $xml);
        $this->assertXmlContainsTagWithAttributes('productunitprice', array('type' => 'net'), $xml);

        $this->assertXmlContainsTagWithAttributes('vatpercent', array('vatcode' => 'KOMY'), $xml);
        $this->assertXmlContainsTagWithCDATAValue('vatpercent', '24', $xml);

        $this->assertXmlContainsTagWithAttributes('vatpercent', array('vatcode' => 'NONE'), $xml);
        $this->assertXmlContainsTagWithCDATAValue('vatpercent', '0', $xml);

        $this->assertTrue($this->validate->isValid($xml, $this->invoice->getDtdPath()));

    }


    /**
     * @test
     */
    public function prepareForRefund()
    {
        $this->invoice->setSalesInvoiceNumber(1010);
        $this->invoice->addSalesInvoiceProductLine(
            new SalesInvoiceProductLine('1', 'Testproduct 1', array('amount' => '1,00', 'type' => 'net'),
                array('percentage' => '24', 'code' => 'KOMY'), '3'));
        $this->invoice->addSalesInvoiceProductLine(
            new SalesInvoiceProductLine('1', 'Testproduct 2', array('amount' => '10,00', 'type' => 'net'),
                array('percentage' => '0', 'code' => 'NONE'), '1'));

        // @todo keep track of the original invoicelines in a cleaner way
        $unprepared = clone $this->invoice;
        $invoicelines_before = (array) clone ((object) $unprepared->getSalesInvoiceLines());

        $this->invoice->prepareForRefund(212);
        $invoicelines_after = $this->invoice->getSalesInvoiceLines();
        $this->assertTrue(count($invoicelines_before) == count($invoicelines_after));

        for($i = 0; $i < count($invoicelines_before); $i++){
            $this->assertTrue(
                $invoicelines_before[$i]->getValue()->getSalesInvoiceProductLineQuantity()
                - $invoicelines_after[$i]->getValue()->getSalesInvoiceProductLineQuantity() == 0);
        }

        $this->assertTrue($this->invoice->getSalesInvoiceNumber() != $unprepared->getSalesInvoiceNumber());
        $this->assertTrue($this->invoice->getSalesInvoiceAmount() + $unprepared->getSalesInvoiceAmount() == 0);

        $xml = $this->toXml($this->invoice->getSerializableObject());
        $this->assertTrue($this->validate->isValid($xml, $this->invoice->getDtdPath()));
    }
}
