<?php

namespace Xi\Netvisor\Resource\Xml;

use Xi\Netvisor\Resource\Xml\Component\WrapperElement;
use Xi\Netvisor\Resource\Xml\Component\AttributeElement;

class ProductBaseinformation
{

	private $productcode;
	private $productgroup;
	private $name;
	private $description;
	private $unitprice;
	private $unit;
	private $unitweight;
	private $purchaseprice;
	private $tariffheading;
	private $comissionpercentage;
	private $isactive;
	private $issalesproduct;
	private $inventoryenabled;
	

	public function __construct() {

	}

	public function setSetproductcode($productcode) {
		$this->productcode = $productcode;
	}
	public function setProductgroup($productgroup) {
		$this->productgroup = $productgroup;
	}
	public function setName($name) {
		$this->name = $name;
	}
	public function setDescription($description) {
		$this->description = $description;
	}
	public function setUnitprice($unitprice, $type) {
		// type = 'gross' || 'net'
		$this->unitprice = new AttributeElement($unitprice, array("type" => $type));
	}
	public function setUnit($unit) {
		$this->unit = $unit;
	}
	public function setUnitweight($unitweight) {
		$this->unitweight = $unitweight;
	}
	public function setPurchaseprice($purchaseprice) {
		$this->purchaseprice = $purchaseprice;
	}
	public function setTariffheading($tariffheading) {
		$this->tariffheading = $tariffheading;
	}
	public function setComissionpercentage($comissionpercentage) {
		$this->comissionpercentage = $comissionpercentage;
	}
	public function setIsactive($isactive) {
		$this->isactive = $isactive ? 1 : 0;
	}
	public function setIssalesproduct($issalesproduct) {
		$this->issalesproduct = $issalesproduct ? 1 : 0;
	}
	public function setInventoryenabled($inventoryenabled) {
		$this->inventoryenabled = $inventoryenabled ? 1 : 0;
	}
}
