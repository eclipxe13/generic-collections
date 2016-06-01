<?php namespace GenericCollections\Tests;

use GenericCollections\Options;
use GenericCollections\Queue;
use GenericCollections\Tests\Samples\Foo;

/**
 * This only check the Queue methods that behaves
 * different when the option allow null is set
 */
class QueueAllowNullTest extends \PHPUnit_Framework_TestCase
{
    /** @var Queue */
    private $queue;
    /** @var Foo */
    private $one;
    /** @var Foo */
    private $two;

    protected function setUp()
    {
        parent::setUp();
        $this->one = new Foo(1);
        $this->two = new Foo(2);
        $this->queue = new Queue(Foo::class, [
            $this->one,
            $this->two
        ], Options::ALLOW_NULLS);
    }

    public function testAddNullValues()
    {
        $this->assertTrue($this->queue->add(null));
        $this->assertCount(3, $this->queue);
        $this->assertSame([$this->one, $this->two, null], $this->queue->toArray());

        $this->assertTrue($this->queue->add(null));
        $this->assertCount(4, $this->queue);
        $this->assertSame([$this->one, $this->two, null, null], $this->queue->toArray());
    }

    public function testOfferNullValues()
    {
        $this->assertTrue($this->queue->offer(null));  // [one, two, null]
        $this->assertCount(3, $this->queue);
        $this->assertSame([$this->one, $this->two, null], $this->queue->toArray());

        $this->assertTrue($this->queue->offer(null));  // [one, two, null, null]
        $this->assertCount(4, $this->queue);
        $this->assertSame([$this->one, $this->two, null, null], $this->queue->toArray());
    }

    public function testElement()
    {
        $this->queue->clear(); // []
        $this->queue->add(null); // [null]

        $this->assertNull($this->queue->element());
    }
}
