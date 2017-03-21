<?php
namespace GenericCollections\Tests;

use GenericCollections\Exceptions\GenericCollectionsException;
use GenericCollections\Interfaces\QueueInterface;
use GenericCollections\Queue;
use GenericCollections\Tests\Samples\Foo;

/**
 * Test a Queue
 *
 * Since Queue is an implementation of Deque but only with appropiate methods
 * to add, push, element, peek, remove and poll then only LIFO behavior
 * will be tested
 */
class QueueTest extends \PHPUnit_Framework_TestCase
{
    /** @var QueueInterface */
    private $queue;
    private $first;
    private $second;

    protected function setUp()
    {
        parent::setUp();
        $this->first = new Foo('first');
        $this->second = new Foo('second');
        $this->queue = new Queue(Foo::class);
    }

    private function populateQueue()
    {
        $this->queue->add($this->first);
        $this->queue->add($this->second);
    }

    public function testDefaultConstructor()
    {
        $this->assertInstanceOf(QueueInterface::class, $this->queue);
        $this->assertSame(Foo::class, $this->queue->getElementType());
        $this->assertSame(false, $this->queue->optionAllowNullMembers());
        $this->assertSame(false, $this->queue->optionUniqueValues());
        $this->assertSame(true, $this->queue->optionComparisonIsIdentical());
    }

    public function testAddThrowsAnExceptionThatUsesTheInternalName()
    {
        $this->expectException(GenericCollectionsException::class);
        $this->expectExceptionMessage('The queue ');
        $this->queue->add(null);
    }

    public function testAddAttatchTheElementsOnIndexZero()
    {
        $this->assertTrue($this->queue->add($this->first));
        $this->assertTrue($this->queue->add($this->second));
        $this->assertSame([$this->first, $this->second], $this->queue->toArray());
    }

    public function testAttatchTheElementsOnIndexZero()
    {
        $this->assertTrue($this->queue->offer($this->first));
        $this->assertTrue($this->queue->offer($this->second));
        $this->assertSame([$this->first, $this->second], $this->queue->toArray());
    }

    public function testElementRetrievesTheLastElement()
    {
        $this->populateQueue();
        $this->assertSame($this->first, $this->queue->element());
        $this->assertCount(2, $this->queue);
    }

    public function testPeekRetrievesTheLastElement()
    {
        $this->populateQueue();
        $this->assertSame($this->first, $this->queue->element());
        $this->assertCount(2, $this->queue);
    }

    public function testRemoveTakeTheLastElement()
    {
        $this->populateQueue();
        $this->assertSame($this->first, $this->queue->remove());
        $this->assertCount(1, $this->queue);
    }

    public function testPollTakeTheLastElement()
    {
        $this->populateQueue();
        $this->assertSame($this->first, $this->queue->poll());
        $this->assertCount(1, $this->queue);
    }
}
