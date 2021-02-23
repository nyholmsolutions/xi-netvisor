<?php

namespace Xi\Netvisor\Resource\Xml\Component;

use JMS\Serializer\Annotation as Serializer;

class AttributeElement
{
    /**
     * @Serializer\Inline
     */
    private $value;

    /**
     * @Serializer\XmlAttributeMap
     */
    private $attributes;

    /**
     * @param string $value
     * @param array  $attributes
     */
    public function __construct($value, $attributes)
    {
        $this->value = $value;
        $this->attributes = $attributes;
    }
}
