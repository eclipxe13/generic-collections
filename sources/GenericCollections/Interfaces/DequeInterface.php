<?php namespace GenericCollections\Interfaces;

interface DequeInterface extends QueueInterface
{
    /**
     * Inserts the specified element at the front of this deque if it is possible to do so
     * immediately without violating capacity restrictions.
     *
     * If a restriction is found then it throw an exception, by example:
     * - the element is not the correct type
     * - the deque does not allow null members
     * - the deque does not allow duplicated values
     *
     * @param mixed $element
     * @return void
     */
    public function addFirst($element);

    /**
     * Inserts the specified element at the end of this deque if it is possible to do so
     * immediately without violating capacity restrictions.
     *
     * If any restriction is found then it throw an exception, by example:
     * - the element is not the correct type
     * - the deque does not allow null members
     * - the deque does not allow duplicated values
     *
     * @param mixed $element
     * @return void
     */
    public function addLast($element);

    /**
     * Inserts the specified element at the front of this deque unless it would violate capacity restrictions.
     *
     * Return false if a restriction is foundother than the element is not the correct type
     * or the element is null and the deque does not allow nulls
     *
     * @param mixed $element
     * @return bool true if this deque changed as a result of the call
     */
    public function offerFirst($element);

    /**
     * Inserts the specified element at the end of this deque unless it would violate capacity restrictions.
     *
     * Return false if a restriction is found, other than the element is not the correct type.
     *
     * @param mixed $element
     * @return bool true if this deque changed as a result of the call
     */
    public function offerLast($element);

    /**
     * Retrieves, but does not remove, the fisrt element of this deque. This method
     * differs from peekFirst only in that it throws an exception if this deque is empty.
     *
     * @return mixed the first element of this deque
     */
    public function getFirst();

    /**
     * Retrieves, but does not remove, the fisrt element of this deque. This method
     * differs from peekLast only in that it throws an exception if this deque is empty.
     *
     * @return mixed the last element of this deque
     */
    public function getLast();

    /**
     * Retrieves, but does not remove, the first element of this deque, or returns null
     * if this deque is empty.
     *
     * @return mixed|null the first element of this deque, or null if this deque is empty
     */
    public function peekFirst();

    /**
     * Retrieves, but does not remove, the last element of this deque, or returns null
     * if this deque is empty.
     *
     * @return mixed|null the last element of this deque, or null if this deque is empty
     */
    public function peekLast();

    /**
     * Retrieves and removes the first element of this deque. This method differs
     * from pollFirst only in that it throws an exception if this deque is empty.
     *
     * @return mixed the removed element
     */
    public function removeFirst();

    /**
     * Retrieves and removes the last element of this deque. This method differs
     * from pollLast only in that it throws an exception if this deque is empty.
     *
     * @return mixed the removed element
     */
    public function removeLast();

    /**
     * Retrieves and removes the first element of this deque, or returns null
     * if this deque is empty.
     *
     * @return mixed|null the removed element, or null if this deque is empty
     */
    public function pollFirst();
    
    /**
     * Retrieves and removes the last element of this deque, or returns null
     * if this deque is empty.
     *
     * @return mixed|null the removed element, or null if this deque is empty
     */
    public function pollLast();
}
