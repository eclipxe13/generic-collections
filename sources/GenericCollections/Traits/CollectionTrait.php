<?php namespace GenericCollections\Traits;

use GenericCollections\Utils\TypeProperty;

/**
 * This code is the same for Collection and Set
 * It is on a trait to avoid duplicates
 *
 * @package GenericCollections\Taints
 */
trait CollectionTrait
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
    public function isComparisonIdentical()
    {
        return $this->comparisonIdentical;
    }
}
