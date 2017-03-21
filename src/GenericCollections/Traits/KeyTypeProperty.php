<?php
namespace GenericCollections\Traits;

/**
 * Trait KeyTypeProperty.
 * Used in: Maps
 *
 * @package GenericCollections\Traits
 */
trait KeyTypeProperty
{
    /**
     * @var \GenericCollections\Utils\TypeProperty
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
