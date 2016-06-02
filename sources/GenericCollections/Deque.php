<?php namespace GenericCollections;

use GenericCollections\Abstracts\AbstractDeque;
use GenericCollections\Traits\ElementTypeProperty;
use GenericCollections\Traits\OptionsProperty;
use GenericCollections\Utils\TypeProperty;

/**
 * Generic double ended queue implementation
 *
 * This class has a FIFO behavior on add, offer, element, peek, remove & poll methods
 *
 * Options:
 * - Defaults: not allow nulls, allow duplicates, identical comparisons
 *
 * It is not recommended to allow nulls since several methods
 * (element, pollFirst, pollLast, poll, peekFirst, peekLast and peek)
 * returns null if not found or empty
 *
 * It is not recommended to set unique values option, this will search inside the
 * container on every insert and it could be expensive on large containers
 *
 * @package GenericCollections
 */
class Deque extends AbstractDeque
{
    use ElementTypeProperty;
    use OptionsProperty;

    /**
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
