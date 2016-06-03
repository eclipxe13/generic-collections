<?php namespace GenericCollections\Traits;

/**
 * This methods apply to BaseCollectionInterface and
 * its shared between all the different AbstractCollections like
 * AbstractCollection and AbstractMap
 *
 * This methods are declared to avoid warnings
 *
 * @package GenericCollections\Traits
 */
trait CollectionMethods
{
    /**
     * @inheritdoc \GenericCollections\Interfaces\BaseCollectionInterface::add
     */
    abstract public function add($element);

    /**
     * @inheritdoc \GenericCollections\Interfaces\BaseCollectionInterface::contains
     */
    abstract public function contains($element);

    public function addAll(array $elements)
    {
        $added = false;
        foreach ($elements as $element) {
            $added = $this->add($element) || $added;
        }
        return $added;
    }

    public function containsAll(array $elements)
    {
        foreach ($elements as $element) {
            if (! $this->contains($element)) {
                return false;
            }
        }
        return true;
    }

    public function containsAny(array $elements)
    {
        foreach ($elements as $element) {
            if ($this->contains($element)) {
                return true;
            }
        }
        return false;
    }
}
