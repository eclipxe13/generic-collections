<?php namespace GenericCollections;

use GenericCollections\Abstracts\AbstractCollection;
use GenericCollections\Traits\ElementTypeProperty;
use GenericCollections\Traits\OptionsProperty;
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
    use ElementTypeProperty;
    use OptionsProperty;

    /**
     * Generic collection
     *
     * example: `new Collection(Foo::class, [new Foo(), new Foo()]`
     *
     * Options:
     * - Defaults: not allow nulls, identical comparisons
     * - It is not possible to allow duplicates, use a Collection instead
     * - If allow null elements is enabled only 1 value can be null
     *
     * @param string $elementType
     * @param array $elements
     * @param int $options
     */
    public function __construct($elementType, array $elements = [], $options = 0)
    {
        $this->options = new Options($options);
        $this->elementType = new TypeProperty($elementType, $this->options->optionAllowNullMembers());
        $this->addAll($elements);
    }
}
