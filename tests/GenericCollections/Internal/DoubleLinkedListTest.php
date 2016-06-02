<?php namespace GenericCollections\Internal;

use GenericCollections\Tests\Samples\Foo;

class DoubleLinkedListTest extends \PHPUnit_Framework_TestCase
{
    /** @var  DoubleLinkedList */
    private $doubleLinkedList;

    private $foo;
    private $bar;
    private $nonExistent;
    private $similarFoo;

    protected function setUp()
    {
        parent::setUp();
        $this->foo = new Foo('Foo');
        $this->bar = new Foo('Bar');
        $this->nonExistent = new Foo('Not existent');
        $this->similarFoo = new Foo('Foo');
        $this->createDoubleLinkedListIdentical();
    }

    private function createDoubleLinkedListIdentical()
    {
        $this->doubleLinkedList = new DoubleLinkedList(true);
        $this->doubleLinkedList->push($this->foo);
        $this->doubleLinkedList->push($this->bar);
    }

    private function createDoubleLinkedListEqual()
    {
        $this->doubleLinkedList = new DoubleLinkedList(false);
        $this->doubleLinkedList->push($this->foo);
        $this->doubleLinkedList->push($this->bar);
    }

    public function testDoubleLinkedListExtendsSplClass()
    {
        $this->assertInstanceOf(\SplDoublyLinkedList::class, $this->doubleLinkedList);
    }

    public function testLastIndex()
    {
        $this->assertCount(2, $this->doubleLinkedList);
        $this->assertSame(1, $this->doubleLinkedList->lastIndex());

        $emptyDoubleLinkedList = new DoubleLinkedList(true);
        $this->assertSame(-1, $emptyDoubleLinkedList->lastIndex());
    }

    public function testSearch()
    {
        $this->assertSame(-1, $this->doubleLinkedList->search($this->nonExistent));
        $this->assertSame(-1, $this->doubleLinkedList->search($this->similarFoo));
        $this->assertSame(1, $this->doubleLinkedList->search($this->bar));
        $this->assertSame(0, $this->doubleLinkedList->search($this->foo));
    }

    public function testContains()
    {
        $this->assertFalse($this->doubleLinkedList->contains($this->nonExistent));
        $this->assertFalse($this->doubleLinkedList->contains($this->similarFoo));
        $this->assertTrue($this->doubleLinkedList->contains($this->bar));
        $this->assertTrue($this->doubleLinkedList->contains($this->foo));
    }

    public function testSearchEqualComparison()
    {
        $this->createDoubleLinkedListEqual();
        $this->assertSame(-1, $this->doubleLinkedList->search($this->nonExistent));
        $this->assertSame(0, $this->doubleLinkedList->search($this->similarFoo));
        $this->assertSame(1, $this->doubleLinkedList->search($this->bar));
        $this->assertSame(0, $this->doubleLinkedList->search($this->foo));
    }

    public function testContainsEqualComparison()
    {
        $this->createDoubleLinkedListEqual();
        $this->assertFalse($this->doubleLinkedList->contains($this->nonExistent));
        $this->assertTrue($this->doubleLinkedList->contains($this->similarFoo));
        $this->assertTrue($this->doubleLinkedList->contains($this->bar));
        $this->assertTrue($this->doubleLinkedList->contains($this->foo));
    }
}
