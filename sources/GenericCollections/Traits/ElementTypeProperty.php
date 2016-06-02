<?php namespace GenericCollections\Traits;

use GenericCollections\Utils\TypeProperty;

/**
 * Trait ElementTypeProperty.
 * used in Collections and Map (renaming element to value)
 *
 * @mixin \GenericCollections\Collection
 *
 * @package GenericCollections\Traits
 */
trait ElementTypeProperty
{
    /**
     * @var TypeProperty
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
