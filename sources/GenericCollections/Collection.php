<?php namespace GenericCollections;

use GenericCollections\Abstracts\AbstractCollection;
use GenericCollections\Traits\CollectionTrait;

/**
 * Generic collection implementation
 *
 * The elements comparison can be defined ad identical or equal,
 * if identical searchs match with '==='
 * if equal searchs match with '=='
 *
 * @package GenericCollections
 */
class Collection extends AbstractCollection
{
    use CollectionTrait;
}
