<?php
namespace GenericCollections\Abstracts;

use GenericCollections\Interfaces\StackInterface;
use GenericCollections\Internal\DataDoubleLinkedList;
use GenericCollections\Traits\CollectionMethods;
use GenericCollections\Traits\DequeCommonMethods;

abstract class AbstractStack extends DataDoubleLinkedList implements StackInterface
{
    use CollectionMethods;

    use DequeCommonMethods {
        addLast as private;     // not really needed
        addFirst as private;    // used in add
        offerLast as private;   // not really needed
        offerFirst as offer;
        getFirst as element;
        peekFirst as peek;
        removeFirst as remove;
        pollFirst as poll;
    }

    public function add($element)
    {
        $this->addFirst($element);
        return true;
    }

    protected function containerInternalName()
    {
        return 'stack';
    }
}
