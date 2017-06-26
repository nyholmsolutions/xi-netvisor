<?php

namespace Xi\Netvisor\Resource\Xml;

use JMS\Serializer\Annotation as JMS;
use JMS\Serializer\Annotation\XmlRoot;

use Xi\Netvisor\Resource\Xml\Component\AttributeElement;

/** @XmlRoot("VoucherLine") */
class VoucherLine
{
    /**
     * @JMS\Type("Xi\Netvisor\Resource\Xml\Component\AttributeElement")
     */
    private $lineSum;
    /**
     * @JMS\Type("string")
     */
    private $description;
    /**
     * @JMS\Type("string")
     */
    private $accountNumber;
    /**
     * @JMS\Type("Xi\Netvisor\Resource\Xml\Component\AttributeElement")
     */
    private $vatPercent;
    /**
     * @JMS\Type("string")
     */
    private $skipAccrual;

    private $dimension;

    public function __construct(
        $linesum,
        $description,
        $accountNumber,
        $vatPercent,
        $skipAccrual = 0
    ) {
        $this->setLineSum($linesum['amount'], $linesum['type']);
        $this->setDescription($description);
        $this->setAccountNumber($accountNumber);
        $this->setVatPercent($vatPercent['percentage'], $vatPercent['code']);
        $this->setSkipAccural($skipAccrual);
    }
    public function setLineSum($linesum, $type){
        // Summa. Positiivinen luku kirjataan debit puolelle, ja negatiivinen credit puolelle
        $this->lineSum = new AttributeElement($linesum, array('type' => $type));
    }
    public function setDescription($text){
        $this->description = mb_substr($text, 0, 255,"UTF-8");
    }
    public function setAccountNumber($account){
        $this->accountNumber = $account;
    }
    public function setVatPercent($productVatPercentage, $vatcode = 'KOMY'){
        $this->vatPercent = new AttributeElement($productVatPercentage, array('vatcode' => $vatcode));
        /*
           Ei saa olla ristiriidassa alv-prosentin kanssa. Sallitut alv-koodit: NONE|KOOS|EUOS|EUUO|EUPO|100|KOMY|EUMY|EUUM|EUPM312|EUPM309|MUUL|EVTO|EVPO|RAMY|RAOS|EVRO

            NONE = Ei alv-käsittelyä
            KOOS = Kotimaan osto
            EUOS = EU-osto
            EUUO = EU:n ulkopuolinen osto
            EUPO = EU-palveluosto
            100 = 100% vähennettävä vero
            KOMY = Kotimaan myynti
            EUMY = EU-myynti
            EUUM = EU:n ulkopuolinen myynt
        */
    }

    public function setSkipAccural($skipAccrual){
        $this->skipAccural = $skipAccrual ? 1 : 0;
    }
}
