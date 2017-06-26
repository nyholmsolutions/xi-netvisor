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
     * @var $customerBaseInformation CustomerBaseInformation
     * @JMS\Type("Xi\Netvisor\Resource\Xml\CustomerBaseinformation")
     */
    private $customerBaseInformation;
    /**
     * @var $customerFinvoiceDetails CustomerFinvoiceDetails
     * @JMS\Type("Xi\Netvisor\Resource\Xml\CustomerFinvoiceDetails")
     */
    private $customerFinvoiceDetails;
    /**
     * @var $customerDeliveryDetails CustomerDeliveryDetails
     * @JMS\Type("Xi\Netvisor\Resource\Xml\CustomerDeliveryDetails")
     */
    private $customerDeliveryDetails;
    /**
     * @var $customerContactDetails CustomerContactDetails
     * @JMS\Type("Xi\Netvisor\Resource\Xml\CustomerContactDetails")
     */
    private $customerContactDetails;


    public function __construct(
        CustomerBaseInformation $customerBaseInformation = null,
        CustomerFinvoiceDetails $customerFinvoiceDetails = null
    ) {
        $this->customerBaseInformation = $customerBaseInformation;
        $this->customerFinvoiceDetails = $customerFinvoiceDetails;
    }

    /**
     * @param CustomerBaseInformation $customerBaseInformation
     */
    public function setCustomerbaseinformation(CustomerBaseInformation $customerBaseInformation)
    {
        $this->customerBaseInformation = $customerBaseInformation;
    }

    /**
     * @param CustomerContactDetails $customerContactDetails
     */
    public function setCustomerContactDetails(CustomerContactDetails $customerContactDetails)
    {
        $this->customerContactDetails = $customerContactDetails;
    }

    /**
     * @param CustomerDeliveryDetails $customerDeliveryDetails
     */
    public function setCustomerDeliveryDetails(CustomerDeliveryDetails $customerDeliveryDetails)
    {
        $this->customerDeliveryDetails = $customerDeliveryDetails;
    }

    /**
     * @param CustomerFinvoiceDetails $customerFinvoiceDetails
     */
    public function setCustomerfinvoicedetails(CustomerFinvoiceDetails $customerFinvoiceDetails)
    {
        $this->customerFinvoiceDetails = $customerFinvoiceDetails;
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
