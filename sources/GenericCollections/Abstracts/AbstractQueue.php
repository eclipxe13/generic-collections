<?php namespace GenericCollections\Abstracts;

use GenericCollections\Interfaces\QueueInterface;
use GenericCollections\Internal\DataDoubleLinkedList;
use GenericCollections\Internal\DoubleLinkedList;
use GenericCollections\Traits\CollectionMethods;

abstract class AbstractQueue extends DataDoubleLinkedList implements QueueInterface
{
    use CollectionMethods;

    public function add($element)
    {
        if ($this->optionUniqueValues() && $this->contains($element)) {
            return false;
        }
        $this->storage->push($element);
        return true;
    }

    public function offer($element)
    {
        return $this->add($element);
    }

    public function element()
    {
        if ($this->isEmpty()) {
            throw new \LogicException('Can not get an element from an empty queue');
        }
        return $this->storage->top();
    }

    public function peek()
    {
        if ($this->isEmpty()) {
            return null;
        }
        return $this->storage->top();
    }

    public function remove()
    {
        if ($this->isEmpty()) {
            throw new \LogicException('Can not remove an element from an empty queue');
        }
        return $this->storage->pop();
    }

    public function poll()
    {
        if ($this->isEmpty()) {
            return null;
        }
        return $this->remove();
    }

    public function contains($element)
    {
        return $this->storage->contains($element);
    }

    protected function createStorageObject()
    {
        $this->storage = new DoubleLinkedList($this->optionComparisonIsIdentical());
    }
}
