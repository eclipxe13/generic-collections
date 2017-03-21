<?php
namespace GenericCollections\Utils;

/**
 * TypeKeyProperty is a ValueObject utility class,
 * the only logic in here is validate the type parameter.
 *
 * This is an specialized class that only allows types:
 * integer, int, long and string
 *
 * @package GenericCollections\Utils
 */
class TypeKeyProperty extends TypeProperty
{
    public function getAllowedTypes()
    {
        return ['string', 'int', 'integer', 'long'];
    }
}
