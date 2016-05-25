# eclipxe/generic-collections

Generic Collections PHP Library is a PHP 5.6+ that mimics the [Java Collections Library][java].

As PHP does not have Generics this library will always implements type checks.

For concrete classes uses a constructor approach:

```php
// collection = new Collection<Foo>();
$collection = new Collection(Foo::class);
```

For your own classes you could extend the abstract class and implement the appropiated
type methods, by example:
```php
class Foos extends Collection
{
    public function __construct(array $elements)
    {
        parent::__construct(Foo::class, $elements);
    }
}
```

Or extend the Abstract class, by example:

```php
class Foos extends AbstractCollectionStrict
{
    public function getElementType()
    {
        return Foo::class;
    }
}
```

## List of classes

Basic classes:

- [x] Collection: A collection represents a group of elements of the same type.
- [ ] Set: A collection that does not allow repeated elements
- [ ] SortedSet: A Set that is always sorted

Classes that implement `\ArrayAccess`

- [ ] List: A collection that can be accesed by their integer index and search elements on the list.
- [ ] Map: A mapping from keys to values. Each key can map to one value.

## About

This library is inspired by the Java Collections Framework and [ramsey/collection][ramsey] package.

I see significant changes with ramsey's package, as I didn't want to introduce heavy
changes to his API I decide to create my own approach.

I had also take a deep search on [Packagist][] but couldn't find a library that ensure type checking.

## Documentation

WIP. Be patient please.

## Installation

The preferred method of installation is via [Packagist][] and [Composer][]. Run
the following command to install the package and add it as a requirement to
your project's `composer.json`:

```bash
composer require eclipxe/generic-collections
```

## Contributing

Contributions are welcome! Please read [CONTRIBUTING] for details.


## Copyright and License

The ramsey/collection library is copyright © [Carlos C Soto](https://eclipxe.com.mx/)
and licensed for use under the MIT License (MIT).
Please see [LICENSE][] for more information.

## TODO

- [ ] Create the wiki structure
- [ ] Document `Collection` on wiki

[java]: http://docs.oracle.com/javase/8/docs/technotes/guides/collections/index.html
[ramsey]: https://github.com/ramsey/collection
[packagist]: https://packagist.org/packages/eclipxe/generic-collections
[composer]: http://getcomposer.org/
[contributing]: https://github.com/eclipxe13/generic-collections/blob/master/CONTRIBUTING.md
[source]: https://github.com/eclipxe13/generic-collections
[release]: https://github.com/eclipxe13/generic-collections/releases
[license]: https://github.com/eclipxe13/generic-collections/blob/master/LICENSE
