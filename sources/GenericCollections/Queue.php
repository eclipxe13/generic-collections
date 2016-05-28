<?php namespace GenericCollections;

use GenericCollections\Abstracts\AbstractQueue;
use GenericCollections\Traits\ElementTypeProperty;
use GenericCollections\Traits\OptionsProperty;
use GenericCollections\Utils\TypeProperty;

/**
 * Class Queue (FIFO behavior)
 *
 * @package GenericCollections
 */

class Queue extends AbstractQueue
{
    use ElementTypeProperty;
    use OptionsProperty;

    /**
     * Generic collection
     *
     * example: `new Collection(Foo::class, [new Foo(), new Foo()]`
     *
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
