<?php namespace GenericCollections\Traits;

trait QueueFifoMethods
{
    abstract protected function addLast($element);
    abstract protected function offerLast($element);
    
    public function add($element)
    {
        $this->addLast($element);
        return true;
    }

    public function offer($element)
    {
        return $this->offerLast($element);
    }
}
