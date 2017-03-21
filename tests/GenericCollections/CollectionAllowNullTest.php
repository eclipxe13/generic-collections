<?php
namespace GenericCollections\Tests;

use GenericCollections\Collection;
use GenericCollections\Options;
use GenericCollections\Tests\Samples\Foo;

/**
 * This only check the Collection methods that behaves
 * different when the option allow null is set:
 *
 * As this is set by the property itself then it only assert that
 * the option is set and the checktype returns true
 */
class CollectionAllowNullTest extends \PHPUnit_Framework_TestCase
{
    /** @var Collection */
    private $collection;

    protected function setUp()
    {
        parent::setUp();
        $this->collection = new Collection(Foo::class, [], Options::ALLOW_NULLS);
    }

    public function testOptionUniqueValuesIsSet()
    {
        $this->assertSame(true, $this->collection->optionAllowNullMembers());
    }

    public function testCheckElementTypeNull()
    {
        $this->assertTrue($this->collection->checkElementType(null));
    }
}
