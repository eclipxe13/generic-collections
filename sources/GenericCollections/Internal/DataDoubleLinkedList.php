<?php namespace GenericCollections\Internal;

abstract class DataDoubleLinkedList implements StorageInterface
{
    /**
     * Local storage for members
     *
     * @var DoubleLinkedList
     */
    protected $storage;

    /**
     * Create a new empty DoubleLinkedList and set it
     * on protected variable $storage
     *
     * @return void
     */
    abstract protected function createStorageObject();

    public function clear()
    {
        $this->storage->clear();
    }

    public function isEmpty()
    {
        return $this->storage->isEmpty();
    }

    public function toArray()
    {
        $array = [];
        foreach ($this->storage as $element) {
            $array[] = $element;
        }
        return $array;
    }

    public function count()
    {
        return $this->storage->count();
    }

    public function getIterator()
    {
        return new \IteratorIterator($this->storage);
    }
}
