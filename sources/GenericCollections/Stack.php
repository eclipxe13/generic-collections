<?php namespace GenericCollections;

use GenericCollections\Abstracts\AbstractStack;
use GenericCollections\Interfaces\StackInterface;
use GenericCollections\Traits\ElementTypeProperty;
use GenericCollections\Traits\OptionsProperty;
use GenericCollections\Utils\TypeProperty;

class Stack extends AbstractStack implements StackInterface
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
        $this->elementType = new TypeProperty($elementType, $this->optionAllowNullMembers());
        $this->createStorageObject();
        $this->addAll($elements);
    }
}
