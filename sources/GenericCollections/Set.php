<?php namespace GenericCollections;

/**
 * Generic set implementation
 *
 * A set is the same as a collection but can't contain duplicated values
 *
 * @package GenericCollections
 */

class Set extends Collection
{

    /**
     * Generic set
     *
     * example: `new Set(Foo::class, [new Foo(), new Foo()]`
     *
     * Options:
     * - Defaults: not allow nulls, identical comparisons
     * - It is not possible to allow duplicates, use a Collection instead
     * - If allow null elements is enabled only 1 value can be null
     *
     * @param string $elementType
     * @param array $elements
     * @param int $options Options::COMPARISONISIDENTICAL
     */
    public function __construct($elementType, array $elements = [], $options = Options::UNIQUE_VALUES)
    {
        // force Options::UNIQUE_VALUES
        if (is_int($options)) {
            $options = $options | Options::UNIQUE_VALUES;
        }
        parent::__construct($elementType, $elements, $options);
    }
}
