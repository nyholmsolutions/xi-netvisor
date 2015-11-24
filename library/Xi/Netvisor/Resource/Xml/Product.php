<?php

namespace Xi\Netvisor\Resource\Xml;

use JMS\Serializer\Annotation\XmlList;
use Xi\Netvisor\Resource\Xml\Component\Root;
use Xi\Netvisor\Resource\Xml\Component\AttributeElement;
use Xi\Netvisor\Resource\Xml\Component\WrapperElement;

class Product extends Root
{

	/**
	 * @var $productbaseinformation ProductBaseinformation
	 */
	private $productbaseinformation;

    public function __construct() {

    }

	/**
	 * @param ProductBaseinformation $productbaseinformation
	 */
	public function setProductbaseinformation(ProductBaseinformation $productbaseinformation) {
		$this->productbaseinformation = $productbaseinformation;
	}

    public function getDtdPath()
    {
        return $this->getDtdFile('product.dtd');
    }

    protected function getXmlName()
    {
        return 'product';
    }
}
