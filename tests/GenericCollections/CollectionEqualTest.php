<?php namespace GenericCollections\Tests;

use GenericCollections\Collection;
use GenericCollections\Tests\Samples\Foo;

/*
 * This only check the methods that behaves different
 * when comparisons are equal
 */
class CollectionEqualTest extends \PHPUnit_Framework_TestCase
{

    protected function newFooCollection()
    {
        return new Collection(Foo::class, [], false);
    }

    public function testConstructWithEqual()
    {
        $col = $this->newFooCollection();

        $this->assertSame(false, $col->comparisonMethodIsIdentical());
    }

    public function testContains()
    {
        $col = $this->newFooCollection();
        $col->add(new Foo(123));

        $this->assertTrue($col->contains(new Foo(123)));
        $this->assertFalse($col->contains(new Foo(0)));
    }

    public function testRetailAll()
    {
        $col = $this->newFooCollection();
        $col->addAll([
            new Foo(100),
            new Foo(200),
            new Foo(300),
            new Foo(400),
        ]);
        $expected = [
            new Foo(200),
            new Foo(300),
        ];

        // return true and reduce the collection to only the expected
        $this->assertTrue($col->retainAll($expected));
        $this->assertEquals($expected, $col->toArray());

        // return false since it didn't change
        $this->assertFalse($col->retainAll($expected));
    }

    public function testRemove()
    {
        $col = $this->newFooCollection();
        $col->addAll([
            new Foo(200),
            new Foo(200),
            new Foo(200),
        ]);

        // item not found
        $this->assertFalse($col->remove(new Foo(-100)));

        // item found
        $this->assertTrue($col->remove(new Foo(200)));
        
        // the collection must have other 2 items
        $this->assertCount(2, $col);
    }
}
