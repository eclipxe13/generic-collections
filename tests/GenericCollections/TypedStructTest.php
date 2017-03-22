<?php
namespace GenericCollections\Tests;

use GenericCollections\Exceptions\TypePropertyException;
use GenericCollections\TypedStruct;
use GenericCollections\Utils\TypeProperty;
use PHPUnit\Framework\TestCase;

class TypedStructTest extends TestCase
{
    public function testConstructor()
    {
        $struct = new TypedStruct([]);
        $this->assertInstanceOf(TypedStruct::class, $struct);
        $this->assertInstanceOf(\ArrayAccess::class, $struct);
        $this->assertInstanceOf(\Traversable::class, $struct);
        $this->assertInstanceOf(\Countable::class, $struct);
        $this->assertCount(0, $struct);
        $this->assertEquals([], $struct->getDefinitions());
    }

    public function testConstructorWithDefinitions()
    {
        $definitions = [
            'id' => 'int',
            'name' => 'string',
            'birth' => \DateTimeInterface::class,
        ];
        $struct = new TypedStruct($definitions);
        $this->assertCount(3, $struct);
        $retrieved = $struct->getDefinitions();
        $this->assertCount(3, $retrieved);
        foreach ($definitions as $key => $type) {
            $this->assertArrayHasKey($key, $retrieved);
            /** @var TypeProperty $typeprop */
            $typeprop = $retrieved[$key];
            $this->assertInstanceOf(TypeProperty::class, $typeprop);
            $this->assertEquals($type, $typeprop->getType());
            $this->assertNull($struct->get($key));
        }
    }

    public function testConstructorWithValues()
    {
        $definitions = [
            'id' => 'int',
            'name' => 'string',
            'birth' => \DateTimeInterface::class,
        ];
        $values = [
            'id' => 999,
            'name' => 'Foo Bar',
            'birth' => new \DateTimeImmutable('1980-01-13'),
        ];
        $struct = new TypedStruct($definitions, $values);
        $this->assertEquals($values, $struct->getValues());
    }

    public function testIteratorAccess()
    {
        $definitions = [
            'id' => 'int',
            'name' => 'string',
            'birth' => \DateTimeInterface::class,
        ];
        $values = [
            'id' => 999,
            'name' => 'Foo Bar',
            'birth' => new \DateTimeImmutable('1980-01-13'),
        ];
        $struct = new TypedStruct($definitions, $values);
        foreach ($struct as $key => $value) {
            $this->assertArrayHasKey($key, $values);
            $this->assertSame($values[$key], $value);
        }
    }

    public function testConstructThrowsInvalidDefinitionKeyFound()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid definition key found');
        new TypedStruct([null]);
    }

    public function testConstructThrowsInvalidDefinitionTypeFound()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid definition type found');
        new TypedStruct(['foo' => null]);
    }

    public function testSetThrowExceptionWithInvalidType()
    {
        $this->expectException(TypePropertyException::class);
        $this->expectExceptionMessage("Definition 'foo' only allows type 'string'");
        new TypedStruct(['foo' => 'string'], ['foo' => new \stdClass()]);
    }

    public function testSetThrowExceptionWithKeyNotFound()
    {
        $struct = new TypedStruct(['foo' => 'string']);

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("Definition 'bar' does not exists");
        $struct->set('bar', null);
    }

    public function testGetThrowExceptionWithKeyNotFound()
    {
        $struct = new TypedStruct(['foo' => 'string']);

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("Definition 'bar' does not exists");
        $struct->get('bar');
    }

    public function testArrayAccessOffsetExists()
    {
        $struct = new TypedStruct(['foo' => 'string'], ['foo' => 'Foo']);

        $this->assertTrue(isset($struct['foo']));
        $this->assertFalse(isset($struct['bar']));
    }

    public function testArrayAccessOffsetGet()
    {
        $struct = new TypedStruct(['foo' => 'string'], ['foo' => 'Foo']);
        $this->assertEquals('Foo', $struct['foo']);
    }

    public function testArrayAccessOffsetSet()
    {
        $struct = new TypedStruct(['foo' => 'string'], ['foo' => 'Foo']);
        $struct['foo'] = 'Bar';
        $this->assertEquals('Bar', $struct['foo']);
    }

    public function testArrayAccessOffsetUnset()
    {
        $struct = new TypedStruct(['foo' => 'string'], ['foo' => 'Foo']);
        unset($struct['foo']);
        $this->assertFalse(isset($struct['foo']));
        $this->assertEquals(null, $struct['foo']);
    }

    public function testPropertyAccessGet()
    {
        $struct = new TypedStruct(['foo' => 'string'], ['foo' => 'Foo']);
        $this->assertEquals('Foo', $struct->{'foo'});
    }

    public function testPropertyAccessSet()
    {
        $struct = new TypedStruct(['foo' => 'string'], ['foo' => 'Foo']);
        $struct->{'foo'} = 'Bar';
        $this->assertEquals('Bar', $struct->{'foo'});
    }

    public function testPropertyAccessIsset()
    {
        $struct = new TypedStruct(['foo' => 'string'], ['foo' => 'Foo']);
        $this->assertTrue(isset($struct->{'foo'}));
        $this->assertFalse(isset($struct->{'bar'}));
    }
    public function testPropertyAccessUnset()
    {
        $struct = new TypedStruct(['foo' => 'string'], ['foo' => 'Foo']);
        unset($struct->{'foo'});
        $this->assertFalse(isset($struct->{'foo'}));
        $this->assertEquals(null, $struct->{'foo'});
    }
}
