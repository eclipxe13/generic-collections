<?php namespace GenericCollections\Interfaces;

/**
 * CollectionInterface
 *
 * @link https://docs.oracle.com/javase/7/docs/api/java/util/Collection.html
 * @package GenericCollections\Interfaces
 */
interface CollectionInterface extends BaseCollectionInterface
{
    /**
     * Ensures that this collection contains the specified element (optional operation)
     *
     * Must throw and exception if the element is not a valid type.
     *
     * @param mixed $element
     * @return bool Returns true if this collection changed as a result of the call
     */
    public function add($element);

    /**
     * Removes a single instance of the specified element from this collection,
     * if it is present (optional operation).
     * Returns true if this collection changed as a result of the call
     *
     * @param mixed $element
     * @return bool
     */
    public function remove($element);

    /**
     * Removes all instances of the specified elements from this collection,
     * if it is present (optional operation).
     * Returns true if this collection changed as a result of the call
     *
     * @param array $elements
     * @return bool
     */
    public function removeAll(array $elements);

    /**
     * Removes all of the elements of this collection that satisfy the given predicate.
     * The predicate is a callable which returns true for elements to be removed.
     * Returns true if any elements were removed
     *
     * @param callable $callable
     * @return bool
     */
    public function removeIf(callable $callable);

    /**
     * Retains only the elements in this collection that are contained in the array
     * Returns true if this collection changed as a result of the call
     *
     * @param array $elements
     * @return bool
     */
    public function retainAll(array $elements);
}
