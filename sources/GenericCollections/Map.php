<?php namespace GenericCollections;

use GenericCollections\Abstracts\AbstractMap;
use GenericCollections\Utils\TypeProperty;
use GenericCollections\Utils\TypeKeyProperty;

class Map extends AbstractMap
{
    /**
     * @var TypeProperty
     */
    private $valueType;

    /**
     * @var TypeKeyProperty
     */
    private $keyType;

    /**
     * Comparison types
     * @var bool
     */
    private $comparisonIdentical;

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
     * @param string $keyType
     * @param string $valueType
     * @param array $values
     * @param bool $comparisonIdentical
     */
    public function __construct($keyType, $valueType, array $values = [], $comparisonIdentical = true)
    {
        $this->keyType = new TypeKeyProperty($keyType);
        $this->valueType = new TypeProperty($valueType);
        $this->comparisonIdentical = (bool) $comparisonIdentical;
        $this->putAll($values);
    }

    // implements MapInterface::getKeyType : bool
    public function getKeyType()
    {
        return (string) $this->keyType;
    }

    // implements MapInterface::getValueType : bool
    public function getValueType()
    {
        return (string) $this->valueType;
    }

    // implements MapInterface::isComparisonIdentical : bool
    public function isComparisonIdentical()
    {
        return $this->comparisonIdentical;
    }
}
