<?php namespace GenericCollections\Exceptions;

class InvalidElementTypeException extends AbstractInvalidTypeException
{
    protected $propertyName = 'element';
}
