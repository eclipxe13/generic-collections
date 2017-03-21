<?php
namespace GenericCollections\Internal;

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
        $this->doubleLinkedList = new DoubleLinkedList();
        $this->doubleLinkedList->push($this->foo);
        $this->doubleLinkedList->push($this->bar);
    }

    private function createDoubleLinkedListEqual()
    {
        $this->doubleLinkedList->strictComparisonOff();
    }

    public function testDoubleLinkedListExtendsSplClass()
    {
        $this->assertInstanceOf(\SplDoublyLinkedList::class, $this->doubleLinkedList);
    }

    public function testConstructorDefaultComparison()
    {
        $this->assertTrue($this->doubleLinkedList->getStrictComparison());
    }

    public function testStrictComparisonOnOff()
    {
        // turn on (should be the default)
        $this->doubleLinkedList->strictComparisonOn();
        $this->assertTrue($this->doubleLinkedList->getStrictComparison());

        // turn off
        $this->doubleLinkedList->strictComparisonOff();
        $this->assertFalse($this->doubleLinkedList->getStrictComparison());

        // turn on (after off)
        $this->doubleLinkedList->strictComparisonOn();
        $this->assertTrue($this->doubleLinkedList->getStrictComparison());
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
