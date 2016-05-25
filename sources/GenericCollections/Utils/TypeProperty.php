<?php namespace GenericCollections\Utils;

/**
 * TypeProperty is a ValueObject utility class,
 * the only logic in here is validate the type parameter.
 *
 * @package GenericCollections\Utils
 */
class TypeProperty
{
    /**
     * Store the value type
     *
     * @var string
     */
    private $type;

    /**
     * @param string $type
     */
    public function __construct($type)
    {
        if (empty($type)) {
            throw new \InvalidArgumentException('The type for ' . self::class . ' is empty');
        }
        if (!is_string($type)) {
            throw new \InvalidArgumentException('The type for ' . self::class . ' is not a string');
        }
        $this->type = $type;
    }

    /**
     * Returns the type specification of the values
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
    
    public function __toString()
    {
        return $this->getType();
    }
}
