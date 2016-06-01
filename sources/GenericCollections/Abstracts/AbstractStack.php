<?php namespace GenericCollections\Abstracts;

use GenericCollections\Interfaces\QueueInterface;
use GenericCollections\Internal\DataDoubleLinkedList;
use GenericCollections\Traits\CollectionMethods;
use GenericCollections\Traits\DequeMethods;
use GenericCollections\Traits\StackLifoMethods;

abstract class AbstractStack extends DataDoubleLinkedList implements QueueInterface
{
    use CollectionMethods;

    use DequeMethods {
        addFirst as private;
        addLast as private;
        offerFirst as private;
        offerLast as private;
        getFirst as private;
        getLast as private;
        peekFirst as private;
        peekLast as private;
        removeFirst as private;
        removeLast as private;
        pollFirst as private;
        pollLast as private;
    }
    
    use StackLifoMethods;

    protected function containerInternalName()
    {
        return 'stack';
    }
}
