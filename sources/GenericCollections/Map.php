<?php namespace GenericCollections;

use GenericCollections\Abstracts\AbstractMap;
use GenericCollections\Traits\ElementTypeProperty;
use GenericCollections\Traits\KeyTypeProperty;
use GenericCollections\Traits\OptionsProperty;
use GenericCollections\Utils\TypeKeyProperty;
use GenericCollections\Utils\TypeProperty;

class Map extends AbstractMap
{
    use OptionsProperty;
    use KeyTypeProperty;
    use ElementTypeProperty {
        getElementType as getValueType;
        checkElementType as checkValueType;
    }

    /**
     * Generic map
     *
     * example:
     * ```php
     * new Map('string', Foo::class, [
     *     'one' => new Foo(),
     *     'two' => new Foo(),
     * ];
     * ```
     *
     * Options:
     * - Defaults: not allow nulls, allow duplicates, identical comparisons
     * - deny duplicates can be activated
     * - If allow null elements and deny duplicates, any entry on the map can have a null value
     *
     * @param string $keyType
     * @param string $valueType
     * @param array $values
     * @param int $options check constants inside Options class
     */
    public function __construct($keyType, $valueType, array $values = [], $options = 0)
    {
        $this->options = new Options($options);
        $this->keyType = new TypeKeyProperty($keyType, false);
        $this->elementType = new TypeProperty($valueType, $this->optionAllowNullMembers());
        $this->putAll($values);
    }
}
