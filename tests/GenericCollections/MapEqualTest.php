<?php namespace GenericCollections\Tests;

use GenericCollections\Map;
use GenericCollections\Tests\Samples\Foo;

/*
 *
 * The map is fully tested, what we have to check here is
 * the methods that depends on this behavior, wich are:
 * - containsValue: in_array, isComparisonIdentical
 * - removeExact: isComparisonIdentical
 * - replaceExact: isComparisonIdentical
 *
 */
class MapEqualTest extends \PHPUnit_Framework_TestCase
{
    protected function newFooMapWithEqualComparisons()
    {
        return new Map('string', Foo::class, [], false);
    }

    public function testConstruct()
    {
        $map = $this->newFooMapWithEqualComparisons();

        $this->assertFalse($map->isComparisonIdentical(), 'The map non-identical says the opposite');
    }

    public function testContainsValue()
    {
        // the two objects are not the same but are equals
        $bar = new Foo('foobar');
        $foo = new Foo('foobar');
        $non = new Foo('non existent');
        $this->assertEquals($bar, $foo);
        $this->assertNotSame($bar, $foo);

        $map = $this->newFooMapWithEqualComparisons();
        $map->put('', $bar);
        $this->assertTrue($map->containsValue($bar));
        $this->assertTrue($map->containsValue($foo));
        $this->assertFalse($map->containsValue($non));
    }

    public function testRemoveExact()
    {
        $bar = new Foo('foobar');
        $foo = new Foo('foobar');
        $new = new Foo('New value');
        $map = $this->newFooMapWithEqualComparisons();

        // insert foobar => $bar
        $map->put('foobar', $bar);

        // replaceExact with a not-found value
        $this->assertFalse($map->replaceExact('foobar', new Foo('not found'), $new));

        // replaceExact <foobar, $foo> with $new
        // $bar and $foo are equals but not the same
        $this->assertTrue($map->replaceExact('foobar', $foo, $new));

        // the last operation must return $bar
        $inserted = $map->get('foobar');
        $this->assertSame($inserted, $new);
    }
}
