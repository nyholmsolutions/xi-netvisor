<?php

namespace Xi\Netvisor;

use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use Xi\Netvisor\Serializer\Naming\LowercaseNamingStrategy;
use Xi\Netvisor\Component\Validate;

class XmlTestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Serializer
     */
    private $serializer;

    /**
     * @var Validate
     */
    protected $validate;

    public function setUp()
    {
        $builder = SerializerBuilder::create();
        $builder->setPropertyNamingStrategy(new LowercaseNamingStrategy());

        $this->serializer = $builder->build();
        $this->validate = new Validate();
    }

    /**
     * @param  Object $object
     * @return string
     */
    public function toXml($object)
    {
        return $this->serializer->serialize($object, 'xml');
    }

    /**
     * @param string $tag
     * @param string $value
     * @param string $xml
     */
    public function assertXmlContainsTagWithValue($tag, $value, $xml)
    {
        $this->assertContains(sprintf('<%s', $tag), $xml);
        $this->assertContains(sprintf('>%s</%s>', $value, $tag), $xml);
    }

    /**
     * @param string $tag
     * @param string $value
     * @param string $xml
     */
    public function assertXmlContainsTagWithCDATAValue($tag, $value, $xml)
    {
        $this->assertContains(sprintf('<%s', $tag), $xml);
        $this->assertContains(sprintf('><![CDATA[%s]]></%s>', $value, $tag), $xml);
    }

    /**
     * @param string $tag
     * @param string $value
     * @param string $xml
     */
    public function assertXmlContainsTagWithAttributes($tag, $attributes, $xml)
    {
        $attributeLine = '';

        foreach ($attributes as $key => $value) {
            $attributeLine .= sprintf(' %s="%s"', $key, $value);
        }

        $this->assertContains(sprintf('<%s%s>', $tag, $attributeLine), $xml);
    }
}
