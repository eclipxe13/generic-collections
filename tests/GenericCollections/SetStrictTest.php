<?php namespace GenericCollections\Tests;

use GenericCollections\Collection;
use GenericCollections\Interfaces\CollectionInterface;
use GenericCollections\Options;
use GenericCollections\Set;

/**
 * Set is a Collection's extended class.
 * It only overrides the constructor to deny duplicates
 */
class SetTest extends \PHPUnit_Framework_TestCase
{

    public function testConstructor()
    {
        $set = new Set('int');
        $this->assertInstanceOf(CollectionInterface::class, $set);
        $this->assertInstanceOf(Collection::class, $set);
        $this->assertSame(true, $set->optionUniqueValues());
        $this->assertSame(false, $set->optionAllowNullMembers());
        $this->assertSame(true, $set->optionComparisonIsIdentical());
    }

    public function testAdd()
    {
        $foo = new Samples\Foo(100);
        $set = new Set(Samples\Foo::class);

        // first insert is fine
        $this->assertTrue($set->add($foo));

        // second insert returns false
        $this->assertFalse($set->add($foo));

        // contents are correct
        $this->assertEquals([$foo], $set->toArray());

        // insert a non identical but equal object
        $bar = new Samples\Foo(100);
        $this->assertTrue($set->add($bar));
    }

    public function testAddWithEqual()
    {
        $set = new Set(Samples\Foo::class, [], Options::COMPARISON_EQUAL);

        // are not identical but equal
        $this->assertTrue($set->add(new Samples\Foo(100)));
        $this->assertFalse($set->add(new Samples\Foo(100)));
    }
}
