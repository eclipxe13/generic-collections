<?php
namespace GenericCollections\Tests;

use GenericCollections\Deque;
use GenericCollections\Exceptions\ContainerNotUniqueMemberException;
use GenericCollections\Options;
use GenericCollections\Tests\Samples\Foo;
use PHPUnit\Framework\TestCase;

/**
 * This only check the Deque methods that behaves
 * different when the option unique values is set:
 *
 * - method add, addFirst and addLast
 * - method offer, offerFirst and offerLast
 */
class DequeUniqueValuesTest extends TestCase
{
    /** @var Deque */
    private $deque;

    private $foo;
    private $bar;
    private $sameAsFoo;

    protected function setUp()
    {
        parent::setUp();
        $this->foo = new Foo('foo');
        $this->bar = new Foo('bar');
        $this->sameAsFoo = $this->foo;
        $this->deque = new Deque(Foo::class, [
            $this->foo,
            $this->bar,
        ], Options::UNIQUE_VALUES);
    }

    public function testConstructorPreserveUniqueValues()
    {
        $this->assertSame(true, $this->deque->optionUniqueValues());
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
        $this->expectException(ContainerNotUniqueMemberException::class);

        $this->deque->{$method}($this->sameAsFoo);
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
        $this->assertSame(false, $this->deque->{$method}($this->sameAsFoo));
    }
}
