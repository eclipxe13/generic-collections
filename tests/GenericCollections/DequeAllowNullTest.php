<?php namespace GenericCollections\Tests;

use GenericCollections\Deque;
use GenericCollections\Options;
use GenericCollections\Tests\Samples\Foo;

/**
 * This only check the Deque methods that behaves
 * different when the option allow null is set:
 *
 * - method add, addFirst and addLast
 * - method offer, offerFirst and offerLast
 */
class DequeAllowNullTest extends \PHPUnit_Framework_TestCase
{
    /** @var Deque */
    private $deque;

    private $foo;
    private $bar;

    protected function setUp()
    {
        parent::setUp();
        $this->foo = new Foo('foo');
        $this->bar = new Foo('bar');
        $this->deque = new Deque(Foo::class, [
            $this->foo,
            $this->bar
        ], Options::ALLOW_NULLS);
    }

    public function testConstructorPreserverOptionAllowNull()
    {
        $this->assertSame(true, $this->deque->optionAllowNullMembers());
        $this->assertSame([
            $this->foo,
            $this->bar,
        ], $this->deque->toArray());
    }

    public function providerAddMethods()
    {
        return [
            ['add'],
            ['addFirst'],
            ['addLast'],
        ];
    }

    /**
     * @param string $method
     * @dataProvider providerAddMethods
     */
    public function testAddDoesNotAllowDuplicatedAndThrowsException($method)
    {
        $this->deque->{$method}(null);
        $this->assertCount(3, $this->deque);
    }

    public function providerOfferMethods()
    {
        return [
            ['offer'],
            ['offerFirst'],
            ['offerLast'],
        ];
    }

    /**
     * @param string $method
     * @dataProvider providerOfferMethods
     */
    public function testOfferDoesNotAllowDuplicated($method)
    {
        $this->assertTrue($this->deque->{$method}(null));
        $this->assertCount(3, $this->deque);
    }
}
