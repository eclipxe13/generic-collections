<?php namespace GenericCollections\Tests;

use GenericCollections\Deque;
use GenericCollections\Interfaces\DequeInterface;
use GenericCollections\Tests\Samples\Foo;

/**
 * Test a Deque with default behavior:
 * - do not allow nulls
 * - strict comparisons
 * - allow duplicates
 *
 * Other tests must be created for other options
 */
class DequeDefaultTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Use an empty deque<foo> for testing
     * @var DequeInterface
     */
    private $deque;

    private $first;
    private $second;

    protected function setUp()
    {
        parent::setUp();
        $this->deque = new Deque(Foo::class);
    }

    private function populateDeque()
    {
        $this->first = new Foo('first');
        $this->second = new Foo('second');
        $this->deque->addAll([$this->first, $this->second]);
    }

    public function testConstructWithType()
    {
        $this->assertEquals(Foo::class, $this->deque->getElementType());
        $this->assertEmpty($this->deque);
        $this->assertCount(0, $this->deque);
        $this->assertSame([], $this->deque->toArray());
        $this->assertSame(true, $this->deque->optionComparisonIsIdentical());
        $this->assertSame(false, $this->deque->optionAllowNullMembers());
        $this->assertSame(false, $this->deque->optionUniqueValues());
    }

    public function testAddFirst()
    {
        $foo = new Foo('foo');
        $bar = new Foo('bar');
        $this->deque->addFirst($foo);
        $this->deque->addFirst($bar);

        $this->assertSame([$bar, $foo], $this->deque->toArray());
    }

    public function testAddLast()
    {
        $foo = new Foo('foo');
        $bar = new Foo('bar');
        $this->deque->addLast($foo);
        $this->deque->addLast($bar);

        $this->assertSame([$foo, $bar], $this->deque->toArray());
    }

    public function testAdd()
    {
        $foo = new Foo('foo');
        $bar = new Foo('bar');

        $this->assertTrue($this->deque->add($foo));
        $this->assertTrue($this->deque->add($bar));

        $this->assertSame([$foo, $bar], $this->deque->toArray());
    }

    public function providerAddOfferMethods()
    {
        return [
            ['add'], ['addFirst'], ['addLast'], ['offer'], ['offerFirst'], ['offerLast']
        ];
    }

    /**
     * @param string $method
     * @dataProvider providerAddOfferMethods
     */
    public function testDequeDoNotAllowNulls($method)
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('The deque does not allow null elements');

        $this->deque->{$method}(null);
    }

    /**
     * @param string $method
     * @dataProvider providerAddOfferMethods
     */
    public function testDequeThrowsExceptionOnInvalidType($method)
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessageRegExp('/Invalid element type; the deque (.*) was expecting a (.*) type/');

        $this->deque->{$method}(new \stdClass());
    }

    public function testAddAll()
    {
        $foo = new Foo('foo');
        $bar = new Foo('bar');
        $this->assertTrue($this->deque->addAll([$foo, $bar]));
        $this->assertSame([$foo, $bar], $this->deque->toArray());
    }

    public function testConstructorWithContents()
    {
        $expectedArray = [new Foo(1), new Foo(2)];
        $deque = new Deque(Foo::class, $expectedArray);
        $this->assertSame($expectedArray, $deque->toArray());
    }

    public function testAssertCount()
    {
        $this->populateDeque();
        $this->assertCount(2, $this->deque);
        $this->assertNotEmpty($this->deque);
    }

    public function testAssertClear()
    {
        $this->populateDeque();
        $this->deque->clear();
        $this->assertCount(0, $this->deque);
        $this->assertEmpty($this->deque);
    }

    /**
     * addFirst return void, offerFirst return true
     */
    public function testOfferFirst()
    {
        $foo = new Foo('foo');
        $bar = new Foo('bar');

        $this->assertTrue($this->deque->offerFirst($foo));
        $this->assertTrue($this->deque->offerFirst($bar));

        $this->assertSame([$bar, $foo], $this->deque->toArray());
    }

    /**
     * addLast return void, offerLast return true
     */
    public function testOfferLast()
    {
        $foo = new Foo('foo');
        $bar = new Foo('bar');

        $this->assertTrue($this->deque->offerLast($foo));
        $this->assertTrue($this->deque->offerLast($bar));

        $this->assertSame([$foo, $bar], $this->deque->toArray());
    }

    /**
     * offer is basically the same as add without exceptions on duplicates
     */
    public function testOffer()
    {
        $foo = new Foo('foo');
        $bar = new Foo('bar');

        $this->assertTrue($this->deque->offer($foo));
        $this->assertTrue($this->deque->offer($bar));

        $this->assertSame([$foo, $bar], $this->deque->toArray());
    }

    public function testGetFirst()
    {
        $this->populateDeque();
        $this->assertSame($this->first, $this->deque->getFirst());
        $this->assertCount(2, $this->deque);
    }

    public function testGetLast()
    {
        $this->populateDeque();
        $this->assertSame($this->second, $this->deque->getLast());
        $this->assertCount(2, $this->deque);
    }

    public function testElement()
    {
        $this->populateDeque();
        $this->assertSame($this->first, $this->deque->element());
        $this->assertCount(2, $this->deque);
    }

    public function testGetFirstThrowExceptionWhenEmpty()
    {
        $this->expectException(\LogicException::class);
        $this->expectExceptionMessage('Can not get an element from an empty deque');
        $this->deque->getFirst();
    }

    public function testGetLastThrowExceptionWhenEmpty()
    {
        $this->expectException(\LogicException::class);
        $this->expectExceptionMessage('Can not get an element from an empty deque');
        $this->deque->getLast();
    }

    public function testElementThrowExceptionWhenEmpty()
    {
        $this->expectException(\LogicException::class);
        $this->expectExceptionMessage('Can not get an element from an empty deque');
        $this->deque->element();
    }

    public function testPeekFirst()
    {
        $this->assertNull($this->deque->peekFirst());
        $this->populateDeque();
        $this->assertSame($this->first, $this->deque->peekFirst());
        $this->assertCount(2, $this->deque);
    }

    public function testPeekLast()
    {
        $this->assertNull($this->deque->peekLast());
        $this->populateDeque();
        $this->assertSame($this->second, $this->deque->peekLast());
        $this->assertCount(2, $this->deque);
    }

    public function testPeek()
    {
        $this->assertNull($this->deque->peek());
        $this->populateDeque();
        $this->assertSame($this->first, $this->deque->peek());
        $this->assertCount(2, $this->deque);
    }

    public function testRemoveFirst()
    {
        $this->populateDeque();
        $this->assertSame($this->first, $this->deque->removeFirst());
        $this->assertSame([$this->second], $this->deque->toArray());
    }

    public function testRemoveLast()
    {
        $this->populateDeque();
        $this->assertSame($this->second, $this->deque->removeLast());
        $this->assertSame([$this->first], $this->deque->toArray());
    }

    public function testRemove()
    {
        $this->populateDeque();
        $this->assertSame($this->first, $this->deque->remove());
        $this->assertSame([$this->second], $this->deque->toArray());
    }

    public function testRemoveFirstThrowExceptionWhenEmpty()
    {
        $this->expectException(\LogicException::class);
        $this->expectExceptionMessage('Can not remove an element from an empty deque');
        $this->deque->removeFirst();
    }

    public function testRemoveLastThrowExceptionWhenEmpty()
    {
        $this->expectException(\LogicException::class);
        $this->expectExceptionMessage('Can not remove an element from an empty deque');
        $this->deque->removeLast();
    }

    public function testRemoveThrowExceptionWhenEmpty()
    {
        $this->expectException(\LogicException::class);
        $this->expectExceptionMessage('Can not remove an element from an empty deque');
        $this->deque->remove();
    }

    public function testPollFirst()
    {
        $this->assertNull($this->deque->pollFirst());
        $this->populateDeque();
        $this->assertSame($this->first, $this->deque->pollFirst());
        $this->assertSame([$this->second], $this->deque->toArray());
    }

    public function testPollLast()
    {
        $this->assertNull($this->deque->pollLast());
        $this->populateDeque();
        $this->assertSame($this->second, $this->deque->pollLast());
        $this->assertSame([$this->first], $this->deque->toArray());
    }

    public function testPoll()
    {
        $this->assertNull($this->deque->poll());
        $this->populateDeque();
        $this->assertSame($this->first, $this->deque->poll());
        $this->assertSame([$this->second], $this->deque->toArray());
    }

    public function testContains()
    {
        $this->populateDeque();

        $this->assertTrue($this->deque->contains($this->first));
        $this->assertTrue($this->deque->contains($this->second));
        $this->assertFalse($this->deque->contains(new Foo('non existent')));

        $similar = clone($this->first);
        $this->assertFalse($this->deque->contains($similar));
    }

    /**
     * @param string $method
     * @dataProvider providerAddOfferMethods
     */
    public function testDequeAllowsDuplicatedMembers($method)
    {
        $this->populateDeque();

        $this->deque->{$method}($this->first);
        $this->assertCount(3, $this->deque);
    }

    public function testDequeGetIterator()
    {
        $this->populateDeque();
        $iterations = 0;
        $array = [];
        foreach ($this->deque as $key => $value) {
            $array[$key] = $value;
            $iterations = $iterations + 1;
        }
        $expectedArray = [$this->first, $this->second];
        $this->assertEquals(2, $iterations);
        $this->assertSame($expectedArray, $array);
    }
}
