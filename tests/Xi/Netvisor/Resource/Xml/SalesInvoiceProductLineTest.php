<?php

namespace Xi\Netvisor\Resource\Xml;

use Xi\Netvisor\Resource\Xml\SalesInvoiceProductLine;
use Xi\Netvisor\XmlTestCase;

class SalesInvoiceProductLineTest extends XmlTestCase
{
    /**
     * @var SalesInvoiceProductLine
     */
    private $invoiceProductLine;

    public function setUp()
    {
        parent::setUp();

        $this->invoiceProductLine = new SalesInvoiceProductLine(
            '100',
            'Product name, which is longer than the limit of 50 characters',
            array('amount' => '1,23', 'type' => 'net'),
            array('percentage' => '24', 'code' => 'KOMY'),
            '5'
        );
    }

    /**
     * @test
     */
    public function xmlHasRequiredProductLineValues()
    {
        $xml = $this->toXml($this->invoiceProductLine);

        $this->assertXmlContainsTagWithCDATAValue('productidentifier', '100', $xml);
        $this->assertXmlContainsTagWithAttributes('productidentifier', array('type' => 'netvisor'), $xml);

        $this->assertXmlContainsTagWithCDATAValue('productname', 'Product name, which is longer than the limit of 50', $xml);
        $this->assertNotContains('Product name, which is longer than the limit of 50 characters', $xml);

        $this->assertXmlContainsTagWithCDATAValue('productunitprice', '1,23', $xml);
        $this->assertXmlContainsTagWithAttributes('productunitprice', array('type' => 'net'), $xml);

        $this->assertXmlContainsTagWithCDATAValue('productvatpercentage', '24', $xml);
        $this->assertXmlContainsTagWithAttributes('productvatpercentage', array('vatcode' => 'KOMY'), $xml);

        $this->assertXmlContainsTagWithCDATAValue('salesinvoiceproductlinequantity', 5, $xml);
    }
}
