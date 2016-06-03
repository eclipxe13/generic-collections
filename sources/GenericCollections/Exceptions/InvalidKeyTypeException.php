<?php namespace GenericCollections\Exceptions;

class InvalidKeyTypeException extends AbstractInvalidTypeException
{
    protected $propertyName = 'key';
}
