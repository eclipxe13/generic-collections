<?php namespace GenericCollections\Traits;

/**
 * Trait ElementTypeProperty.
 * Used in Collections and Map (renaming element to value)
 *
 * @package GenericCollections\Traits
 */
trait ElementTypeProperty
{
    /**
     * @var \GenericCollections\Utils\TypeProperty
     */
    private $elementType;

    public function getElementType()
    {
        return (string) $this->elementType;
    }
    
    public function checkElementType($element)
    {
        return $this->elementType->check($element);
    }
}
