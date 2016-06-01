<?php namespace GenericCollections\Traits;

use GenericCollections\Utils\TypeProperty;

/**
 * Trait KeyTypeProperty. Main use: Maps
 *
 * Inserts into the class the following methods:
 * private TypeProperty $keytype
 * public string getKeyType()
 * public bool checkKeyType($element)
 *
 * @package GenericCollections\Traits
 */
trait KeyTypeProperty
{
    /**
     * @var TypeProperty
     */
    private $keyType;
    
    public function getKeyType()
    {
        return (string) $this->keyType;
    }

    public function checkKeyType($element)
    {
        return $this->keyType->check($element);
    }
}
