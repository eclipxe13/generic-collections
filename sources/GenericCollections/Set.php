<?php namespace GenericCollections;

/**
 * Generic set implementation
 *
 * A set is the same as a collection but can't contain duplicated values
 *
 * @package GenericCollections
 */

class Set extends Collection
{
    public function add($element)
    {
        if ($element === $this) {
            throw new \InvalidArgumentException('It is not allowed for a set to contain itself as an element');
        }
        if ($this->contains($element)) {
            return false;
        }

        return parent::add($element);
    }
}
