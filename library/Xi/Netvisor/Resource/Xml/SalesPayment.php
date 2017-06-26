<?php

namespace Xi\Netvisor\Resource\Xml;

use JMS\Serializer\Annotation\XmlList;
use JMS\Serializer\XmlDeserializationVisitor;
use JMS\Serializer\Annotation\HandlerCallback;
use JMS\Serializer\Annotation as JMS;
use Xi\Netvisor\Resource\Xml\Component\Root;
use Xi\Netvisor\Resource\Xml\Component\AttributeElement;
use Xi\Netvisor\Resource\Xml\Component\WrapperElement;

class SalesPayment extends Root
{
	/**
	* @JMS\Type("Xi\Netvisor\Resource\Xml\Component\AttributeElement")
	*/
	private $Sum;

	/**
	* @JMS\Type("string")
	*/
	private $PaymentDate;

	/**
	* @JMS\Type("Xi\Netvisor\Resource\Xml\Component\AttributeElement")
	*/
	private $TargetIdentifier;

	/**
	* @JMS\Type("string")
	*/
	private $SourceName;

	/**
	* @JMS\Type("Xi\Netvisor\Resource\Xml\Component\AttributeElement")
	*/
	private $PaymentMethod;

    /**
     * @JMS\Type("array<Xi\Netvisor\Resource\Xml\Component\WrapperElement>")
     * @XmlList(entry = "voucherline")
     */
	private $salespaymentvoucherlines;

	public function __construct() {
	}

	public function getDtdPath(){
		return $this->getDtdFile('salespayment.dtd');
	}

	protected function getXmlName(){
		return 'salespayment';
	}

	public function setSum($sum, $currency = 'EUR'){
		$this->Sum = new AttributeElement($sum, array('currency' => $currency));
	}
	public function setPaymentDate($date){
		$this->PaymentDate = $date;
	}
	public function setTargetIdentifier($targetId, $type = 'netvisor', $targetType = 'invoice'){
		$this->TargetIdentifier = new AttributeElement($targetId, array('type' => $type, 'targettype' => $targetType));
	}
	public function setSourceName($name){
		$this->SourceName = $name;
	}
	public function setPaymentMethod($paymentMethod, $type = 'alternative', $OverrideAccountingAccountNumber = null, $OverrideSalesReceivableAccountNumber = null){
		$parameters = array('type' => $type);
		if($OverrideAccountingAccountNumber){
			$parameters['overrideaccountingaccountnumber'] = $OverrideAccountingAccountNumber;
		}
		if($OverrideSalesReceivableAccountNumber){
			$parameters['overridesalesreceivableaccountnumber'] = $OverrideSalesReceivableAccountNumber;
		}
		$this->PaymentMethod = new AttributeElement($paymentMethod, $parameters);
	}
    public function addVoucherLine(VoucherLine $line)
    {
        $this->salespaymentvoucherlines[] = $line;
    }
}
