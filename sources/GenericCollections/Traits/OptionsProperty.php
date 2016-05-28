<?php namespace GenericCollections\Traits;

use GenericCollections\Options;

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
