<?php
namespace GenericCollections\Tests;

use GenericCollections\Collection;
use GenericCollections\Options;
use GenericCollections\Tests\Samples\Foo;

/**
 * This only check the Collection methods that behaves
 * different when the option comparison equal is set:
 *
 * - contains
 * - remove
 * - retainAll
 */
class CollectionEqualTest extends \PHPUnit_Framework_TestCase
{
    /** @var Collection */
    private $collection;

    protected function setUp()
    {
        parent::setUp();
        $this->collection = new Collection(Foo::class, [], Options::COMPARISON_EQUAL);
    }

    public function testConstructWithEqual()
    {
        $this->assertSame(false, $this->collection->optionComparisonIsIdentical());
    }

    public function testContains()
    {
        $this->collection->add(new Foo(123));

        $this->assertTrue($this->collection->contains(new Foo(123)));
        $this->assertFalse($this->collection->contains(new Foo(0)));
    }

    public function testRetailAll()
    {
        $this->collection->addAll([
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
        $this->assertTrue($this->collection->retainAll($expected));
        $this->assertEquals($expected, $this->collection->toArray());

        // return false since it didn't change
        $this->assertFalse($this->collection->retainAll($expected));
    }

    public function testRemove()
    {
        $this->collection->addAll([
            new Foo(200),
            new Foo(200),
            new Foo(200),
        ]);

        // item not found
        $this->assertFalse($this->collection->remove(new Foo(-100)));

        // item found
        $this->assertTrue($this->collection->remove(new Foo(200)));

        // the collection must have other 2 items
        $this->assertCount(2, $this->collection);
    }
}
