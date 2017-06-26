<?php

namespace Xi\Netvisor\Resource\Xml;

use JMS\Serializer\Annotation\XmlList;
use JMS\Serializer\Annotation\XmlRoot;
use JMS\Serializer\Annotation\Accessor;
use JMS\Serializer\Annotation\HandlerCallback;
// use JMS\Serializer\XmlSerializationVisitor;
use JMS\Serializer\XmlDeserializationVisitor;
use JMS\Serializer\Annotation as JMS;
use Xi\Netvisor\Resource\Xml\Component\Root;
use Xi\Netvisor\Resource\Xml\Component\AttributeElement;
use Xi\Netvisor\Resource\Xml\Component\WrapperElement;

/**
 * TODO: Should be kept immutable?
 */

/** @XmlRoot("SalesInvoice") */
class SalesInvoice extends Root
{
    /**
     * @JMS\Type("string")
     */
    private $SalesInvoiceNumber;
    /**
     * @JMS\Type("string")
     */
    private $SalesInvoiceDate;

    /**
     * @JMS\Type("Xi\Netvisor\Resource\Xml\Component\AttributeElement")
     */
    private $SalesInvoiceDeliveryDate; //Attribuutti format  
    /**
     * @JMS\Type("Xi\Netvisor\Resource\Xml\Component\AttributeElement")
     */
    private $SalesInvoiceDueDate; // Attribuutti format 
    /**
     * @JMS\Type("string")
     */
    private $SalesInvoiceReferencenumber;
    /**
     * @JMS\Type("string")
     */
    private $SalesInvoiceAmount;
    /**
     * @JMS\Type("Xi\Netvisor\Resource\Xml\Component\AttributeElement")
     * @Accessor(getter="getSellerIdentifier",setter="setSellerIdentifier")
     */
    private $SellerIdentifier; // Attribuutti type
    /**
     * @JMS\Type("Xi\Netvisor\Resource\Xml\Component\AttributeElement")
     * @Accessor(getter="getSalesInvoiceStatus",setter="setSalesInvoiceStatus")
     */
    private $SalesInvoiceStatus;
    /**
     * @JMS\Type("string")
     */
    private $SalesInvoiceFreeTextBeforeLines;
    /**
     * @JMS\Type("string")
     */
    private $SalesInvoiceFreeTextAfterLines;
    /**
     * @JMS\Type("string")
     */
    private $SalesInvoiceOurReference;
    /**
     * @JMS\Type("string")
     */
    private $SalesInvoiceYourReference;
    /**
     * @JMS\Type("string")
     */
    private $SalesInvoicePrivateComment;
    /**
     * @JMS\Type("Xi\Netvisor\Resource\Xml\Component\AttributeElement")
     */
    private $InvoicingCustomerIdentifier;
    /**
     * @JMS\Type("string")
     */
    private $InvoicingCustomerName;
    /**
     * @JMS\Type("string")
     */
    private $InvoicingCustomerAddressline;
    /**
     * @JMS\Type("string")
     */
    private $InvoicingCustomerPostnumber;
    /**
     * @JMS\Type("string")
     */
    private $InvoicingCustomerTown;
    /**
     * @JMS\Type("string")
     */
    private $InvoicingCustomerCountryCode;
    /**
     * @JMS\Type("string")
     */
    private $MatchPartialPaymentsByDefault;
    /**
     * @JMS\Type("string")
     */
    private $DeliveryAddressName;
    /**
     * @JMS\Type("string")
     */
    private $DeliveryAddressLine;
    /**
     * @JMS\Type("string")
     */
    private $DeliveryAddressPostnumber;
    /**
     * @JMS\Type("string")
     */
    private $DeliveryAddressTown;
    /**
     * @JMS\Type("string")
     */
    private $DeliveryAddressCountryCode;
    /**
     * @JMS\Type("string")
     */
    private $DeliveryMethod;
    /**
     * @JMS\Type("string")
     */
    private $DeliveryTerm;
    /**
     * @JMS\Type("string")
     */
    private $PaymentTermNetDays;
    /**
     * @JMS\Type("string")
     */
    private $PaymentTermCashDiscountDays;
    /**
     * @JMS\Type("string")
     */
    private $PaymentTermCashDiscount; // Attribuutti type
    /**
     * @JMS\Type("string")
     */
    private $ExpectPartialPayments;
    /**
     * @JMS\Type("string")
     */
//    private $LastSentInvoicePDFBase64Data;

