<?php
namespace GenericCollections\Traits;

/**
 * Class OptionsProperty
 * Used in almost every first level class
 *
 * @package GenericCollections\Traits
 */
trait OptionsProperty
{
    /**
     * Options object
     * @var \GenericCollections\Options
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
