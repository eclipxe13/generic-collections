<?php namespace GenericCollections;

use GenericCollections\Abstracts\AbstractQueue;
use GenericCollections\Traits\ElementTypeProperty;
use GenericCollections\Traits\OptionsProperty;
use GenericCollections\Utils\TypeProperty;

/**
 * Generic Queue implementation (FIFO behavior)
 *
 * Options:
 * - Defaults: not allow nulls, allow duplicates, identical comparisons
 *
 * It is not recommended to allow nulls since several methods
 * (element, peek, poll)
 * returns null if not found or empty
 *
 * It is not recommended to set unique values option, this will search inside the
 * container on every insert and it could be expensive on large containers
 *
 * @package GenericCollections
 */
class Queue extends AbstractQueue
{
    use ElementTypeProperty;
    use OptionsProperty;

    /**
     * Generic collection
     *
     * example: `new Collection(Foo::class, [new Foo(), new Foo()]`
     *
     * @param string $elementType
     * @param array $elements
     * @param int $options
     */
    public function __construct($elementType, array $elements = [], $options = 0)
    {
        $this->options = new Options($options);
        $this->elementType = new TypeProperty($elementType, $this->optionAllowNullMembers());
        $this->createStorageObject();
        $this->addAll($elements);
    }
}
