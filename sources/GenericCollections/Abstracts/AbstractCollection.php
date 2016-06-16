<?php namespace GenericCollections\Abstracts;

use GenericCollections\Exceptions\InvalidElementTypeException;
use GenericCollections\Interfaces\CollectionInterface;
use GenericCollections\Internal\DataArray;
use GenericCollections\Traits\CollectionMethods;

/**
 * This is a partial implementation of CollectionInterface
 * The main Collection object extends this class but types methods
 *
 * Use this class to implement your own collection class.
 * You will need to implement the getElementType method on your concrete case.
 *
 * @package GenericCollections\Abstracts
 */
abstract class AbstractCollection extends DataArray implements CollectionInterface
{
    use CollectionMethods;

    public function add($element)
    {
        if ($this->optionUniqueValues() && $this->contains($element)) {
            return false;
        }
        if (! $this->checkElementType($element)) {
            throw new InvalidElementTypeException('collection', $this->getElementType(), get_class($this));
        }
        $this->data[] = $element;
        return true;
    }

    public function contains($element)
    {
        return in_array($element, $this->data, $this->optionComparisonIsIdentical());
    }

    public function remove($element)
    {
        $index = array_search($element, $this->data, $this->optionComparisonIsIdentical());
        if (false === $index) {
            return false;
        }
        unset($this->data[$index]);
        if ($index < count($this->data)) {
            $this->data = array_values($this->data);
        }
        return true;
    }

    public function retainAll(array $elements)
    {
        $changed = false;
        foreach ($this->data as $index => $element) {
            if (! in_array($element, $elements, $this->optionComparisonIsIdentical())) {
                unset($this->data[$index]);
                $changed = true;
            }
        }
        if ($changed) {
            $this->data = array_values($this->data);
        }
        return $changed;
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
}
