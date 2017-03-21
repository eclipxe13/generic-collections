<?php
namespace GenericCollections\Exceptions;

/**
 * AbstractInvalidTypeException
 *
 * This abstract class provides a template for the extended classes:
 * - InvalidKeyTypeException
 * - InvalidElementTypeException
 * - InvalidValueTypeException
 * - InvalidDefaultValueTypeException
 *
 * @package GenericCollections\Exceptions
 */
abstract class AbstractInvalidTypeException extends GenericCollectionsException
{
    /**
     * This property define the name of the property
     * @var string
     */
    protected $propertyName = '';

    /**
     * Invalid Property Type
     *
     * @param string            $container      Description of the container, like 'Map'
     * @param string            $expectedType   Description of the expected type
     * @param mixed             $source         Object name or object that throws the exception
     * @param int               $code           Exception code
     * @param \Exception|null   $previous       Previous exception
     */
    public function __construct($container, $expectedType, $source, $code = 0, \Exception $previous = null)
    {
        $source = (is_object($source)) ? get_class($source) : (is_string($source) ? $source : '(unknown)');
        $message = "Invalid {$this->propertyName} type; the $container $source was expecting a $expectedType type";
        parent::__construct($message, $code, $previous);
    }
}
