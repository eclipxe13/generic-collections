<?php namespace GenericCollections\Tests;

use GenericCollections\Set;

/*
 * As a Set uses the same code as the collection
 * and only changes the add method this is the only thing tested
 */
class SetStrictTest extends \PHPUnit_Framework_TestCase
{
    public function testAdd()
    {
        $foo = new Samples\Foo(100);
        $set = new Set(Samples\Foo::class);

        // first insert is fine
        $this->assertTrue($set->add($foo));
        
        // second insert returns false
        $this->assertFalse($set->add($foo));
        
        // contents are correct
        $this->assertEquals([$foo], $set->toArray());
    }
}
