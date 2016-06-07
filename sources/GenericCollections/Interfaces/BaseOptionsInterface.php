<?php namespace GenericCollections\Interfaces;

interface BaseOptionsInterface
{
    /**
     * Option to set the object to only allow unique values (no duplicates).
     *
     * @var int
     */
    const UNIQUE_VALUES = 1;

    /**
     * Option to set the object to allow null members.
     *
     * If this option is set and UNIQUE_VALUES is set then only one NULL value will be allowed.
     *
     * @var int
     */
    const ALLOW_NULLS = 2;

    /**
     * Option to set comparison to equality instead of identity.
     *
     * It is not recommended to use this option since several methods return NULL when
     * perform some action.
     *
     * @var int
     */
    const COMPARISON_EQUAL = 4;

    /**
     * Defines if the container allow null members
     * additionally to its own type
     *
     * @return bool
     */
    public function optionAllowNullMembers();

    /**
     * Define if the container allow duplicate members
     *
     * @return bool
     */
    public function optionUniqueValues();

    /**
     * Define if the comparison between members is identical or equal
     *
     * @return bool
     */
    public function optionComparisonIsIdentical();
}
