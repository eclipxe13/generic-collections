<?php namespace GenericCollections\Tests\Utils;

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
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessageRegExp('/The type for (.*) is empty/');

        new TypeProperty(null);
    }

    public function testValueTypeWithNonString()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessageRegExp('/The type for (.*) is not a string/');

        new TypeProperty(123);
    }
}
