<?php namespace GenericCollections\Tests;

use GenericCollections\Map;
use GenericCollections\Options;
use GenericCollections\Tests\Samples\Foo;

/**
 * This only check the Map methods that behaves
 * different when the option comparison equal is set
 *
 * - containsValue: in_array, comparisonMethodIsIdentical
 * - removeExact: comparisonMethodIsIdentical
 * - replaceExact: comparisonMethodIsIdentical
 */
class MapEqualTest extends \PHPUnit_Framework_TestCase
{
    protected function newFooMapWithEqualComparisons()
    {
        return new Map('string', Foo::class, [], Options::COMPARISON_EQUAL);
    }

    public function testConstruct()
    {
        $map = $this->newFooMapWithEqualComparisons();

        $this->assertFalse($map->optionComparisonIsIdentical(), 'The map non-identical says the opposite');
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
