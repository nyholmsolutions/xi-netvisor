<?php

namespace Xi\Netvisor\Resource\Xml;

use Xi\Netvisor\Resource\Xml\Component\WrapperElement;
use Xi\Netvisor\Resource\Xml\Component\AttributeElement;
use JMS\Serializer\Annotation as JMS;

class CustomerBaseinformation
{
	/**
     * @JMS\Type("string")
     */
	private $internalidentifier;
	/**
     * @JMS\Type("string")
     */
	private $externalidentifier;
	/**
     * @JMS\Type("string")
     */
	private $name;
	/**
     * @JMS\Type("string")
     */
	private $nameextension;
	/**
     * @JMS\Type("string")
     */
	private $streetaddress;
	/**
     * @JMS\Type("string")
     */
	private $additionaladdressline;
	/**
     * @JMS\Type("string")
     */
	private $city;
	/**
     * @JMS\Type("string")
     */
	private $postnumber;
	/**
	 * @JMS\Type("Xi\Netvisor\Resource\Xml\Component\AttributeElement")
     */
	private $country;
	/**
     * @JMS\Type("string")
     */
	private $customergroupname;
	/**
     * @JMS\Type("string")
     */
	private $phonenumber;
	/**
     * @JMS\Type("string")
     */
	private $faxnumber;
	/**
     * @JMS\Type("string")
     */
	private $email;
	/**
     * @JMS\Type("string")
     */
	private $homepageuri;
	/**
     * @JMS\Type("string")
     */
	private $isactive;
	/**
     * @JMS\Type("string")
     */
	private $isprivatecustomer;

	/**
	 * @JMS\Type("string")
	 */
	private $emailinvoicingaddress;

	/**
	 * @param string $name
	 */
	public function __construct($name) {
		$this->name = $name;
	}
	
	public function setInternalidentifier($internalidentifier) {
		$this->internalidentifier = $internalidentifier;
	}
	
	public function setExternalidentifier($externalidentifier) {
		$this->externalidentifier = $externalidentifier;
	}

	/**
	 * @param mixed $nameextension
	 */
	public function setName($name) {
		$this->name = $name;
	}
	/**
	 * @param mixed $nameextension
	 */
	public function setNameextension($nameExtension) {
		$this->nameextension = $nameExtension;
	}

	/**
	 * @param mixed $streetaddress
	 */
	public function setStreetaddress($streetAddress) {
		$this->streetaddress = $streetAddress;
	}

	/**
	 * @param $additionaladdressLine
	 */
	public function setAdditionaladdressline($additionaladdressline) {
		$this->additionaladdressline = $additionaladdressline;
	}

	/**
	 * @param mixed $city
	 */
	public function setCity($city) {
		$this->city = $city;
	}

	/**
	 * @param mixed $postnumber
	 */
	public function setPostnumber($postnumber) {
		$this->postnumber = $postnumber;
	}

	/**
	 * @param mixed $country
	 */
	public function setCountry($country) {
		$this->country = new AttributeElement($country, array("type" => "ISO-3166"));
	}

	/**
	 * @param mixed $customergroupname
	 */
	public function setCustomergroupname($customergroupname) {
		$this->customergroupname = $customergroupname;
	}

	/**
	 * @param mixed $phonenumber
	 */
	public function setPhonenumber($phonenumber) {
		$this->phonenumber = $phonenumber;
	}

	/**
	 * @param mixed $faxnumber
	 */
	public function setFaxnumber($faxnumber) {
		$this->faxnumber = $faxnumber;
	}

	/**
	 * @param mixed $email
	 */
	public function setEmail($email) {
		$this->email = $email;
	}
	/**
	 * @param mixed $email
	 */
	public function setEmailinvoicingaddress($email) {
		$this->emailinvoicingaddress = $email;
	}

	/**
	 * @param mixed $homepageuri
	 */
	public function setHomepageuri($homepageuri) {
		$this->homepageuri = $homepageuri;
	}

	/**
	 * @param mixed $isactive
	 */
	public function setIsactive($isActive) {
		$this->isactive = $isActive ? 1 : 0;
	}
	/**
	 * @param mixed $isprivatecustomer
	 */
	public function setPrivatecustomer($isPrivatecustomer) {
		$this->isprivatecustomer = $isPrivatecustomer ? 1 : 0;
	}
}
