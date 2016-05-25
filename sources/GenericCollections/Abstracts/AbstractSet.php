<?php namespace GenericCollections\Abstracts;

use GenericCollections\Interfaces\SetInterface;

abstract class AbstractSet extends AbstractCollection implements SetInterface
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
