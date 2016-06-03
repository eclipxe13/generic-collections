<?php namespace GenericCollections\Abstracts;

use GenericCollections\Exceptions\ContainerIsEmptyException;
use GenericCollections\Interfaces\DequeInterface;
use GenericCollections\Internal\DataDoubleLinkedList;
use GenericCollections\Traits\CollectionMethods;
use GenericCollections\Traits\DequeCommonMethods;

abstract class AbstractDeque extends DataDoubleLinkedList implements DequeInterface
{
    use CollectionMethods;
    use DequeCommonMethods;

    public function add($element)
    {
        $this->addLast($element);
        return true;
    }

    public function offer($element)
    {
        return $this->offerLast($element);
    }

    public function getLast()
    {
        if ($this->isEmpty()) {
            throw new ContainerIsEmptyException($this->containerInternalName(), 'get');
        }
        return $this->storage->top();
    }

    public function element()
    {
        return $this->getFirst();
    }

    public function peekLast()
    {
        if ($this->isEmpty()) {
            return null;
        }
        return $this->storage->top();
    }

    public function peek()
    {
        return $this->peekFirst();
    }

    public function removeLast()
    {
        if ($this->isEmpty()) {
            throw new ContainerIsEmptyException($this->containerInternalName(), 'remove');
        }
        return $this->storage->pop();
    }

    public function remove()
    {
        return $this->removeFirst();
    }

    public function poll()
    {
        return $this->pollFirst();
    }

    public function pollLast()
    {
        if ($this->isEmpty()) {
            return null;
        }
        return $this->storage->pop();
    }

    protected function containerInternalName()
    {
        return 'deque';
    }
}
