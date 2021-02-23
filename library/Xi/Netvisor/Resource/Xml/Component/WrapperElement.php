<?php

namespace Xi\Netvisor\Resource\Xml\Component;

use JMS\Serializer\Annotation as Serializer;

/**
 * @Serializer\XmlRoot("root")
 */
class WrapperElement
{
    /**
     * @Serializer\XmlKeyValuePairs
     * @Serializer\Inline
     */
    private $value;

    /**
     * @param string $elementName
     * @param mixed  $value
     */
    public function __construct($elementName, $value)
    {
        $this->value = array($elementName => $value);
    }
}
