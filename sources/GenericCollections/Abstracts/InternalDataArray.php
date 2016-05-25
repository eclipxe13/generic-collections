<?php namespace GenericCollections\Abstracts;

use GenericCollections\Interfaces\InternalDataArray as InternalDataArrayInterface;

/**
 * Implementation
 *
 * @package GenericCollections\Abstracts
 * @access protected
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
