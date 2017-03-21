<?php
namespace GenericCollections\Tests;

use GenericCollections\Collection;
use GenericCollections\Exceptions\InvalidElementTypeException;
use GenericCollections\Tests\Samples\Foo;

/**
 * Test a Collection with default behavior:
 * - do not allow nulls
 * - strict comparisons
 * - allow duplicates
 *
 * Other tests must be created for other options
 */
class CollectionDefaultTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructWithType()
    {
        $col = new Collection('int');

        $this->assertEquals('int', $col->getElementType());
        $this->assertInternalType('array', $col->toArray());
        $this->assertEquals([], $col->toArray());
        $this->assertSame(true, $col->optionComparisonIsIdentical());
        $this->assertSame(false, $col->optionAllowNullMembers());
        $this->assertSame(false, $col->optionUniqueValues());
    }

    public function testAdd()
    {
        $col = new Collection('int');
        $this->assertTrue($col->add(9));
        $this->assertEquals([9], $col->toArray());
    }

    public function testAddWithWrongType()
    {
        $col = new Collection('int');
        $this->expectException(InvalidElementTypeException::class);
        $this->assertTrue($col->add('foo'));
    }

    public function testCount()
    {
        $col = new Collection('int');
        $col->add(9);
        $col->add(9);
        $col->add(9);

        $this->assertCount(3, $col);
    }

    public function testAddAll()
    {
        $phpArray = [1, 2, 3];
        $col = new Collection('int');
        $this->assertTrue($col->addAll($phpArray));
        $this->assertEquals($phpArray, $col->toArray());
    }

    public function testConstructWithData()
    {
        $phpArray = [1, 2, 3];
        $col = new Collection('int', $phpArray);
        $this->assertEquals($phpArray, $col->toArray());
    }

    public function testClear()
    {
        $col = new Collection('int', [1, 2, 3]);
        $this->assertCount(3, $col);

        $col->clear();

        $this->assertCount(0, $col);
        $this->assertEquals([], $col->toArray());
    }

    public function testGetIterator()
    {
        $iterated = [];
        $first = new Foo(1); // equal to $one, but not the same;
        $one = new Foo(1);
        $two = new Foo(0);
        $expected = [
            $first,
            $one,
            $two,
        ];
        $col = new Collection(Foo::class, $expected);

        $this->assertInstanceOf(\IteratorAggregate::class, $col);
        $iterator = $col->getIterator();

        foreach ($iterator as $element) {
            $this->assertInstanceOf(Foo::class, $element);
            $iterated[] = $element;
        }
        $this->assertCount(3, $iterated);
        $this->assertSame($expected, $iterated);
        $this->assertSame($expected, $col->toArray());
    }

    public function testIsEmpty()
    {
        $col = new Collection('int');
        $this->assertTrue($col->isEmpty());
        $this->assertEmpty($col);

        $col->add(0);
        $this->assertFalse($col->isEmpty());
        $this->assertNotEmpty($col);
    }

    public function testContainsScalarValues()
    {
        $col = new Collection('int', [-3, 3]);
        $this->assertFalse($col->contains(9));

        $col->add(9);
        $this->assertTrue($col->contains(9));
    }

    public function testContainsObjects()
    {
        $onehundred = new Samples\Foo(100);
        $twohundred = new Samples\Foo(200);

        $col = new Collection(Samples\Foo::class, [$onehundred, $twohundred]);
        $this->assertTrue($col->contains($onehundred));
        $this->assertTrue($col->contains($twohundred));

        $zero = new Samples\Foo(0);
        $this->assertFalse($col->contains($zero));

        $onezerozero = new Samples\Foo(100);
        $this->assertFalse($col->contains($onezerozero), 'method contains does not make an identical comparison');
    }

    public function testContainsAll()
    {
        $phpArray = [-3, 0, 3];
        $col = new Collection('int', [-3, 0, 3]);

        // empty
        $this->assertTrue($col->containsAll([]));
        // same elements
        $this->assertTrue($col->containsAll($phpArray));
        // more elements
        $this->assertFalse($col->containsAll(array_merge($phpArray, [9])));

        // less elements
        array_shift($phpArray);
        $this->assertTrue($col->containsAll($phpArray));
    }

    public function testContainsAny()
    {
        $col = new Collection('int', [-3, 0, 3]);
        // empty
        $this->assertFalse($col->containsAny([]));
        // completely different elements
        $this->assertFalse($col->containsAny([-6, 6]));
        // include at least one match element
        $this->assertTrue($col->containsAny([-6, 6, -3]));
    }

    public function testRemove()
    {
        $onehundred = new Samples\Foo(100);
        $twohundred = new Samples\Foo(200);

        $col = new Collection(Samples\Foo::class, [
            $onehundred,
            $twohundred,
            $onehundred,
        ]);

        // remove a not contained item
        $zero = new Samples\Foo(0);
        $this->assertFalse($col->remove($zero));
        $this->assertCount(3, $col);

        // remove a non identical but equal item
        $onezerozero = new Samples\Foo(100);
        $this->assertFalse($col->remove($onezerozero), 'method remove take one element from the collection');
        $this->assertCount(3, $col, 'method remove did not return true but count change');

        // remove an item
        $this->assertTrue($col->remove($onehundred));
        $this->assertCount(2, $col, 'method remove return true but has the element or remove more than one instance');
    }

    public function testRemoveChangeIndexes()
    {
        $foo = new Foo('foo');
        $bar = new Foo('bar');
        $baz = new Foo('baz');
        $collection = new Collection(Foo::class, [
            $foo,
            $bar,
            $baz,
        ]);

        $collection->remove($bar);
        $expectedArray = [$foo, $baz];
        $this->assertSame($expectedArray, $collection->toArray());
    }

    public function testRemoveAllSingleElement()
    {
        $onehundred = new Samples\Foo(100);
        $onezerozero = new Samples\Foo(100);
        $col = new Collection(Samples\Foo::class, [
            $onezerozero,
            $onehundred, $onehundred, $onehundred, $onehundred, $onehundred,
        ]);

        $this->assertTrue($col->removeAll([$onehundred]));
        $this->assertCount(1, $col, 'method removeAll return true but has the element or does not all instances');

        $this->assertFalse($col->removeAll([$onehundred]));
    }

    public function testRemoveAllMulti()
    {
        $onezerozero = new Samples\Foo(100);
        $onehundred = new Samples\Foo(100);
        $twohundred = new Samples\Foo(200);
        $zero = new Samples\Foo(0);
        $col = new Collection(Samples\Foo::class, [
            $onezerozero,
            $onehundred, $onehundred, $onehundred, $onehundred, $onehundred,
            $twohundred, $twohundred,
        ]);

        $this->assertTrue($col->removeAll([$onehundred, $twohundred, $zero]));
        $this->assertCount(1, $col);
    }

    public function testRemoveIf()
    {
        $col = new Collection('int', range(0, 9));
        $fnTrue = function () {
            return true;
        };
        $fnNotTrue = function () {
            return 1;
        };

        // $fnNotTrue does not return TRUE, so none is removed
        $this->assertFalse($col->removeIf($fnNotTrue));
        $this->assertCount(10, $col);

        // $fnTrue return TRUE, so all are removed
        $this->assertTrue($col->removeIf($fnTrue));
        $this->assertEmpty($col);
    }

    public function testRetainAll()
    {
        $range09 = range(0, 9);
        $col = new Collection('int', $range09);

        $this->assertFalse($col->retainAll($range09));
        $this->assertEquals($range09, $col->toArray());

        $range04 = range(0, 4);
        $this->assertTrue($col->retainAll($range04));
        $this->assertEquals($range04, $col->toArray());

        $this->assertTrue($col->retainAll([]));
        $this->assertEmpty($col);

        $this->assertFalse($col->retainAll([]));
    }
}
