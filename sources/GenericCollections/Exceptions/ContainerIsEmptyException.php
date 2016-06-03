<?php namespace GenericCollections\Exceptions;

class ContainerIsEmptyException extends GenericCollectionsException
{
    /**
     * ContainerIsEmptyException constructor.
     *
     * @param string $container
     * @param int $action
     * @param int $code
     * @param \Exception|null $previous
     */
    public function __construct($container, $action, $code = 0, \Exception $previous = null)
    {
        $message = "Can not $action an element from an empty $container";
        parent::__construct($message, $code, $previous);
    }
}
