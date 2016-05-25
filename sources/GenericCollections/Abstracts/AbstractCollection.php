<?php namespace GenericCollections\Abstracts;

use GenericCollections\Interfaces\CollectionInterface;
use GenericCollections\Utils\TypeChecker;

/**
 * This is a partial implementation of CollectionInterface
 * The main Collection object extends this class
 *
 * Use this class to implement your own collection class.
 * You will need to implement the getElementType method on your concrete case.
 * You would also want to change the strict/identity behavior, to do so
 * you will need to override internalInArray and internalSearchArray methods.
 *
 * @package GenericCollections\Abstracts
 */
abstract class AbstractCollection extends InternalDataArray implements CollectionInterface
{
    public function addAll(array $elements)
    {
        $added = false;
        foreach ($elements as $element) {
            $added = $this->add($element);
        }
        return $added;
    }

    public function add($element)
    {
        if (! $this->checkElementType($element)) {
            throw new \InvalidArgumentException(
                'Invalid element type;'
                . ' the collection ' . get_class($this)
                . ' was expecting a ' . $this->getElementType() . ' type'
            );
        }

        $this->data[] = $element;

        return true;
    }

    public function contains($element)
    {
        return in_array($element, $this->data, $this->isComparisonIdentical());
    }

    public function containsAll(array $elements)
    {
        foreach ($elements as $element) {
            if (! $this->contains($element)) {
                return false;
            }
        }
        return true;
    }

    public function containsAny(array $elements)
    {
        foreach ($elements as $element) {
            if ($this->contains($element)) {
                return true;
            }
        }
        return false;
    }

    public function remove($element)
    {
        $index = array_search($element, $this->data, $this->isComparisonIdentical());
        if (false === $index) {
            return false;
        }
        unset($this->data[$index]);
        if ($index < count($this->data)) {
            $this->data = array_values($this->data);
        }
        return true;
    }

    public function removeAll(array $elements)
    {
        $changed = false;
        foreach ($elements as $element) {
            do {
                $removed = $this->remove($element);
                if ($removed) {
                    $changed = true;
                }
            } while ($removed);
        }
        return $changed;
    }

    public function removeIf(callable $callable)
    {
        $changed = false;
        foreach ($this->data as $element) {
            if (true === call_user_func($callable, $element)) {
                if ($this->remove($element)) {
                    $changed = true;
                }
            }
        }
        return $changed;
    }

    public function retainAll(array $elements)
    {
        $changed = false;
        foreach ($this->data as $index => $element) {
            if (! in_array($element, $elements, $this->isComparisonIdentical())) {
                unset($this->data[$index]);
                $changed = true;
            }
        }
        if ($changed) {
            $this->data = array_values($this->data);
        }
        return $changed;
    }

    /**
     * Private property to use inside checkValueType to not
     * create the TypeChecker object every time a check is made
     *
     * @var TypeChecker
     */
    private $typeCheckerObject;

    /**
     * Check if an specific value is fine with the collection
     *
     * @param mixed $element
     * @return bool
     */
    public function checkElementType($element)
    {
        if (! ($this->typeCheckerObject instanceof TypeChecker)) {
            $this->typeCheckerObject = new TypeChecker();
        }
        return $this->typeCheckerObject->checkType($this->getElementType(), $element);
    }
}
