<?php
namespace GenericCollections\Exceptions;

class ContainerNotUniqueMemberException extends GenericCollectionsException
{
    /**
     * ContainerNotUniqueMemberException constructor.
     *
     * @param string $classType
     * @param string $objectName
     * @param int $code
     * @param \Exception|null $previous
     */
    public function __construct($classType, $objectName, $code = 0, \Exception $previous = null)
    {
        $message = "The $classType $objectName must contain unique members";
        parent::__construct($message, $code, $previous);
    }
}
