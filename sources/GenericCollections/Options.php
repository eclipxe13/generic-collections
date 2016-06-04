<?php namespace GenericCollections;

use GenericCollections\Exceptions\OptionsException;
use GenericCollections\Interfaces\BaseOptionsInterface;

/**
 * This class implements the BaseOptionsInterface
 *
 * Is a ValueObject (read-only) that defines the the container behavior
 *
 * @package GenericCollections
 */
class Options implements BaseOptionsInterface
{
    const UNIQUE_VALUES    = 1;
    const ALLOW_NULLS      = 2;
    const COMPARISON_EQUAL = 4;

    /** @var bool null members property */
    private $allowNullMembers;

    /** @var bool duplicates property */
    private $uniqueValues;

    /** @var bool comparison is identical */
    private $comparisonIsIdentical;

    /** @var int original options value */
    private $options;

    /**
     * Create a Options object based on a numeric value
     *
     * @param int $options
     */
    public function __construct($options)
    {
        if (!is_integer($options)) {
            throw new OptionsException('The supplied options value is not an integer');
        }
        $options                     = $options & 7; // truncate to max value (3 ^ 2 - 1)
        $this->options               = $options;
        $this->allowNullMembers      = (bool) ($options & self::ALLOW_NULLS);
        $this->uniqueValues          = (bool) ($options & self::UNIQUE_VALUES);
        $this->comparisonIsIdentical = ! (bool) ($options & self::COMPARISON_EQUAL);
    }

    public function optionAllowNullMembers()
    {
        return $this->allowNullMembers;
    }

    public function optionUniqueValues()
    {
        return $this->uniqueValues;
    }

    public function optionComparisonIsIdentical()
    {
        return $this->comparisonIsIdentical;
    }

    /**
     * Return the options value
     *
     * @return int
     */
    public function getOptions()
    {
        return $this->options;
    }
}
