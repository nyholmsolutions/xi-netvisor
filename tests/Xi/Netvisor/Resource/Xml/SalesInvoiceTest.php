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
}
