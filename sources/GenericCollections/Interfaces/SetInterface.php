<?php namespace GenericCollections\Interfaces;

/**
 * SetInterface
 *
 * @link https://docs.oracle.com/javase/7/docs/api/java/util/set.html
 * @package GenericCollections\Interfaces
 */
interface SetInterface extends CollectionInterface
{
    /**
     * Adds the specified element if it is not already present (optional operation)
     *
     * Return TRUE if the collection change.
     * Must return FALSE is the element was not inserted.
     * Must thow and exception if the element is not a valid type.
     *
     * Returns true if this set did not already contain the specified element
     *
     * @param mixed $element
     * @return bool
     */
    public function add($element);

    /**
     * Adds all of the elements in the specified collection to this set
     * if they're not already present
     *
     * Returns true if this set changed as a result of the call
     *
     * @param array $elements
     * @return bool
     */
    public function addAll(array $elements);
}
