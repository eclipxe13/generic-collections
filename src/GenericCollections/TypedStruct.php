<?php
namespace GenericCollections;

use GenericCollections\Exceptions\TypePropertyException;
use GenericCollections\Utils\TypeProperty;

/**
 * Concrete TypedStruct implementation. This class is like a HHVM Shape.
 * All defined keys can be accessed as properties or array.
 * It will throw a TypePropertyException if you try to set a value that does not match the definition type
 *
 * You can use this as a direct object like:
 * ```php
 * $obj = new TypedStruct(
 *      ['id' => 'int', 'name' => 'string'],
 *      ['id' => 1, 'name' => 'Foo Bar]
 * );
 * echo $obj['name']; // Foo Bar
 * ```
 *
 * Or you can inherith from this class to your own definition
 * ```php
 * class UserData extends TypedStruct
 * {
 *      public function __construct(array $values = [])
 *      {
 *          $definitions = ['id' => 'int', 'name' => 'string'];
 *          parent::__construct($definitions, $values);
 *      }
 * }
 * $user = new UserData(['id' => 10]);
 * echo $obj['id']; // 10
 * ```
 *
 * @package GenericCollections
 */
class TypedStruct implements \ArrayAccess, \IteratorAggregate, \Countable
{
    /**
     * @var TypeProperty[] Definition of the (string) key => (string) type
     */
    protected $definitions = [];

    /**
     * @var array
     */
    protected $values = [];

    /**
     * TypedStruct constructor.
     * @param string[] $definitions
     * @param array $values
     */
    public function __construct(array $definitions, array $values = [])
    {
        foreach ($definitions as $key => $type) {
            if (is_int($key)) {
                $key = $type;
                $type = 'mixed';
            }
            if (! is_string($key)) {
                throw new \InvalidArgumentException('Invalid definition key found');
            }
            if (! is_string($type)) {
                throw new \InvalidArgumentException('Invalid definition type found');
            }
            $this->definitions[$key] = new TypeProperty($type, true);
            $this->values[$key] = null;
        }
        $this->setValues($values);
    }

    /**
     * @return TypeProperty[] Get an array with all definitions
     */
    public function getDefinitions()
    {
        return $this->definitions;
    }

    /**
     * Retrieve a definition object
     * @param string $key
     * @return TypeProperty
     * @throws \InvalidArgumentException if key is not found
     */
    public function getDefinition($key)
    {
        $this->checkDefinitionExists($key);
        return $this->definitions[$key];
    }

    /**
     * Set all the values from the array to the local object
     * If the key is not found then it is just ignored
     *
     * @param array $values
     */
    public function setValues(array $values)
    {
        foreach ($values as $key => $value) {
            if ($this->exists($key)) {
                $this->set($key, $value);
            }
        }
    }

    /**
     * Set the value for a key, this will check that the value is the same type of the definition
     *
     * @param string $key
     * @param mixed $value
     * @throws \InvalidArgumentException if key is not found
     * @throws TypePropertyException if the value does not match the defined type
     */
    public function set($key, $value)
    {
        $definition = $this->getDefinition($key);
        if (! $definition->check($value)) {
            throw new TypePropertyException("Definition '$key' only allows type '{$definition->getType()}'");
        }
        $this->values[$key] = $value;
    }

    /**
     * Return TRUE if the key exists
     *
     * @param string $key
     * @return bool
     */
    public function exists($key)
    {
        return array_key_exists($key, $this->definitions);
    }

    /**
     * Return the value of a key
     *
     * @param string $key
     * @return mixed
     * @throws \InvalidArgumentException if key is not found
     */
    public function get($key)
    {
        $this->checkDefinitionExists($key);
        return $this->values[$key];
    }

    /**
     * Return an array with the key and values
     *
     * @return array
     */
    public function getValues()
    {
        return $this->values;
    }

    /**
     * Utility function that throws an exception if the key is not found
     * @param string $key
     */
    protected function checkDefinitionExists($key)
    {
        if (! array_key_exists($key, $this->definitions)) {
            throw new \InvalidArgumentException("Definition '$key' does not exists");
        }
    }

    public function __get($name)
    {
        return $this->get($name);
    }

    public function __set($name, $value)
    {
        $this->set($name, $value);
    }

    public function __isset($name)
    {
        return isset($this->values[$name]);
    }

    public function __unset($name)
    {
        $this->set($name, null);
    }

    public function offsetExists($offset)
    {
        return isset($this->values[$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->get($offset);
    }

    public function offsetSet($offset, $value)
    {
        $this->set($offset, $value);
    }

    public function offsetUnset($offset)
    {
        $this->set($offset, null);
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->values);
    }

    public function count()
    {
        return count($this->values);
    }
}
