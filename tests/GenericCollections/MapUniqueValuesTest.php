<?php namespace GenericCollections\Tests;

use GenericCollections\Map;
use GenericCollections\Options;
use GenericCollections\Tests\Samples\Foo;

/**
 * This only check the Map methods that behaves
 * different when the option unique values is set
 *
 * - add
 */
class MapUniqueValuesTest extends \PHPUnit_Framework_TestCase
{
    /** @var Map */
    private $map;

    protected function setUp()
    {
        parent::setUp();
        $this->map = new Map('string', Foo::class, [], Options::UNIQUE_VALUES);
    }

    public function testHasUniqueValuesOptionSet()
    {
        $this->assertSame(true, $this->map->optionUniqueValues());
    }

    public function testAdd()
    {
        $foo = new Foo('foo');
        $this->assertNull($this->map->put('foo', $foo));

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessageRegExp(
            '/The value provided for (.*)::put is not unique, this map does not allow duplicated values./'
        );
        
        $this->assertNull($this->map->put('duplicated', $foo));
    }
}