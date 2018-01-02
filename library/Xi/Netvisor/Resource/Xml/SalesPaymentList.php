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
	private $NetvisorKey;
	/**
	 * @JMS\Type("string")
	 */
	private $Name;
	/**
	 * @JMS\Type("string")
	 */
	private $Date;
	/**
	 * @JMS\Type("string")
	 */
	private $Sum;
	/**
	 * @JMS\Type("string")
	 */
	private $ReferenceNumber;
	/**
	 * @JMS\Type("string")
	 */
	private $ForeignCurrencyAmount;
	/**
	 * @JMS\Type("string")
	 */
	private $InvoiceNumber;
	/**
	 * @JMS\Type("string")
	 */
	private $BankStatus;
	/**
	 * @JMS\Type("Xi\Netvisor\Resource\Xml\Component\AttributeElement")
	 */
	private $BankStatusErrorDescription;

	public function __construct() {
	}

	/**
	 * @return mixed
	 */
	public function getNetvisorKey()
	{
		return $this->NetvisorKey;
	}

	/**
	 * @return mixed
	 */
	public function getName()
	{
		return $this->Name;
	}

	/**
	 * @return mixed
	 */
	public function getDate()
	{
		return $this->Date;
	}

	/**
	 * @return mixed
	 */
	public function getSum()
	{
		return $this->Sum;
	}

	/**
	 * @return mixed
	 */
	public function getReferenceNumber()
	{
		return $this->ReferenceNumber;
	}

	/**
	 * @return mixed
	 */
	public function getForeignCurrencyAmount()
	{
		return $this->ForeignCurrencyAmount;
	}

	/**
	 * @return mixed
	 */
	public function getInvoiceNumber()
	{
		return $this->InvoiceNumber;
	}

	/**
	 * @return mixed
	 */
	public function getBankStatus()
	{
		return $this->BankStatus;
	}

	/**
	 * @return mixed
	 */
	public function getBankStatusErrorDescription()
	{
		return $this->BankStatusErrorDescription;
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
