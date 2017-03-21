<?php
namespace GenericCollections\Interfaces;

interface StackInterface extends BaseCollectionInterface
{
    /**
     * Ensures that this queue contains the specified element (optional
     * operation). Returns true if this queue changed as a result of the
     * call. (Returns false if this queue does not permit duplicates and
     * already contains the specified element.)
     *
     * Queues that support this operation may place limitations on what
     * elements may be added to this queue. In particular, some
     * queues will refuse to add null elements, and others will impose
     * restrictions on the type of elements that may be added. Queue
     * classes should clearly specify in their documentation any restrictions
     * on what elements may be added.
     *
     * If a queue refuses to add a particular element for any reason other
     * than that it already contains the element, it must throw an exception
     * (rather than returning false). This preserves the invariant that a
     * queue always contains the specified element after this call returns.
     *
     * @param mixed $element
     * @return bool true if this queue changed as a result of the call
     */
    public function add($element);

    /**
     * Inserts the specified element into this queue if it is possible to do so
     * immediately without violating capacity restrictions. When using a
     * capacity-restricted queue, this method is generally preferable to add(E),
     * which can fail to insert an element only by throwing an exception.
     *
     * @param $element
     * @return mixed true if the element was added to this queue
     */
    public function offer($element);

    /**
     * Retrieves, but does not remove, the head of this queue. This method
     * differs from peek only in that it throws an exception if this queue is empty.
     *
     * @return mixed the head of this queue
     */
    public function element();

    /**
     * Retrieves, but does not remove, the head of this queue, or returns null
     * if this queue is empty.
     *
     * @return mixed|null the head of this queue, or null if this queue is empty
     */
    public function peek();

    /**
     * Retrieves and removes the head of this queue. This method differs
     * from poll only in that it throws an exception if this queue is empty.
     *
     * @return mixed the head of this queue
     */
    public function remove();

    /**
     * Retrieves and removes the head of this queue, or returns null
     * if this queue is empty.
     *
     * @return mixed|null the head of this queue, or null if this queue is empty
     */
    public function poll();
}
