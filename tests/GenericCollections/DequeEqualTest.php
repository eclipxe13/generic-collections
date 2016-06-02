<?php namespace GenericCollections\Tests;

use GenericCollections\Deque;
use GenericCollections\Options;
use GenericCollections\Tests\Samples\Foo;

/**
 * This only check the Deque methods that behaves
 * different when the option comparison equal is set:
 *
 * This is determined by the constructor of the internal
 * storage, so we will test using the method contains
 */
class DequeEqualTest extends \PHPUnit_Framework_TestCase
{
    /** @var Deque */
    private $deque;

    private $foo;
    private $bar;
    private $equalToFoo;

    protected function setUp()
    {
        parent::setUp();
        $this->foo = new Foo('foo');
        $this->bar = new Foo('bar');
        $this->equalToFoo = clone $this->foo;
        $this->deque = new Deque(Foo::class, [
            $this->foo,
            $this->bar
        ], Options::COMPARISON_EQUAL);
    }

    public function testConstructorPreserveUniqueValues()
    {
        $this->assertSame(false, $this->deque->optionComparisonIsIdentical());
        $this->assertSame([
            $this->foo,
            $this->bar,
        ], $this->deque->toArray());
    }

    public function testCheckComparisonUsingContains()
    {
        // identical value
        $this->assertTrue($this->deque->contains($this->foo));

        // equal value
        $this->assertTrue($this->deque->contains($this->equalToFoo));

        // different value
        $this->assertFalse($this->deque->contains(new Foo('different')));
    }
}
