<?php
namespace GenericCollections;

use GenericCollections\Exceptions\GenericCollectionsException;
use GenericCollections\Interfaces\StackInterface;
use GenericCollections\Tests\Samples\Foo;

/**
 * Test a Stack
 *
 * Since Stack is an implementation of Deque but only with appropiate methods
 * to add, push, element, peek, remove and poll then only LIFO behavior
 * will be tested
 */
class StackTest extends \PHPUnit_Framework_TestCase
{
    /** @var StackInterface */
    private $stack;
    private $first;
    private $second;

    protected function setUp()
    {
        parent::setUp();
        $this->first = new Foo('first');
        $this->second = new Foo('second');
        $this->stack = new Stack(Foo::class);
    }

    private function populateStack()
    {
        $this->stack->add($this->first);
        $this->stack->add($this->second);
    }

    public function testDefaultConstructor()
    {
        $this->assertInstanceOf(StackInterface::class, $this->stack);
        $this->assertSame(Foo::class, $this->stack->getElementType());
        $this->assertSame(false, $this->stack->optionAllowNullMembers());
        $this->assertSame(false, $this->stack->optionUniqueValues());
        $this->assertSame(true, $this->stack->optionComparisonIsIdentical());
    }

    public function testAddThrowsAnExceptionThatUsesTheInternalName()
    {
        $this->expectException(GenericCollectionsException::class);
        $this->expectExceptionMessage('The stack ');
        $this->stack->add(null);
    }

    public function testAddAttatchTheElementsOnIndexZero()
    {
        $this->assertTrue($this->stack->add($this->first));
        $this->assertTrue($this->stack->add($this->second));
        $this->assertSame([$this->second, $this->first], $this->stack->toArray());
    }

    public function testAttatchTheElementsOnIndexZero()
    {
        $this->assertTrue($this->stack->offer($this->first));
        $this->assertTrue($this->stack->offer($this->second));
        $this->assertSame([$this->second, $this->first], $this->stack->toArray());
    }

    public function testElementRetrievesTheLastElement()
    {
        $this->populateStack();
        $this->assertSame($this->second, $this->stack->element());
        $this->assertCount(2, $this->stack);
    }

    public function testPeekRetrievesTheLastElement()
    {
        $this->populateStack();
        $this->assertSame($this->second, $this->stack->element());
        $this->assertCount(2, $this->stack);
    }

    public function testRemoveTakeTheLastElement()
    {
        $this->populateStack();
        $this->assertSame($this->second, $this->stack->remove());
        $this->assertCount(1, $this->stack);
    }

    public function testPollTakeTheLastElement()
    {
        $this->populateStack();
        $this->assertSame($this->second, $this->stack->poll());
        $this->assertCount(1, $this->stack);
    }
}
