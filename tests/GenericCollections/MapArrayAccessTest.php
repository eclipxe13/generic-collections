<?php namespace GenericCollections\Tests;

use GenericCollections\Exceptions\InvalidValueTypeException;
use GenericCollections\Map;
use GenericCollections\Tests\Samples\Foo;

/**
 * This class is only used for testing the implementation of \ArrayAccess on Map
 *
 * The shortcuts are:
 * - offsetExist -> containsKey
 * - offsetGet -> get
 * - offsetSet -> put
 * - offsetUnset -> remove
 *
 * @package GenericCollections\Tests
 */
class MapArrayAccessTest extends \PHPUnit_Framework_TestCase
{

    protected $zero;
    protected $four;
    protected $five;
    protected $nine;

    /** @var Map */
    protected $map;

    protected function setUp()
    {
        parent::setUp();
        $this->four = new Foo(4);
        $this->five = new Foo(5);
        $this->map = new Map('string', Foo::class, [
            'four' => $this->four,
            'five' => $this->five,
        ]);
    }

    public function testOffsetGet()
    {
        $this->assertSame($this->four, $this->map['four']);
        $this->assertEquals(clone $this->four, $this->map['four']);
        $this->assertNull($this->map['undefined']);
    }

    public function testOffsetExists()
    {
        $this->assertTrue(isset($this->map['four']));
        $this->assertFalse(isset($this->map['undefined']));
    }

    public function testOffsetSet()
    {
        $nine = new Foo(9);
        $this->assertFalse(isset($this->map['nine']));
        $this->map['nine'] = $nine;
        $this->assertTrue(isset($this->map['nine']));
    }

    public function testOffsetSetWithException()
    {
        $this->expectException(InvalidValueTypeException::class);
        $this->map['ex'] = 'Exception';
    }

    public function testOffsetUnset()
    {
        $this->assertTrue(isset($this->map['four']));
        unset($this->map['four']);
        $this->assertFalse(isset($this->map['four']));
        // double unset do not give any error
        unset($this->map['four']);
    }
}
