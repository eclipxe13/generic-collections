## `Collection` class

A collection represents a group of elements of the same type.

An element cannot be located by key or index, you must not use it in this way,
  even when you can do things like `foreach ($collection as $index => $element)`.

The `Collection` class is a concrete implementation of this case with
 this implementation details:

- elements must be of one specific type
- elements are compared (for contains, remove, retain, etc) using strict (identical) comparisons
- elements can be duplicated
- elements can be null
- elements are not sorted

To declare a collection you only need to instantiate the object passing the corresponding type
 and (optionally) the contents as an array.

```php
$col = new Collection('integer', range(0, 9));

// this will throw an exception since 'foo' is not an integer
$col->add('foo');
```

The methods affected by comparison method (identical or equal) are:

- contains: uses in_array
- retailAll: uses in_array
- remove: uses array_search
