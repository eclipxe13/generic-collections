<?php namespace GenericCollections\Interfaces;

interface InternalDataArray extends CompareMethodInterface, \Countable, \IteratorAggregate
{
    /**
     * Removes all of the elements from this collection (optional operation).
     * The collection will be empty after this method returns.
     *
     * @return void
     */
    public function clear();

    /**
     * Returns true if this collection contains no elements.
     *
     * @return bool
     */
    public function isEmpty();

    /**
     * Get the collection elements as an array
     *
     * @return array
     */
    public function toArray();
}
