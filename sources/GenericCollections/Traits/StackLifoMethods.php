<?php namespace GenericCollections\Traits;

trait StackLifoMethods
{
    abstract protected function addFirst($element);
    abstract protected function offerFirst($element);

    public function add($element)
    {
        $this->addFirst($element);
        return true;
    }

    public function offer($element)
    {
        return $this->offerFirst($element);
    }
}
