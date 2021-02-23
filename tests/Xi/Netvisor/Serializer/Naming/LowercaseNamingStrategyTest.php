<?php

namespace Xi\Netvisor\Serializer\Naming;

class LowercaseNamingStrategyTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     * @dataProvider provideNames
     */
    public function lowercases($name)
    {
        $strategy = new LowercaseNamingStrategy();
	    $property = $this->getMockBuilder("JMS\Serializer\Metadata\PropertyMetadata")->disableOriginalConstructor()->getMock();
	    $property->name = $name;

	    $this->assertEquals(strtolower($name), $strategy->translateName($property));
    }

    public function provideNames()
    {
        return array(
            array('camelCase'),
            array('CamelCaps'),
            array('CAPSLOCKCAPSLOCK'),
        );
    }
}
