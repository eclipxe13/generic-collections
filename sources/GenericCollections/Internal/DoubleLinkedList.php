<?php namespace GenericCollections\Internal;

/**
 * This is a linked list that contains elements indexed by number
 *
 * It extends \SplDoublyLinkedList to be able to search inside
 *
 * @package GenericCollections\Internal
 */
class DoubleLinkedList extends \SplDoublyLinkedList
{
    /**
     * Set if the search inside the storage must be identical (true) or equal (false)
     *
     * @var bool
     */
    private $strict;
    
    public function __construct($strict)
    {
        $this->strict = (bool) $strict;
    }

    /**
     * Return the count of items minus one.
     * If the storage is empty return -1
     *
     * @return int
     */
    public function lastIndex()
    {
        return $this->count() - 1;
    }

    /**
     * Returns TRUE if the element exist in the storage
     *
     * @param mixed $element
     * @return bool
     */
    public function contains($element)
    {
        return (-1 !== $this->search($element));
    }
    
    /**
     * Perform a linear search inside the storage,
     * because the elements contained are not sorted.
     *
     * Return the index of the element found, -1 if not found
     *
     * @param $element
     * @return int
     */
    public function search($element)
    {
        if ($this->isEmpty()) {
            return -1;
        }
        $current = 0;
        $position = -1;
        $this->rewind();
        while ($this->valid()) {
            if (($this->strict) ? $this->current() === $element : $this->current() == $element) {
                $position = $current;
                break;
            }
            $current = $current + 1;
            $this->next();
        }
        return $position;
    }
}
