<?php namespace GenericCollections\Tests;

use GenericCollections\Queue;
use GenericCollections\Tests\Samples\Foo;

class QueueTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $queue = new Queue('long');

        $this->assertEquals('long', $queue->getElementType());
        $this->assertEquals(true, $queue->optionComparisonIsIdentical());
        $this->assertEquals(false, $queue->optionAllowNullMembers());
        $this->assertEquals(false, $queue->optionUniqueValues());
        $this->assertEmpty($queue);
        $this->assertCount(0, $queue);
        $this->assertEquals([], $queue->toArray());
    }

    public function testConstructorWithData()
    {
        $phpArray = ['Foo', 'Foo'];
        $queue = new Queue('string', $phpArray);
        $this->assertNotEmpty($queue);
        $this->assertCount(2, $queue);
        $this->assertEquals($phpArray, $queue->toArray());
    }

    public function testClean()
    {
        $queue = new Queue('int', [1, 2, 3, 4]);
        $this->assertNotEmpty($queue);

        $queue->clear();
        $this->assertEmpty($queue);
    }

    public function testAdd()
    {
        $foo = new Foo('Foo Bar');
        $queue = new Queue(Foo::class);

        $this->assertTrue($queue->add($foo));
        $this->assertSame([$foo], $queue->toArray());

        $this->assertTrue($queue->add($foo));
        $this->assertSame([$foo, $foo], $queue->toArray());
    }

    public function testOffer()
    {
        $foo = new Foo('Foo Bar');
        $queue = new Queue(Foo::class);

        $this->assertTrue($queue->offer($foo));
        $this->assertSame([$foo], $queue->toArray());

        $this->assertTrue($queue->offer($foo));
        $this->assertSame([$foo, $foo], $queue->toArray());
    }

    public function testIterateOverQueue()
    {
        $four = new Foo('four');
        $five = new Foo('five');
        $nine = new Foo('nine');
        $elements = [$four, $five, $nine];
        $queue = new Queue(Foo::class, $elements);

        $retrieved = [];
        foreach ($queue as $item) {
            $retrieved[] = $item;
        }

        $this->assertSame($elements, $retrieved);
    }

    public function testElement()
    {
        $four = new Foo('four');
        $five = new Foo('five');
        $nine = new Foo('nine');
        $queue = new Queue(Foo::class, [$four, $five, $nine]);

        $retrieved = $queue->element();
        $this->assertSame($nine, $retrieved);
        $this->assertCount(3, $queue);
    }

    public function testElementWhenEmpty()
    {
        $queue = new Queue(Foo::class);

        $this->expectException(\LogicException::class);
        $this->expectExceptionMessage('Can not get an element from an empty queue');

        $queue->element();
    }

    public function testPeek()
    {
        $queue = new Queue(Foo::class);
        $this->assertNull($queue->peek());

        $four = new Foo('four');
        $five = new Foo('five');
        $nine = new Foo('nine');
        $queue->addAll([$four, $five, $nine]);

        $retrieved = $queue->peek();
        $this->assertSame($nine, $retrieved);
        $this->assertCount(3, $queue);
    }

    public function testRemove()
    {
        $four = new Foo('four');
        $five = new Foo('five');
        $nine = new Foo('nine');
        $queue = new Queue(Foo::class, [$four, $five, $nine]);

        $removed = $queue->remove();
        $this->assertSame($nine, $removed);
        $this->assertCount(2, $queue);
    }

    public function testRemoveWhenEmpty()
    {
        $queue = new Queue(Foo::class);

        $this->expectException(\LogicException::class);
        $this->expectExceptionMessage('Can not remove an element from an empty queue');

        $queue->remove();
    }

    public function testPoll()
    {
        $queue = new Queue(Foo::class);
        $this->assertNull($queue->poll());

        $four = new Foo('four');
        $five = new Foo('five');
        $nine = new Foo('nine');
        $queue->addAll([$four, $five, $nine]);

        $removed = $queue->poll();
        $this->assertSame($nine, $removed);
        $this->assertCount(2, $queue);
    }
}
