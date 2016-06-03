<?php namespace GenericCollections\Tests;

use GenericCollections\Collection;
use GenericCollections\Exceptions\InvalidDefaultValueTypeException;
use GenericCollections\Exceptions\InvalidKeyTypeException;
use GenericCollections\Exceptions\InvalidValueTypeException;
use GenericCollections\Exceptions\TypePropertyException;
use GenericCollections\Interfaces\MapInterface;
use GenericCollections\Internal\StorageInterface;
use GenericCollections\Map;
use GenericCollections\Set;
use GenericCollections\Tests\Samples\Foo;

/**
 * Test a Map with default behavior:
 * - do not allow nulls
 * - strict comparisons
 * - allow duplicates
 *
 * Other tests must be created for other options
 */
class MapDefaultTest extends \PHPUnit_Framework_TestCase
{
    protected $zero;
    protected $four;
    protected $five;

    protected function setUp()
    {
        parent::setUp();
        // WARNING: do not edit this values, the tests depends on this
        $this->zero = new Foo(0);
        $this->four = new Foo(4);
        $this->five = new Foo(5);
    }


    public function createMapStringFoo()
    {
        // WARNING: do not edit this structure
        return new Map('string', Foo::class, [
            'zero' => $this->zero,
            'four' => $this->four,
            'five' => $this->five,
        ]);
    }

    public function testConstruct()
    {
        $map = new Map('int', 'string');

        $this->assertInstanceOf(MapInterface::class, $map);
        $this->assertInstanceOf(StorageInterface::class, $map);

        $this->assertEquals('int', $map->getKeyType());
        $this->assertEquals('string', $map->getValueType());

        $this->assertEmpty($map->toArray());
        $this->assertEquals([], $map->toArray());
        $this->assertCount(0, $map);

        $this->assertSame(true, $map->optionComparisonIsIdentical());
    }

    public function testConstructWithBadKeyType()
    {
        $this->expectException(TypePropertyException::class);
        $this->expectExceptionMessageRegExp('/The type (.*) is not allowed/');

        new Map(\stdClass::class, 'int');
    }

    public function testPut()
    {
        $foo = new Foo(1);
        $map = new Map('string', Foo::class);

        // put an enterely new key-value
        $this->assertNull($map->put('foo', $foo));
        $this->assertNotEmpty($map->toArray());
        $this->assertSame(['foo' => $foo], $map->toArray());
        $this->assertCount(1, $map);

        // put and return foo
        $previous = $map->put('foo', new Foo(1));
        $this->assertNotNull($previous);
        $this->assertSame($foo, $previous);
    }

    public function testPutWithInvalidKey()
    {
        $map = new Map('string', Foo::class);

        $this->expectException(InvalidKeyTypeException::class);

        $this->assertNull($map->put(1, new Foo(0)));
    }

    public function testPutWithInvalidValue()
    {
        $map = new Map('string', Foo::class);

        $this->expectException(InvalidValueTypeException::class);

        $map->put('foo', null);
    }

    public function testPutIfAbsent()
    {
        $map = new Map('string', Foo::class, [
            'zero' => $this->zero,
            'four' => $this->four,
        ]);

        // put if absent when absent
        $this->assertNull($map->putIfAbsent('five', $this->five));

        // put if absent when exists
        $returned = $map->putIfAbsent('five', new Foo(9));
        $this->assertNotNull($returned);
        $this->assertSame($this->five, $returned);
    }

    public function testPutAll()
    {
        $expected = [
            'one' => new Foo(1),
            'two' => new Foo(2),
        ];
        $map = new Map('string', Foo::class);
        $map->putAll($expected);

        $this->assertSame($expected, $map->toArray());
        $this->assertCount(2, $map);
    }

    public function testConstructWithArray()
    {
        $expected = [
            'one' => new Foo(1),
            'two' => new Foo(2),
        ];

        $map = new Map('string', Foo::class, $expected);
        $this->assertSame($expected, $map->toArray());
    }

    public function testContainsKeys()
    {
        $map = new Map('int', 'int', [
            0 => 9,
            1 => 8,
            2 => 7,
            3 => 6,
        ]);

        $this->assertFalse($map->containsKey('invalid'));
        $this->assertFalse($map->containsKey('2'), 'A non strict comparison was made casting string 2 to int 2');
        $this->assertTrue($map->containsKey(2));
    }

