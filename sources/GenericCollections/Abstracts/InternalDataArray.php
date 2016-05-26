<?php namespace GenericCollections\Abstracts;

use GenericCollections\Interfaces\InternalDataArray as InternalDataArrayInterface;

/**
 * This is a internal class to implement a protected property $data
 * that works like the internal storage for classes on this package.
 *
 * It also contains small methods to work with the array as a variable,
 * not in its contains. This follow the InternalDataArrayInterface
 *
 * @package GenericCollections\Abstracts
 */
abstract class InternalDataArray implements InternalDataArrayInterface
{
    /**
     * Local storage for members
     *
     * @var array
     */
    protected $data = [];

    public function isEmpty()
    {
        return (0 === count($this->data));
    }

    public function toArray()
    {
        return $this->data;
    }

    public function clear()
    {
        $this->data = [];
    }

    /**
     * @inheritdoc
     */
    public function count()
    {
        return count($this->data);
    }

    /**
     * @inheritdoc
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->data);
    }
}
