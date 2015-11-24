<?php

namespace Xi\Netvisor\Resource\Xml;

use Xi\Netvisor\Resource\Xml\Component\WrapperElement;
use Xi\Netvisor\Resource\Xml\Component\AttributeElement;

class ProductBookkeepingDetails
{
	private $defaultvatpercentage;

	public function __construct() {
	}

	public function setDefaultvatpercentage($defaultvatpercentage) {
		$this->defaultvatpercentage = $defaultvatpercentage;
	}
}
