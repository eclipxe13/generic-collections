<?php

namespace GenericCollections\Traits;

use GenericCollections\Internal\DoubleLinkedList;

trait DequeMethods
{
    /** @var DoubleLinkedList */
    protected $storage;
    
    abstract protected function containerInternalName();
    
    
    /**
     * Protected method to do the checks for add and offer methods
     *
     * @param $element
     * @return string The reason why this would produce an error
     */
    private function checkAddOffer($element)
    {
        // always throw an exception if element is null and container does not allow nulls
        if (! $this->optionAllowNullMembers() && is_null($element)) {
            throw new \InvalidArgumentException(
                'The ' . $this->containerInternalName() . ' does not allow null elements'
            );
        }
        // always throw an exception if element is not the correct type
        if (! $this->checkElementType($element)) {
            throw new \InvalidArgumentException(
                'Invalid element type;'
                . ' the ' . $this->containerInternalName() . ' ' . get_class($this)
                . ' was expecting a ' . $this->getElementType() . ' type'
            );
        }
        // return the error message, add will throw an exception, offer will return false
        if ($this->optionUniqueValues() && $this->contains($element)) {
            return 'The ' . $this->containerInternalName() . ' does not allow duplicated elements';
        }
        // no error found
        return '';
    }

    public function addFirst($element)
    {
        if ('' !== $errorMessage = $this->checkAddOffer($element)) {
            throw new \InvalidArgumentException($errorMessage);
        }
        $this->storage->unshift($element);
    }

    public function addLast($element)
    {
        if ('' !== $errorMessage = $this->checkAddOffer($element)) {
            throw new \InvalidArgumentException($errorMessage);
        }
        $this->storage->push($element);
    }

    public function offerFirst($element)
    {
        if ('' !== $this->checkAddOffer($element)) {
            return false;
        }
        $this->storage->unshift($element);
        return true;
    }

    public function offerLast($element)
    {
        if ('' !== $this->checkAddOffer($element)) {
            return false;
        }
        $this->storage->push($element);
        return true;
    }

    public function getFirst()
    {
        if ($this->isEmpty()) {
            throw new \LogicException('Can not get an element from an empty ' . $this->containerInternalName());
        }
        return $this->storage->bottom();
    }

    public function getLast()
    {
        if ($this->isEmpty()) {
            throw new \LogicException('Can not get an element from an empty ' . $this->containerInternalName());
        }
        return $this->storage->top();
    }

    public function element()
    {
        return $this->getFirst();
    }

    public function peekFirst()
    {
        if ($this->isEmpty()) {
            return null;
        }
        return $this->storage->bottom();
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

    public function removeFirst()
    {
        if ($this->isEmpty()) {
            throw new \LogicException('Can not remove an element from an empty ' . $this->containerInternalName());
        }
        return $this->storage->shift();
    }

    public function removeLast()
    {
        if ($this->isEmpty()) {
            throw new \LogicException('Can not remove an element from an empty ' . $this->containerInternalName());
        }
        return $this->storage->pop();
    }

    public function remove()
    {
        return $this->removeFirst();
    }

    public function pollFirst()
    {
        if ($this->isEmpty()) {
            return null;
        }
        return $this->storage->shift();
    }

    public function pollLast()
    {
        if ($this->isEmpty()) {
            return null;
        }
        return $this->storage->pop();
    }

    public function poll()
    {
        return $this->pollFirst();
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
