<?php
namespace GenericCollections\Traits;

use GenericCollections\Exceptions\ContainerDoesNotAllowNullException;
use GenericCollections\Exceptions\ContainerIsEmptyException;
use GenericCollections\Exceptions\ContainerNotUniqueMemberException;
use GenericCollections\Exceptions\InvalidElementTypeException;
use GenericCollections\Internal\DoubleLinkedList;

/**
 * This trait include all deque standard methods to queue, stack and deque
 *
 * @property DoubleLinkedList $storage
 *
 * @package GenericCollections\Traits
 */
trait DequeCommonMethods
{
    /**
     * This function must return the container internal name, like 'deque', 'queue' or 'stack'
     * @return string
     */
    abstract protected function containerInternalName();

    /**
     * @see \GenericCollections\Interfaces\BaseOptionsInterface::optionAllowNullMembers
     * @return bool
     */
    abstract public function optionAllowNullMembers();

    /**
     * @see \GenericCollections\Interfaces\BaseOptionsInterface::optionUniqueValues
     * @return bool
     */
    abstract public function optionUniqueValues();

    /**
     * @see \GenericCollections\Interfaces\BaseOptionsInterface::optionComparisonIsIdentical
     * @return bool
     */
    abstract public function optionComparisonIsIdentical();

    /**
     * @see \GenericCollections\Interfaces\BaseCollectionInterface::checkElementType
     * @param mixed $element
     * @return bool
     */
    abstract public function checkElementType($element);

    /**
     * @see \GenericCollections\Interfaces\BaseCollectionInterface::getElementType
     * @return string
     */
    abstract public function getElementType();

    /**
     * @see \GenericCollections\Internal\StorageInterface::isEmpty
     * @return bool
     */
    abstract public function isEmpty();

    /**
     * Throw an exception when add a non valid element
     *
     * @param $element
     */
    private function checkElementAdd($element)
    {
        // always throw an exception if element is null and container does not allow nulls
        if (! $this->optionAllowNullMembers() && is_null($element)) {
            throw new ContainerDoesNotAllowNullException(
                $this->containerInternalName(),
                get_class($this)
            );
        }
        // always throw an exception if element is not the correct type
        if (! $this->checkElementType($element)) {
            throw new InvalidElementTypeException(
                $this->containerInternalName(),
                $this->getElementType(),
                get_class($this)
            );
        }
        if ($this->optionUniqueValues() && $this->contains($element)) {
            throw new ContainerNotUniqueMemberException(
                $this->containerInternalName(),
                get_class($this)
            );
        }
    }

    /**
     * Throw an exception when add a non valid element
     *
     * @param $element
     * @return bool
     */
    private function checkElementOffer($element)
    {
        try {
            $this->checkElementAdd($element);
        } catch (ContainerNotUniqueMemberException $ex) {
            return false;
        }
        return true;
    }

    public function addFirst($element)
    {
        $this->checkElementAdd($element);
        $this->storage->unshift($element);
    }

    public function addLast($element)
    {
        $this->checkElementAdd($element);
        $this->storage->push($element);
    }

    public function offerFirst($element)
    {
        if (! $this->checkElementOffer($element)) {
            return false;
        }
        $this->storage->unshift($element);
        return true;
    }

    public function offerLast($element)
    {
        if (! $this->checkElementOffer($element)) {
            return false;
        }
        $this->storage->push($element);
        return true;
    }

    public function getFirst()
    {
        if ($this->isEmpty()) {
            throw new ContainerIsEmptyException($this->containerInternalName(), 'get');
        }
        return $this->storage->bottom();
    }

    public function peekFirst()
    {
        if ($this->isEmpty()) {
            return null;
        }
        return $this->storage->bottom();
    }

    public function removeFirst()
    {
        if ($this->isEmpty()) {
            throw new ContainerIsEmptyException($this->containerInternalName(), 'remove');
        }
        return $this->storage->shift();
    }

    public function pollFirst()
    {
        if ($this->isEmpty()) {
            return null;
        }
        return $this->storage->shift();
    }

    public function contains($element)
    {
        return $this->storage->contains($element);
    }

    protected function createStorageObject()
    {
        $this->storage = new DoubleLinkedList();
        if (! $this->optionComparisonIsIdentical()) {
            $this->storage->strictComparisonOff();
        }
    }
}
