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
            throw new \InvalidArgumentException('The type for ' . get_class($this) . ' is empty');
        }
        if (!is_string($type)) {
            throw new \InvalidArgumentException('The type for ' . get_class($this) . ' is not a string');
        }
        $allowed = $this->getAllowedTypes();
        if (is_array($allowed) && count($allowed) && ! in_array($type, $allowed, true)) {
            throw new \InvalidArgumentException(
                'The type ' . $type . ' for ' . get_class($this) . ' is not a allowed'
            );
        }
        $this->type = $type;
    }

    /**
     * Return the allowed types for this property.
     * Its used for the validations inside the constructor.
     *
     * To restict to a certain types return the array with the list of types
     *
     * If a non array is returned then any type is allowed
     *
     * @return array|null
     */
    public function getAllowedTypes()
    {
        return null;
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