    /**
     * @JMS\Type("array<Xi\Netvisor\Resource\Xml\Component\WrapperElement>")
     * @XmlList(entry = "invoiceline")
     */
    public $InvoiceLines;

    /**
     * @XmlList(entry = "voucherline")
     */
    private $InvoiceVoucherLines;

    /**
     * @param \DateTime $salesInvoiceDate
     * @param string    $salesInvoiceAmount
     * @param string    $salesInvoiceStatus
     * @param string    $invoicingCustomerIdentifier
     * @param int       $paymentTermNetDays
     */
    public function __construct(
        \DateTime $salesInvoiceDate,
        $salesInvoiceAmount,
        $salesInvoiceStatus,
        $invoicingCustomerIdentifier,
        $paymentTermNetDays
    ) {
        $this->SalesInvoiceDate = $salesInvoiceDate->format('Y-m-d');
        $this->SalesInvoiceAmount = $salesInvoiceAmount;
        $this->SalesInvoiceStatus = new AttributeElement($salesInvoiceStatus, array('type' => 'netvisor'));
        $this->InvoicingCustomerIdentifier = new AttributeElement($invoicingCustomerIdentifier, array('type' => 'netvisor')); // TODO: Type can be netvisor/customer.
        $this->PaymentTermNetDays = $paymentTermNetDays;
    }

    /**
     * @param SalesInvoiceProductLine $line
     */
    public function addSalesInvoiceProductLine(SalesInvoiceProductLine $line)
    {
        $this->InvoiceLines[] = new WrapperElement('salesinvoiceproductline', $line);
    }
    /**
     * @param VoucherLine $line
     */
    public function addVoucherLine(VoucherLine $line)
    {
        $this->InvoiceVoucherLines[] = $line;
    }

	/**
	 * @param string $salesinvoiceprivatecomment
	 */
	public function setSalesinvoiceprivatecomment($salesinvoiceprivatecomment) {
		$this->SalesInvoicePrivateComment = $salesinvoiceprivatecomment;
	}

	/**
	 * @param string $salesinvoiceyourreference
	 */
	public function setSalesinvoiceyourreference($SalesInvoiceYourReference) {
		$this->SalesInvoiceYourReference = $SalesInvoiceYourReference;
	}

	/**
	 * @param mixed $salesinvoicefreetextbeforelines
	 */
	public function setSalesinvoicefreetextbeforelines($salesinvoicefreetextbeforelines) {
		$this->SalesInvoiceFreeTextBeforeLines = $salesinvoicefreetextbeforelines;
	}

	/**
	 * @param mixed $salesinvoicefreetextbeforelines
	 */
	public function setSalesinvoicefreetextafterlines($salesinvoicefreetextafterlines) {
		$this->SalesInvoiceFreeTextAfterLines = $salesinvoicefreetextafterlines;
	}

    public function getDtdPath()
    {
        return $this->getDtdFile('salesinvoice.dtd');
    }

    protected function getXmlName()
    {
        return 'salesinvoice';
    }

    public function setSalesInvoiceNumber($salesInvoiceNumber){
        $this->SalesInvoiceNumber = $salesInvoiceNumber;
    }
    public function getSalesInvoiceNumber(){
        return $this->SalesInvoiceNumber;
    }
    public function getSalesInvoiceAmount(){
        return $this->SalesInvoiceAmount;
    }
    public function setSalesInvoiceAmount($amount){
        $this->SalesInvoiceAmount = $amount;
    }
    public function setSalesInvoiceDate($salesInvoiceDate){
        $this->SalesInvoiceDate = $salesInvoiceDate;
    }
    public function getSalesInvoiceDate()
    {
        return $this->SalesInvoiceDate;
    }
    public function setSalesInvoiceStatus($SalesInvoiceStatus){
        $this->SalesInvoiceStatus = new AttributeElement($SalesInvoiceStatus, array('type' => 'netvisor'));
    }
    public function getSalesInvoiceStatus(){
        return $this->SalesInvoiceStatus;
    }
    public function setSellerIdentifier($SellerIdentifier){
        $this->SellerIdentifier = new AttributeElement($SellerIdentifier, array('type' => 'netvisor'));
    }
    public function getSellerIdentifier(){
        return $this->SellerIdentifier;
    }
    // public function setSalesInvoiceDate($datestr){
    //     $date = date_create($datestr);
    //     $this->SalesInvoiceDate = new AttributeElement(date_format($date, 'Y-m-d'),array('format' => 'ansi'));
    // }
    public function setSalesInvoiceDeliveryDate($datestr){
        $date = date_create($datestr);
        $this->SalesInvoiceDeliveryDate = new AttributeElement(date_format($date, 'Y-m-d'),array('format' => 'ansi'));
    }
    public function setExpectPartialPayments($mode){
        $this->ExpectPartialPayments = $mode ? 1 : 0;
    }
    public function setSalesInvoiceDueDate($datestr){
        $date = date_create($datestr);
        $this->SalesInvoiceDueDate = new AttributeElement(date_format($date, 'Y-m-d'),array('format' => 'ansi'));
    }
    public function setInvoicingCustomerIdentifier($invoicingCustomerIdentifier){
        $this->InvoicingCustomerIdentifier = new AttributeElement($invoicingCustomerIdentifier, array('type' => 'netvisor'));
    }

