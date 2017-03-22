<?php
namespace GenericCollections\Utils;

class TypeChecker
{
    protected $map = [
        'null' => 'checkNullValue',
        'mixed' => 'checkMixed',
        'scalar' => 'checkScalar',
        'numeric' => 'checkNumeric',
        'boolean' => 'checkBoolean',
        'bool' => 'checkBoolean',
        'integer' => 'checkInteger',
        'int' => 'checkInteger',
        'long' => 'checkInteger',
        'float' => 'checkFloat',
        'double' => 'checkFloat',
        'real' => 'checkFloat',
        'string' => 'checkString',
        'array' => 'checkArray',
        'object' => 'checkObject',
        'resource' => 'checkResource',
        'callable' => 'checkCallable',
    ];

    /**
     * Check if a value match with an specific type
     *
     * @param string $type
     * @param mixed $value
     * @param bool $allowNull
     * @return bool
     */
    public function checkType($type, $value, $allowNull = false)
    {
        if (null === $value && $allowNull) {
            return true;
        }
        if (! array_key_exists($type, $this->map)) {
            return $this->checkInstanceOf($value, $type);
        }
        $call = [$this, $this->map[$type]];
        return call_user_func($call, $value);
    }

    protected function checkInstanceOf($value, $type)
    {
        return ($value instanceof $type);
    }

    protected function checkNullValue($value)
    {
        return is_null($value);
    }

    protected function checkMixed()
    {
        return true;
    }

    protected function checkScalar($value)
    {
        return is_scalar($value);
    }

    protected function checkNumeric($value)
    {
        return is_numeric($value);
    }

    protected function checkBoolean($value)
    {
        return is_bool($value);
    }

    protected function checkInteger($value)
    {
        return is_int($value);
    }

    protected function checkFloat($value)
    {
        return is_float($value);
    }

    protected function checkString($value)
    {
        return is_string($value);
    }

    protected function checkArray($value)
    {
        return is_array($value);
    }

    protected function checkObject($value)
    {
        return is_object($value);
    }

    protected function checkResource($value)
    {
        return is_resource($value);
    }

    protected function checkCallable($value)
    {
        return is_callable($value);
    }
}