    public function testContainsValues()
    {
        $map = $this->createMapStringFoo();

        // check invalid type
        $this->assertFalse($map->containsValue(4));

        // check not in array value
        $this->assertFalse($map->containsValue(new Foo(100)));

        // check not in array (different identity)
        $this->assertFalse($map->containsValue(new Foo(4)));

        // check in array (same identity)
        $this->assertTrue($map->containsValue($this->four));
    }

    public function testGet()
    {
        $map = new Map('string', Foo::class);
        $nine = new Foo(99);
        $map->put('4', new Foo(44));
        $map->put('nine', $nine);

        $this->assertNull($map->get('non-existent'));
        $this->assertNull($map->get(4), 'Found "(int) 4" in keys, but key is "(string) 4".');
        $this->assertNull($map->get(1.23), 'Sending an incorrect type does not return NULL.');

        $retrieved = $map->get('nine');
        $this->assertNotNull($retrieved);
        $this->assertSame($nine, $retrieved);
    }

    public function testGetOrDefault()
    {
        $map = new Map('string', Foo::class);
        $nine = new Foo(9);
        $four = new Foo(4);
        $default = new Foo(-1);
        $map->putAll([
            'nine' => $nine,
            'four' => $four,
        ]);

        $this->assertSame($nine, $map->getOrDefault('nine', $default));
        $this->assertSame($default, $map->getOrDefault('non-existent', $default));

        // allow return null for default
        $this->assertNull($map->getOrDefault('non-existent', null));

        // receive an exception for invalid type
        $this->expectException(InvalidDefaultValueTypeException::class);
        $map->getOrDefault('non-existent', new \stdClass());
    }

    public function testKeys()
    {
        $map = new Map('string', 'int');
        $map->put('9', 1);
        $map->put('8', 2);
        $map->put('7', 3);
        $expected = ['9', '8', '7'];
        $this->assertEquals($expected, $map->keys());
    }

    public function testRemove()
    {
        $map = $this->createMapStringFoo();

        // remove a non existent key
        $this->assertNull($map->remove('non-existent'));

        // remove an existent key
        $removed = $map->remove('four');
        $this->assertCount(2, $map);
        $this->assertSame($this->four, $removed);
    }

    public function testRemoveExact()
    {
        $map = $this->createMapStringFoo();

        // remove a non matching key
        $this->assertFalse($map->removeExact('non-existent', $this->four));

        // remove a matching key but non matching value
        $this->assertFalse($map->removeExact('zero', $this->four));

        // remove an existent key and value
        $this->assertTrue($map->removeExact('four', $this->four));
        $this->assertCount(2, $map);
    }

    public function testReplace()
    {
        $map = $this->createMapStringFoo();

        // replace non existent key
        $this->assertNull($map->replace('non-existent', $this->zero));

        // replace existent key
        $replaced = $map->replace('zero', $this->five);
        $this->assertSame($this->zero, $replaced, 'The returned value of replace does not match');
        $this->assertCount(3, $map, 'The size of the map changed after replace');
        $this->assertSame($this->five, $map->get('zero'), 'The value in the map was not replaced');
    }

    public function testReplaceExact()
    {
        $map = $this->createMapStringFoo();

        // replace non existent key, existent value
        $this->assertFalse($map->replaceExact('non-existent', $this->four, $this->zero));

        // replace existent key, non existent value
        $this->assertFalse($map->replaceExact('zero', new Foo(0), $this->five));

        // replace existent key, existent value
        $nine = new Foo(9);
        $this->assertTrue($map->replaceExact('zero', $this->zero, $nine));
        $this->assertSame($nine, $map->get('zero'));
    }

    public function testKeysSet()
    {
        $map = $this->createMapStringFoo();
        $expected = new Set('string', ['zero', 'four', 'five']);

        $this->assertEquals($expected, $map->keysSet());
        $this->assertSame($expected->toArray(), $map->keysSet()->toArray());
    }

    public function testValuesCollection()
    {
        $map = $this->createMapStringFoo();
        $expected = new Collection(Foo::class, [
            $this->zero,
            $this->four,
            $this->five,
        ]);

        $this->assertEquals($expected, $map->valuesCollection());
        $this->assertSame($expected->toArray(), $map->valuesCollection()->toArray());
    }
}