    public function setInvoicingCustomerCountryCode($invoicingCustomerCountryCode){
        switch ($invoicingCustomerCountryCode) {
            case 'FINLAND':
                $code = 'FI';
                break;
            default:
                $code = 'FI';
                break;
        }
        $this->InvoicingCustomerCountryCode = new AttributeElement($code, array("type" => "ISO-3166"));
    }
    public function getSalesInvoiceLines(){
        return $this->InvoiceLines;
    }
    public function getVoucherLines(){
        return $this->InvoiceVoucherLines;
    }

    public function prepareForRefund($customer_id, $product_prefix = null, $increment = null){
        if($increment && $this->SalesInvoiceNumber){
            $this->SalesInvoiceNumber = (int)$this->SalesInvoiceNumber + $increment;
        }
        else{
            $this->SalesInvoiceNumber = null;
        }
        $this->SalesInvoiceReferencenumber = null;
        $this->setSalesInvoiceDeliveryDate(null);

        $invoiceamount = -floatval(str_replace(',', '.', $this->SalesInvoiceAmount));
        $this->SalesInvoiceAmount = $invoiceamount;
        $this->setInvoicingCustomerIdentifier($customer_id);
        $this->setSalesInvoiceDate(date('Y-m-d'));
        $this->setSalesInvoiceStatus('unsent');

        // todo should not rely on public property
        foreach ($this->InvoiceLines as &$invoiceline) {
            $invoiceline->value['salesinvoiceproductline']->setSalesInvoiceProductLineQuantity(
                -$invoiceline->value['salesinvoiceproductline']->getSalesInvoiceProductLineQuantity());
            if($product_prefix){
                $invoiceline->value['salesinvoiceproductline']->setProductName(
                    $product_prefix .' - '.$invoiceline->value['salesinvoiceproductline']->getProductName());
            }
        }
    }

