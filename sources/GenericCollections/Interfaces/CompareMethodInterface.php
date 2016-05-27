<?php namespace GenericCollections\Interfaces;

interface CompareMethodInterface
{
    /**
     * Returns how the elements in the collections must be compared
     * identical (as of ===) otherwise equal (as of ===)
     *
     * This affect the collection behavior and is required since how PHP compare objects.
     * It won't be necessary if PHP objects have a magic method __equals or similar
     *
     * @return bool
     */
    public function comparisonMethodIsIdentical();
}
