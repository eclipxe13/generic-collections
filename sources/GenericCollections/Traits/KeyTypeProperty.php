<?php namespace GenericCollections\Traits;

use GenericCollections\Utils\TypeProperty;

/**
 * Trait KeyTypeProperty.
 * Used in: Maps
 *
 * @mixin \GenericCollections\Map
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
