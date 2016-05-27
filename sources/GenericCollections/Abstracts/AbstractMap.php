<?php namespace GenericCollections\Abstracts;

use GenericCollections\Collection;
use GenericCollections\Interfaces\MapInterface;
use GenericCollections\Set;
use GenericCollections\Utils\TypeChecker;

abstract class AbstractMap extends InternalDataArray implements MapInterface, \ArrayAccess
{
    public function checkValueType($value)
    {
        return TypeChecker::getInstance()->checkType($this->getValueType(), $value);
    }

    public function checkKeyType($key)
    {
        return TypeChecker::getInstance()->checkType($this->getKeyType(), $key);
    }

    public function containsKey($key)
    {
        return $this->checkKeyType($key) && array_key_exists($key, $this->data);
    }

    public function containsValue($value)
    {
        return in_array($value, $this->data, $this->comparisonMethodIsIdentical());
    }

    public function get($key)
    {
        return $this->containsKey($key) ? $this->data[$key] : null;
    }

    public function getOrDefault($key, $default)
    {
        if ($this->containsKey($key)) {
            return $this->data[$key];
        }
        if (null !== $default && ! $this->checkValueType($default)) {
            throw new \InvalidArgumentException(
                'The default value provided for '
                . get_class($this) . '::getOrDefault is not a valid type,'
                . ' expected ' . $this->getKeyType() . '.'
            );
        }
        return $default;
    }

    public function keys()
    {
        return array_keys($this->data);
    }

    public function put($key, $value)
    {
        if (! $this->checkKeyType($key)) {
            throw new \InvalidArgumentException(
                'The key provided for ' . get_class($this)
                . '::put is not a valid type,'
                . ' expected ' . $this->getKeyType() . '.'
            );
        }
        if (! $this->checkValueType($value)) {
            throw new \InvalidArgumentException(
                'The value provided for ' . get_class($this)
                . '::put is not a valid type,'
                . ' expected ' . $this->getValueType() . '.'
            );
        }
        $previous = $this->get($key);
        $this->data[$key] = $value;
        return $previous;
    }

    public function putAll(array $values)
    {
        foreach ($values as $key => $value) {
            $this->put($key, $value);
        }
    }

    public function putIfAbsent($key, $value)
    {
        $current = $this->get($key);
        if (null !== $current) {
            return $current;
        }
        $this->put($key, $value);
        return null;
    }

    public function remove($key)
    {
        $previous = $this->get($key);
        if ($previous !== null) {
            unset($this->data[$key]);
        }
        return $previous;
    }

    public function removeExact($key, $value)
    {
        $changed = false;
        $previous = $this->get($key);
        $isequal = ($this->comparisonMethodIsIdentical())
            ? ($previous === $value)
            : ($previous == $value);
        if ($isequal) {
            unset($this->data[$key]);
            $changed = true;
        }
        return $changed;
    }

    public function replace($key, $value)
    {
        return ($this->containsKey($key)) ? $this->put($key, $value) : null;
    }

    public function replaceExact($key, $current, $replacement)
    {
        if (! $this->containsKey($key)) {
            return false;
        }
        $previous = $this->get($key);
        $isequal = ($this->comparisonMethodIsIdentical())
            ? ($previous === $current)
            : ($previous == $current);
        if ($isequal) {
            $this->put($key, $replacement);
            return true;
        }
        return false;
    }

    public function keysSet()
    {
        return new Set($this->getKeyType(), $this->keys());
    }

    public function valuesCollection()
    {
        return new Collection($this->getValueType(), $this->toArray());
    }



    /*
     * Implementations from \ArrayAccess
     */
    /** @inheritdoc */
    public function offsetExists($offset)
    {
        return $this->containsKey($offset);
    }

    /** @inheritdoc */
    public function offsetGet($offset)
    {
        return $this->get($offset);
    }

    /** @inheritdoc */
    public function offsetSet($offset, $value)
    {
        $this->put($offset, $value);
    }

    /** @inheritdoc */
    public function offsetUnset($offset)
    {
        $this->remove($offset);
    }
}
