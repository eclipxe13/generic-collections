<?php
namespace GenericCollections\Abstracts;

use GenericCollections\Interfaces\QueueInterface;
use GenericCollections\Internal\DataDoubleLinkedList;
use GenericCollections\Traits\CollectionMethods;
use GenericCollections\Traits\DequeCommonMethods;

abstract class AbstractQueue extends DataDoubleLinkedList implements QueueInterface
{
    use CollectionMethods;

    use DequeCommonMethods {
        addLast as private;     // used in add
        addFirst as private;    // not really needed
        offerLast as offer;
        offerFirst as private;  // not really needed
        getFirst as element;
        peekFirst as peek;
        removeFirst as remove;
        pollFirst as poll;
    }

    public function add($element)
    {
        $this->addLast($element);
        return true;
    }

    protected function containerInternalName()
    {
        return 'queue';
    }
}
