<?php namespace GenericCollections\Traits;

/**
 * Class StackLifoMethods
 *
 * @method void addLast(mixed $element)
 * @method bool offerLast(mixed $element)
 *
 * @package GenericCollections\Traits
 */
trait StackLifoMethods
{
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
