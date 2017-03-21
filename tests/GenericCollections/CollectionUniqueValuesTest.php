<?php
namespace GenericCollections\Tests;

use GenericCollections\Collection;
use GenericCollections\Options;
use GenericCollections\Tests\Samples\Foo;

/**
 * This only check the Collection methods that behaves
 * different when the option unique values is set:
 *
 * - method add
 */
class CollectionUniqueValuesTest extends \PHPUnit_Framework_TestCase
{
    /** @var Collection */
    private $collection;

    protected function setUp()
    {
        parent::setUp();
        $this->collection = new Collection(Foo::class, [], Options::UNIQUE_VALUES);
    }

    public function testOptionUniqueValuesIsSet()
    {
        $this->assertSame(true, $this->collection->optionUniqueValues());
    }

    public function testAdd()
    {
        $foo = new Samples\Foo(100);

        // first insert is fine
        $this->assertTrue($this->collection->add($foo));

        // second insert returns false
        $this->assertFalse($this->collection->add($foo));

        // contents are correct
        $this->assertEquals([$foo], $this->collection->toArray());

        // insert a non identical but equal object
        $bar = new Samples\Foo(100);
        $this->assertTrue($this->collection->add($bar));

        // contents are correct
        $this->assertEquals([$foo, $bar], $this->collection->toArray());
    }
}
