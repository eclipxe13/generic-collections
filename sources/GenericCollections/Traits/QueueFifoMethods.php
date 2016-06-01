<?php namespace GenericCollections\Traits;

/**
 * Class QueueFifoMethods
 *
 * @method void addLast(mixed $element)
 * @method bool offerLast(mixed $element)
 *
 * @package GenericCollections\Traits
 */
trait QueueFifoMethods
{
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
