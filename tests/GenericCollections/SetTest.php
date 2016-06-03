<?php namespace GenericCollections\Tests;

use GenericCollections\Collection;
use GenericCollections\Interfaces\CollectionInterface;
use GenericCollections\Set;

/**
 * Set is a Collection's extended class.
 * It only overrides the constructor to deny duplicates
 *
 * This test does not check other than the constructor, the
 * option for Unique Values is tested in CollectionUniqueValuesTest
 */
class SetTest extends \PHPUnit_Framework_TestCase
{

    public function testConstructor()
    {
        $set = new Set('int');
        $this->assertInstanceOf(CollectionInterface::class, $set);
        $this->assertInstanceOf(Collection::class, $set);
        $this->assertSame(true, $set->optionUniqueValues());
        $this->assertSame(false, $set->optionAllowNullMembers());
        $this->assertSame(true, $set->optionComparisonIsIdentical());
    }

    public function testConstructorWithNotUniqueValuesOption()
    {
        $set = new Set('int', [], 0);
        $this->assertSame(true, $set->optionUniqueValues());
    }
}
