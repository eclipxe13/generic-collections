<?php namespace GenericCollections;

use GenericCollections\Abstracts\AbstractCollection;
use GenericCollections\Utils\TypeProperty;

/**
 * Generic collection implementation
 *
 * The elements comparison can be defined ad identical or equal,
 * if identical searchs match with '==='
 * if equal searchs match with '=='
 *
 * @package GenericCollections
 */
class Collection extends AbstractCollection
{
    /**
     * @var TypeProperty
     */
    private $elementType;

    /**
     * Comparison types
     * @var bool
     */
    private $comparisonIdentical;

    /**
     * Generic collection
     *
     * example: `new Collection(Foo::class, [new Foo(), new Foo()]`
     *
     * @param string $elementType
     * @param array $elements
     * @param bool $comparisonIdentical
     */
    public function __construct($elementType, array $elements = [], $comparisonIdentical = true)
    {
        $this->elementType = new TypeProperty($elementType);
        $this->comparisonIdentical = (bool) $comparisonIdentical;
        $this->addAll($elements);
    }

    // implements CollectionInterface::getElementType : string
    public function getElementType()
    {
        return (string) $this->elementType;
    }

    // implements CollectionInterface::getElementType : bool
    public function comparisonMethodIsIdentical()
    {
        return $this->comparisonIdentical;
    }
}
