<?php namespace GenericCollections\Traits;

use GenericCollections\Options;

/**
 * Class OptionsProperty
 * used in almost every first level class
 *
 * @mixin \GenericCollections\Collection
 *
 * @package GenericCollections\Traits
 */
trait OptionsProperty
{
    /**
     * Options object
     * @var Options
     */
    private $options;

    public function optionAllowNullMembers()
    {
        return $this->options->optionAllowNullMembers();
    }

    public function optionUniqueValues()
    {
        return $this->options->optionUniqueValues();
    }

    public function optionComparisonIsIdentical()
    {
        return $this->options->optionComparisonIsIdentical();
    }
}
