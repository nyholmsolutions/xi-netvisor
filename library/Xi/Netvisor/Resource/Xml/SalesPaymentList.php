<?php

namespace Xi\Netvisor\Resource\Xml;

use JMS\Serializer\Annotation\XmlList;
use JMS\Serializer\XmlDeserializationVisitor;
use JMS\Serializer\Annotation\HandlerCallback;
use JMS\Serializer\Annotation as JMS;
use Xi\Netvisor\Resource\Xml\Component\Root;
use Xi\Netvisor\Resource\Xml\Component\AttributeElement;
use Xi\Netvisor\Resource\Xml\Component\WrapperElement;

class SalesPaymentList
{
	/**
	 * @JMS\Type("string")
	 */
	public $NetvisorKey; 
	/**
	 * @JMS\Type("string")
	 */
	public $Name; 
	/**
	 * @JMS\Type("string")
	 */
	public $Date; 
	/**
	 * @JMS\Type("string")
	 */
	public $Sum; 
	/**
	 * @JMS\Type("string")
	 */
	public $ReferenceNumber; 
	/**
	 * @JMS\Type("string")
	 */
	public $ForeignCurrencyAmount; 
	/**
	 * @JMS\Type("string")
	 */
	public $InvoiceNumber; 
	/**
	 * @JMS\Type("string")
	 */
	public $BankStatus; 
	/**
	 * @JMS\Type("Xi\Netvisor\Resource\Xml\Component\AttributeElement")
	 */
	public $BankStatusErrorDescription; 

	public function __construct() {
	}

	/**
	 * @HandlerCallback("xml", direction = "deserialization")
	 */
	public function deserializeToXml(XmlDeserializationVisitor $visitor, $xml){
		if((string)$xml->NetvisorKey){
			$this->NetvisorKey = (string)$xml->NetvisorKey;
		}
		if((string)$xml->Name){
			$this->Name = (string)$xml->Name;
		}
		if((string)$xml->Date){
			$this->Date = (string)$xml->Date;
		}
		if((string)$xml->Sum){
			$this->Sum = (string)$xml->Sum;
		}
		if((string)$xml->ReferenceNumber){
			$this->ReferenceNumber = (string)$xml->ReferenceNumber;
		}
		// if((string)$xml->ForeignCurrencyAmount){
		// 	$this->ForeignCurrencyAmount = (string)$xml->ForeignCurrencyAmount;
		// }
		if((string)$xml->InvoiceNumber){
			$this->InvoiceNumber = (string)$xml->InvoiceNumber;
		}
		if((string)$xml->BankStatus){
			$this->BankStatus = (string)$xml->BankStatus;
		}
	}
}
