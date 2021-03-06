<?php

namespace Xi\Netvisor\Resource\Xml\Component;

abstract class Root
{
    /**
     * File path to a DTD file
     * which should be used for XML validation.
     *
     * @return string
     */
    abstract public function getDtdPath();

    /**
     * TODO: Could this be called implicitly?
     *
     * Because Netvisor wants XML to be wrapped inside a root tag.
     *
     * @return WrapperElement
     */
    public function getSerializableObject()
    {
        return new WrapperElement($this->getXmlName(), $this);
    }

    /**
     * Name of the first child element of the root, e.g. salesInvoice.
     *
     * @return string
     */
    abstract protected function getXmlName();

    /**
     * @return string
     */
    protected function getDtdFile($filename)
    {
        return __DIR__ . '/../../Dtd/' . $filename;
    }
}
