<?php
namespace GenericCollections\Internal;

/**
 * This is a double linked list that contains elements by position
 *
 * It extends \SplDoublyLinkedList and add this methods:
 * - contains: return if the value is found in the list
 * - search: search for a value in the list, return the index
 * - clear: clear the list
 *
 * The search depends on the flag strictComparison.
 * If is TRUE then the comparison is identical (===), this is the default behavior
 * If is FALSE then the comparison is equal (==)
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
    private $strict = true;

    public function strictComparisonOn()
    {
        $this->strict = true;
    }

    public function strictComparisonOff()
    {
        $this->strict = false;
    }

    public function getStrictComparison()
    {
        return $this->strict;
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
        $position = -1;
        if (! $this->isEmpty()) {
            foreach ($this as $index => $current) {
                if (($this->strict) ? $current === $element : $current == $element) {
                    $position = $index;
                    break;
                }
            }
        }
        return $position;
    }

    /**
     * Clear the contents of the container
     *
     * There is a bug & patch for SplDoublyLinkedList https://bugs.php.net/bug.php?id=60759
     * that does the same operation (pop until count == 0)
     */
    public function clear()
    {
        while ($this->count() > 0) {
            $this->pop();
        }
    }
}
