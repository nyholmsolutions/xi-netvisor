<?php

namespace Xi\Netvisor\Resource\Xml;

use JMS\Serializer\Annotation as JMS;
use JMS\Serializer\Annotation\XmlRoot;

use Xi\Netvisor\Resource\Xml\Component\AttributeElement;

/** @XmlRoot("PaymentVoucherLine") */
class PaymentVoucherLine
{
    /**
     * @JMS\Type("Xi\Netvisor\Resource\Xml\Component\AttributeElement")
     */
    private $LineSum;
    /**
     * @JMS\Type("string")
     */
    public $Description;
    /**
     * @JMS\Type("string")
     */
    public $AccountNumber;
    /**
     * @JMS\Type("Xi\Netvisor\Resource\Xml\Component\AttributeElement")
     */
    public $VatPercent;


    public function __construct(){

    }

    public function setLineSum($linesum, $type){
        $this->LineSum = new AttributeElement($linesum, array('type' => $type));
    }
    public function setDescription($description){
        $this->Description = $description;
    }
    public function setAccountNumber($accountNumber){
        $this->AccountNumber = $accountNumber;
    }
    public function setVatPercent($vatPercent, $vatcode = 'KOMY'){
        $this->VatPercent = new AttributeElement($vatPercent, array('vatcode' => $vatcode));
    }

}
