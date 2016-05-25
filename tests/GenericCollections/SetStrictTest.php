<?php namespace GenericCollections\Tests;

use GenericCollections\Collection;
use GenericCollections\Interfaces\CollectionInterface;
use GenericCollections\Set;

/*
 * As a Set uses the same code as the collection
 * and only changes the add method this is the only thing tested
 */
class SetStrictTest extends \PHPUnit_Framework_TestCase
{

    public function testInheritance()
    {
        $set = new Set('int');
        $this->assertInstanceOf(CollectionInterface::class, $set);
        $this->assertInstanceOf(Collection::class, $set);
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
        $set = new Set(Samples\Foo::class, [], false);

        // are not identical but equal
        $this->assertTrue($set->add(new Samples\Foo(100)));
        $this->assertFalse($set->add(new Samples\Foo(100)));
    }
}
