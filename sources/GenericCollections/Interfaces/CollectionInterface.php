<?php namespace GenericCollections\Interfaces;

/**
 * CollectionInterface
 *
 * @link https://docs.oracle.com/javase/7/docs/api/java/util/Collection.html
 * @package GenericCollections\Interfaces
 */
interface CollectionInterface extends InternalDataArray
{
    /**
     * Get the type of the elements on the collection
     *
     * @return string
     */
    public function getElementType();

    /**
     * Check if an specific element is allowed in the collection
     *
     * @param mixed $element
     * @return bool
     */
    public function checkElementType($element);

    /**
     * Returns is the elements in the collections must be compared
     * identical (as of ===) or equal (as of ===)
     *
     * This affect the collection behavior and is required since how PHP compare objects.
     * It won't be necessary if PHP objects have a magic method __equals or similar
     *
     * @return bool
     */
    public function isComparisonIdentical();

    /**
     * Ensures that this collection contains the specified element (optional operation)
     *
     * Return TRUE if the collection change.
     * Must return FALSE is the element was not inserted.
     * Must thow and exception if the element is not a valid type.
     *
     * @param mixed $element
     * @return bool
     */
    public function add($element);

    /**
     * Adds all of the elements in the specified collection to this collection
     *
     * @param array $elements
     * @return bool
     */
    public function addAll(array $elements);

    /**
     * Returns true if this collection contains the specified element.
     * - It can throw an exception if the element is incompatible with this collection
     *
     * @param mixed $element
     * @return bool
     */
    public function contains($element);

    /**
     * Return true if all the elements on the array are contained on this collection
     * An empty elements array must return true.
     *
     * @param array $elements
     * @return bool
     */
    public function containsAll(array $elements);


    /**
     * Return true if at least one element on the array is contained on this collection
     * An empty elements array must return false
     *
     * @param array $elements
     * @return bool
     */
    public function containsAny(array $elements);

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
