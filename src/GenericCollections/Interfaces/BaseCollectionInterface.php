<?php
namespace GenericCollections\Interfaces;

use GenericCollections\Internal\StorageInterface;

/**
 * BaseCollectionInterface Interface
 *
 * This methods are implemented in all collections interfaces
 * like Collection and Queue
 *
 * Extends StorageInterface to have the protected $data array storage
 * and basic functions like count() or isEmpty()
 *
 * @package GenericCollections\Interfaces
 */
interface BaseCollectionInterface extends BaseOptionsInterface, StorageInterface
{
    /**
     * Ensures that this collection contains the specified element (optional operation)
     * Returns true if this collection changed as a result of the call.
     * Returns false if this collection does not permit duplicates and
     * already contains the specified element.
     *
     * Collections that support this operation may place limitations on what elements may be added
     * to this collection. In particular, some collections will refuse to add null elements,
     * and others will impose restrictions on the type of elements that may be added.
     * Collection classes should clearly specify in their documentation any restrictions
     * on what elements may be added.
     *
     * If a collection refuses to add a particular element for any reason other than that it already
     * contains the element, it must throw an exception (rather than returning false).
     * This preserves the invariant that a collection always contains the specified element after this call returns.
     *
     * @param mixed $element
     * @return bool Returns true if this collection changed as a result of the call
     */
    public function add($element);

    /**
     * Adds all of the elements in the specified array to this collection
     *
     * @param array $elements
     * @return bool True if this collection changed as a result of the call
     */
    public function addAll(array $elements);

    /**
     * Returns true if this collection contains the specified element.
     * - It can throw an exception if the element is incompatible with this collection
     *
     * @param mixed $element
     * @return bool True if this collection changed as a result of the call
     */
    public function contains($element);

    /**
     * Return true if all the elements on the array are contained on this collection
     * If en empty elements array is passed then return true
     *
     * @param array $elements
     * @return bool True if all elements are contained in this collection
     */
    public function containsAll(array $elements);

    /**
     * Return true if at least one element on the array is contained on this collection
     * If en empty elements array is passed then return false
     *
     * @param array $elements
     * @return bool True if at least one element on the array is contained on this collection
     */
    public function containsAny(array $elements);

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
}
