<?php namespace GenericCollections\Traits;

use GenericCollections\Utils\TypeProperty;

/**
 * Trait ElementTypeProperty. Main use: Collections and Map (renaming element to value)
 *
 * Inserts into the class the following methods:
 * private TypeProperty $elementType
 * public string getElementType()
 * public bool checkElementType($element)
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
