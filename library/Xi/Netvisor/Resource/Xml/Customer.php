<?php

namespace Xi\Netvisor\Resource\Xml;

use JMS\Serializer\Annotation\XmlList;
use JMS\Serializer\Annotation as JMS;
use Xi\Netvisor\Resource\Xml\Component\Root;
use Xi\Netvisor\Resource\Xml\Component\AttributeElement;
use Xi\Netvisor\Resource\Xml\Component\WrapperElement;


class Customer extends Root
{

	/**
	 * @var $customerbaseinformation CustomerBaseinformation
	 * @JMS\Type("Xi\Netvisor\Resource\Xml\CustomerBaseinformation")
	 */
	private $customerbaseinformation;
	/**
	 * @var $customerfinvoicedetails CustomerFinvoiceDetails
	 * @JMS\Type("Xi\Netvisor\Resource\Xml\CustomerFinvoiceDetails")
	 */
    private $customerfinvoicedetails;
	/**
	 * @var $customerdeliverydetails CustomerDeliveryDetails
	 * @JMS\Type("Xi\Netvisor\Resource\Xml\CustomerDeliveryDetails")
	 */
    private $customerdeliverydetails;
	/**
	 * @var $customercontactdetails CustomerContactDetails
	 * @JMS\Type("Xi\Netvisor\Resource\Xml\CustomerContactDetails")
	 */
    private $customercontactdetails;


    public function __construct() {

    }

	/**
	 * @param CustomerBaseinformation $customerbaseinformation
	 */
	public function setCustomerbaseinformation(CustomerBaseinformation $customerbaseinformation) {
		$this->customerbaseinformation = $customerbaseinformation;
	}

	/**
	 * @param CustomerContactDetails $customercontactdetails
	 */
	public function setCustomercontactdetails(CustomerContactDetails $customercontactdetails) {
		$this->customercontactdetails = $customercontactdetails;
	}

	/**
	 * @param CustomerDeliveryDetails $customerdeliverydetails
	 */
	public function setCustomerdeliverydetails(CustomerDeliveryDetails $customerdeliverydetails) {
		$this->customerdeliverydetails = $customerdeliverydetails;
	}

	/**
	 * @param CustomerFinvoiceDetails $customerfinvoicedetails
	 */
	public function setCustomerfinvoicedetails(CustomerFinvoiceDetails $customerfinvoicedetails) {
		$this->customerfinvoicedetails = $customerfinvoicedetails;
	}

    public function getDtdPath()
    {
        return $this->getDtdFile('customer.dtd');
    }

    protected function getXmlName()
    {
        return 'customer';
    }
}
