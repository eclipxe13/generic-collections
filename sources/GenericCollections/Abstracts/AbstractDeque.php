<?php namespace GenericCollections\Abstracts;

use GenericCollections\Interfaces\DequeInterface;
use GenericCollections\Internal\DataDoubleLinkedList;
use GenericCollections\Traits\CollectionMethods;
use GenericCollections\Traits\DequeMethods;
use GenericCollections\Traits\QueueFifoMethods;

abstract class AbstractDeque extends DataDoubleLinkedList implements DequeInterface
{
    use CollectionMethods;
    use DequeMethods;
    use QueueFifoMethods;

    protected function containerInternalName()
    {
        return 'deque';
    }
}
