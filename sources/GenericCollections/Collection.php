<?php namespace GenericCollections;

use GenericCollections\Abstracts\AbstractCollection;
use GenericCollections\Traits\ElementTypeProperty;
use GenericCollections\Traits\OptionsProperty;
use GenericCollections\Utils\TypeProperty;

/**
 * Generic collection implementation
 *
 * Options:
 * - Defaults: not allow nulls, allow duplicates, identical comparisons
 *
 * @package GenericCollections
 */
class Collection extends AbstractCollection
{
    use ElementTypeProperty;
    use OptionsProperty;

    /**
     * @param string $elementType
     * @param array $elements
     * @param int $options
     */
    public function __construct($elementType, array $elements = [], $options = 0)
    {
        $this->options = new Options($options);
        $this->elementType = new TypeProperty($elementType, $this->options->optionAllowNullMembers());
        $this->addAll($elements);
    }
}
