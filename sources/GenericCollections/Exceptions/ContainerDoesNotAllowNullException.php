<?php namespace GenericCollections\Exceptions;

class ContainerDoesNotAllowNullException extends GenericCollectionsException
{
    /**
     * ContainerDoesNotAllowNullException constructor.
     *
     * @param string $classType
     * @param string $objectName
     * @param int $code
     * @param \Exception|null $previous
     */
    public function __construct($classType, $objectName, $code = 0, \Exception $previous = null)
    {
        $message = "The $classType $objectName does not allow null";
        parent::__construct($message, $code, $previous);
    }
}
