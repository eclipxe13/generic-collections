<?php namespace GenericCollections\Exceptions;

class InvalidValueTypeException extends AbstractInvalidTypeException
{
    protected $propertyName = 'value';
}
