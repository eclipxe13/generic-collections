<?php namespace GenericCollections\Interfaces;

use GenericCollections\Collection;
use GenericCollections\Set;

interface MapInterface extends InternalDataArray
{
    /**
     * Get the type of the values on the map
     *
     * @return string
     */
    public function getValueType();

    /**
     * Check if an specific value is allowed in the map
     *
     * @param mixed $value
     * @return bool
     */
    public function checkValueType($value);

    /**
     * Get the type of the values on the map
     *
     * @return string
     */
    public function getKeyType();

    /**
     * Check if an specific value is allowed in the map
     *
     * @param mixed $key
     * @return bool
     */
    public function checkKeyType($key);

    /**
     * Returns how the values in the map must be compared
     * identical (as of ===) otherwise equal (as of ===)
     *
     * The keys are always compared identically
     *
     * This affect the collection behavior and is required since how PHP compare objects.
     * It won't be necessary if PHP objects have a magic method __equals or similar
     *
     * @return bool
     */
    public function isComparisonIdentical();


    /**
     * Returns true if this map contains a mapping for the specified key.
     * The comparison on keys are always strict/identical
     *
     * @param mixed $key
     * @return bool
     */
    public function containsKey($key);

    /**
     * Returns true if this map maps one or more keys to the specified value.
     *
     * @param mixed $value
     * @return bool
     */
    public function containsValue($value);

    /**
     * Returns the value to which the specified key is mapped
     * or null if this map contains no mapping for the key.
     *
     * @param mixed $key
     * @return mixed
     */
    public function get($key);

    /**
     * Returns the value to which the specified key is mapped
     * or $default if this map contains no mapping for the key.
     *
     * This method must check that the $default is the correct type
     * before returning it, but allows null as $default
     *
     * @param mixed $key
     * @param mixed $default
     * @return mixed
     */
    public function getOrDefault($key, $default);

    /**
     * Returns an array of the keys contained in this map
     *
     * @return array
     */
    public function keys();

    /**
     * Associates the specified value with the specified key in this map (optional operation).
     * Returns the previous value associated with key
     *
     * @param $key
     * @param $value
     * @return mixed|null
     */
    public function put($key, $value);

    /**
     * Put all of the mappings from the specified array to this map (optional operation).
     *
     * @param array $values
     * @return void
     */
    public function putAll(array $values);

    /**
     * If the specified key is not already associated with a value (or is mapped to null)
     * associates it with the given value and returns null, else returns the current value.
     *
     * @param mixed $key
     * @param mixed $value
     * @return mixed|null
     */
    public function putIfAbsent($key, $value);

    /**
     * Removes the mapping for a key from this map if it is present (optional operation).
     *
     * Returns the value to which this map previously associated the key,
     * or null if the map contained no mapping for the key.
     *
     * @param mixed $key
     * @return mixed|null
     */
    public function remove($key);

    /**
     * Removes the mapping for a key from this map if it is present
     * and value is equal (depends on comparison method)
     *
     * Returns true if this map change
     *
     * @param mixed $key
     * @param mixed $value
     * @return bool
     */
    public function removeExact($key, $value);

    /**
     * Put an association to the key to a new value
     * only if the map contains the key
     *
     * Returns null if the map does not have the key,
     * otherwise returns the previous value associated with key
     *
     * @param mixed $key
     * @param mixed $value
     * @return mixed|null
     */
    public function replace($key, $value);

    /**
     * Put an association to the key to a new value
     * only if the map contains the key and is the same value
     *
     * Returns true if the replace was made
     *
     * @param mixed $key
     * @param mixed $current
     * @param mixed $replacement
     * @return bool
     */
    public function replaceExact($key, $current, $replacement);

    /**
     * Returns a generic set with the keys
     *
     * @return Set
     */
    public function keysSet();

    /**
     * Returns a generic set with the keys
     *
     * @return Collection
     */
    public function valuesCollection();
}
