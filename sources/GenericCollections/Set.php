<?php namespace GenericCollections;

use GenericCollections\Abstracts\AbstractSet;
use GenericCollections\Traits\CollectionTrait;

/**
 * Generic set implementation
 *
 * A set is the same as a collection but can't contain duplicated values
 *
 * The elements comparison can be defined ad identical or equal,
 * if identical searchs match with '==='
 * if equal searchs match with '=='
 *
 * @package GenericCollections
 */

class Set extends AbstractSet
{
    use CollectionTrait;
}