    /**
     * @HandlerCallback("xml", direction = "deserialization")
     */
    public function deserializeToXml(XmlDeserializationVisitor $visitor, $xml){
        if((string)$xml->SalesInvoiceNumber){
            $this->setSalesInvoiceNumber( (string)$xml->SalesInvoiceNumber );
        }
        if((string)$xml->SalesInvoiceDate){
            $this->setSalesInvoiceDate((string)$xml->SalesInvoiceDate);
        }
        if((string)$xml->SalesInvoiceDeliveryDate){
            $this->setSalesInvoiceDeliveryDate((string)$xml->SalesInvoiceDeliveryDate);
        }
        // if((string)$xml->SalesInvoiceDueDate){
        //     $this->setSalesInvoiceDueDate((string)$xml->SalesInvoiceDueDate);
        // }
        if((string)$xml->SalesInvoiceReferencenumber){
            $this->SalesInvoiceReferencenumber     = (string)$xml->SalesInvoiceReferencenumber;
        }
        if((string)$xml->SalesInvoiceAmount){
            $this->SalesInvoiceAmount              = (string)$xml->SalesInvoiceAmount;
        }
        if(trim((string)$xml->SellerIdentifier)){
            $this->setSellerIdentifier((string)$xml->SellerIdentifier);
        }
        if((string)$xml->SalesInvoiceStatus){
            $this->setSalesInvoiceStatus((string)$xml->SalesInvoiceStatus);
        }
        if((string)$xml->InvoiceStatus){
            $this->setSalesInvoiceStatus((string)$xml->InvoiceStatus);
        }
        if((string)$xml->SalesInvoiceFreeTextBeforeLines){
            $this->SalesInvoiceFreeTextBeforeLines = (string)$xml->SalesInvoiceFreeTextBeforeLines;
        }
        if((string)$xml->SalesInvoiceFreeTextAfterLines){
            $this->SalesInvoiceFreeTextAfterLines  = (string)$xml->SalesInvoiceFreeTextAfterLines;
        }
        if((string)$xml->SalesInvoiceOurReference){
            $this->SalesInvoiceOurReference        = (string)$xml->SalesInvoiceOurReference;
        }
        if((string)$xml->SalesInvoiceYourReference){
            $this->SalesInvoiceYourReference       = (string)$xml->SalesInvoiceYourReference;
        }
        if((string)$xml->SalesInvoicePrivateComment){
            $this->SalesInvoicePrivateComment      = (string)$xml->SalesInvoicePrivateComment;
        }
        // if((string)$xml->InvoicingCustomerIdentifier){
        //     $this->setInvoicingCustomerIdentifier((string)$xml->InvoicingCustomerIdentifier);
        // }
        // if((string)$xml->InvoicingCustomerName){
        //     $this->InvoicingCustomerName           = (string)$xml->InvoicingCustomerName;
        // }
        // if((string)$xml->InvoicingCustomerAddressline){
        //     $this->InvoicingCustomerAddressline    = (string)$xml->InvoicingCustomerAddressline;
        // }
        // if((string)$xml->InvoicingCustomerPostnumber){
        //     $this->InvoicingCustomerPostnumber     = (string)$xml->InvoicingCustomerPostnumber;
        // }
        // if((string)$xml->InvoicingCustomerTown){
        //     $this->InvoicingCustomerTown           = (string)$xml->InvoicingCustomerTown;
        // }
        // if((string)$xml->InvoicingCustomerCountryCode){
        //     // $this->InvoicingCustomerCountryCode    = (string)$xml->InvoicingCustomerCountryCode;
        //     $this->setInvoicingCustomerCountryCode((string)$xml->InvoicingCustomerCountryCode);
        // }
        // if((string)$xml->MatchPartialPaymentsByDefault){
        //     $this->MatchPartialPaymentsByDefault   = (string)$xml->MatchPartialPaymentsByDefault;
        // }
        if((string)$xml->DeliveryAddressName){
            $this->DeliveryAddressName             = (string)$xml->DeliveryAddressName;
        }
        if((string)$xml->DeliveryAddressLine){
            $this->DeliveryAddressLine             = (string)$xml->DeliveryAddressLine;
        }
        if((string)$xml->DeliveryAddressPostnumber){
            $this->DeliveryAddressPostnumber       = (string)$xml->DeliveryAddressPostnumber;
        }
        if((string)$xml->DeliveryAddressTown){
            $this->DeliveryAddressTown             = (string)$xml->DeliveryAddressTown;
        }
        if((string)$xml->DeliveryAddressCountryCode){
            $this->DeliveryAddressCountryCode      = (string)$xml->DeliveryAddressCountryCode;
        }
        if((string)$xml->DeliveryMethod){
            $this->DeliveryMethod                  = (string)$xml->DeliveryMethod;
        }
        if((string)$xml->DeliveryTerm){
            $this->DeliveryTerm                    = (string)$xml->DeliveryTerm;
        }
        if((string)$xml->PaymentTermNetDays){
            $this->PaymentTermNetDays              = (string)$xml->PaymentTermNetDays;
        }
        if((string)$xml->PaymentTermCashDiscountDays){
            $this->PaymentTermCashDiscountDays     = (string)$xml->PaymentTermCashDiscountDays;
        }
        if((string)$xml->PaymentTermCashDiscount){
            $this->PaymentTermCashDiscount         = (string)$xml->PaymentTermCashDiscount; // Attribuutti type
        }
//        if((string)$xml->LastSentInvoicePDFBase64Data){
//            $this->LastSentInvoicePDFBase64Data    = (string)$xml->LastSentInvoicePDFBase64Data;
//        }

        foreach ($xml->InvoiceLines->InvoiceLine->SalesInvoiceProductLine as $invoiceLine) {
            $vatcode = preg_replace("/ /",'',(string)$invoiceLine->ProductVatPercentage->attributes()->vatcode);
            $invoiceProductLine = new SalesInvoiceProductLine(
                null, // todo: use valid product id
                (string)$invoiceLine->ProductName,
                array('amount' => (string)$invoiceLine->ProductUnitPrice, 'type' => 'gross'),
                array('percentage' => (string)$invoiceLine->ProductVatPercentage, 'code' => $vatcode),
                1);
            $invoiceProductLine->setProductLineFreetext((string)$invoiceLine->SalesInvoiceProductLineFreeText);

            $this->addSalesInvoiceProductLine($invoiceProductLine);
        }
    }
}
