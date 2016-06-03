<?php namespace GenericCollections\Tests\Utils;

use GenericCollections\Exceptions\TypePropertyException;
use GenericCollections\Utils\TypeProperty;

class TypePropertyTest extends \PHPUnit_Framework_TestCase
{
    public function testGetValueType()
    {
        $expectedType = 'integer';

        $obj = new TypeProperty($expectedType);

        $this->assertEquals($expectedType, $obj->getType());
    }

    public function testValueTypeWithEmpty()
    {
        $this->expectException(TypePropertyException::class);
        $this->expectExceptionMessage('is empty');

        new TypeProperty(null);
    }

    public function testValueTypeWithNonString()
    {
        $this->expectException(TypePropertyException::class);
        $this->expectExceptionMessage('is not a string');

        new TypeProperty(123);
    }
}
