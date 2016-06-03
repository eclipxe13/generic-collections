<?php namespace GenericCollections\Interfaces;

interface BaseOptions
{
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
