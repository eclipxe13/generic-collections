<?php namespace GenericCollections\Tests\Utils;

use GenericCollections\Utils\TypeChecker;

class TypeCheckerTest extends \PHPUnit_Framework_TestCase
{
    /** @var TypeChecker */
    protected $checker;

    protected function setUp()
    {
        parent::setUp();
        $this->checker = new TypeChecker();
    }

    public function testCheckInstanceOf()
    {
        $this->assertTrue($this->checker->checkType(\stdClass::class, new \stdClass()));
        $this->assertFalse($this->checker->checkType(\stdClass::class, 1));
    }

    public function testCheckInstanceOfInheritance()
    {
        $parent = new Samples\FooParent();
        $child = new Samples\FooChild();
        // Assert Samples construction Child extends Parent
        $this->assertInstanceOf(Samples\FooParent::class, $child);
        $this->assertNotInstanceOf(Samples\FooChild::class, $parent);

        $this->assertTrue($this->checker->checkType(Samples\FooParent::class, $parent));
        $this->assertTrue($this->checker->checkType(Samples\FooChild::class, $child));
        $this->assertTrue($this->checker->checkType(Samples\FooParent::class, $child));
        $this->assertFalse($this->checker->checkType(Samples\FooChild::class, $parent));
    }

    public function testCheckNull()
    {
        $this->assertTrue($this->checker->checkType('null', null));
        $this->assertFalse($this->checker->checkType('null', 1));
    }

    public function testCheckMixed()
    {
        $this->assertTrue($this->checker->checkType('mixed', null));
        $this->assertTrue($this->checker->checkType('mixed', 1));
    }

    public function testCheckScalar()
    {
        $this->assertTrue($this->checker->checkType('scalar', 1));
        $this->assertTrue($this->checker->checkType('scalar', true));
        $this->assertFalse($this->checker->checkType('scalar', null));
        $this->assertFalse($this->checker->checkType('scalar', new \stdClass()));
    }

    public function testCheckNumeric()
    {
        $this->assertTrue($this->checker->checkType('numeric', 1));
        $this->assertTrue($this->checker->checkType('numeric', '1'));
        $this->assertTrue($this->checker->checkType('numeric', 123.45));
        $this->assertTrue($this->checker->checkType('numeric', 0xFFF));
        $this->assertFalse($this->checker->checkType('numeric', true));
        $this->assertFalse($this->checker->checkType('numeric', 'foo'));
    }

    public function testCheckBoolean()
    {
        $synonymous = ['bool', 'boolean'];
        foreach ($synonymous as $type) {
            $this->assertTrue($this->checker->checkType($type, false));
            $this->assertTrue($this->checker->checkType($type, true));
            $this->assertFalse($this->checker->checkType($type, 'foo'));
            $this->assertFalse($this->checker->checkType($type, ''));
            $this->assertFalse($this->checker->checkType($type, null));
            $this->assertFalse($this->checker->checkType($type, 0));
        }
    }

    public function testCheckInteger()
    {
        $synonymous = ['int', 'integer', 'long'];
        foreach ($synonymous as $type) {
            $this->assertTrue($this->checker->checkType($type, 9));
            $this->assertTrue($this->checker->checkType($type, -1));
            $this->assertTrue($this->checker->checkType($type, 0));
            $this->assertFalse($this->checker->checkType($type, 1.0));
            $this->assertFalse($this->checker->checkType($type, '1'));
        }
    }

    public function testCheckFloat()
    {
        $synonymous = ['float', 'double', 'real'];
        foreach ($synonymous as $type) {
            $this->assertTrue($this->checker->checkType($type, 1.0));
            $this->assertFalse($this->checker->checkType($type, '1.0'));
        }
    }

    public function testCheckString()
    {
        $this->assertTrue($this->checker->checkType('string', ''));
        $this->assertFalse($this->checker->checkType('string', 0));
    }

    public function testCheckArray()
    {
        $obj = new \stdClass();
        $obj->foo = 'bar';
        $this->assertTrue($this->checker->checkType('array', []));
        $this->assertFalse($this->checker->checkType('array', 1));
        $this->assertFalse($this->checker->checkType('array', $obj), '\stdClass is not an array');
        $this->assertFalse($this->checker->checkType('array', new \ArrayObject([])), '\ArrayObject is not an array');
    }

    public function testCheckObject()
    {
        $this->assertTrue($this->checker->checkType('object', new \stdClass()));
        $this->assertTrue($this->checker->checkType('object', new \DateTimeImmutable()));
        $this->assertFalse($this->checker->checkType('object', null));
        $this->assertFalse($this->checker->checkType('object', 0));
    }

    public function testCheckResource()
    {
        $resource = opendir(__DIR__);
        $this->assertTrue($this->checker->checkType('resource', $resource));
        $this->assertFalse($this->checker->checkType('resource', new \stdClass()));
        $this->assertFalse($this->checker->checkType('resource', 1));
    }

    public function testCheckCallable()
    {
        $function = function () {
            return;
        };
        $object = new Samples\CallableFoo();
        $arraycall = [$object, '__invoke'];

        $this->assertTrue($this->checker->checkType('callable', $function));
        $this->assertTrue($this->checker->checkType('callable', $object));
        $this->assertTrue($this->checker->checkType('callable', $arraycall));
        $this->assertFalse($this->checker->checkType('callable', new \stdClass()));
    }
}
