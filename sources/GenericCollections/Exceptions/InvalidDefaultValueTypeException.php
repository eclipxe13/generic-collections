<?php
namespace GenericCollections\Exceptions;

class InvalidDefaultValueTypeException extends AbstractInvalidTypeException
{
    protected $propertyName = 'default value';
}
