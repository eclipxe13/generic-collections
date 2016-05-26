# eclipxe/generic-collections

[![Source Code][badge-source]][source]
[![Latest Version][badge-release]][release]
[![Software License][badge-license]][license]
[![Build Status][badge-build]][build]
[![Scrutinizer][badge-quality]][quality]
[![Coverage Status][badge-coverage]][coverage]
[![Total Downloads][badge-downloads]][downloads]

Generic Collections PHP Library is a PHP 5.6+ that mimics the [Java Collections Framework][java].

As PHP does not have Generics this library will always implements type checks.
Don't worry, anyways you can always use the `mixed` type

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
- [x] Set: A collection that does not allow repeated elements

Classes that implement `\ArrayAccess`

- [x] Map: A mapping from keys to values.
- [ ] List: A collection that can be accesed by their integer index and search elements on the list.

## About

This library is inspired by the Java Collections Framework
and PHP [ramsey/collection](https://github.com/ramsey/collection) library.

I see significant changes with ramsey's package, as I didn't want to introduce heavy
changes to his API I decide to create my own approach.

I had also take a deep search on [Packagist][] but couldn't find a library that ensure type checking on members.

Yes, my mistake, the repository username is `eclipxe13/` and the packagist name is `eclipxe/`.

## Compatibility

This class will be compatible according to [PHP Supported versions](http://php.net/supported-versions.php),
Security Support. This means that it will offer compatibility with PHP 5.6+ until 2018-12-31.

The support for cersion 5.5+ is not included since this PHP version will end 2016-06-10
and that is lower than the release of first version of this library.

## Documentation and examples

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
Take a look in the [TODO].

## Copyright and License

The eclipxe/generic-collections library is copyright © [Carlos C Soto](https://eclipxe.com.mx/)
and licensed for use under the MIT License (MIT). Please see [LICENSE][] for more information.

[java]: http://docs.oracle.com/javase/8/docs/technotes/guides/collections/index.html
[packagist]: https://packagist.org/packages/eclipxe/generic-collections
[composer]: http://getcomposer.org/
[contributing]: https://github.com/eclipxe13/generic-collections/blob/master/CONTRIBUTING.md
[todo]: https://github.com/eclipxe13/generic-collections/blob/master/TODO.md

[source]: https://github.com/eclipxe13/generic-collections
[release]: https://github.com/eclipxe13/generic-collections/releases
[license]: https://github.com/eclipxe13/generic-collections/blob/master/LICENSE
[build]: https://travis-ci.org/eclipxe13/generic-collections
[quality]: https://scrutinizer-ci.com/g/eclipxe13/generic-collections/
[coverage]: https://coveralls.io/r/eclipxe13/generic-collections?branch=master
[downloads]: https://packagist.org/packages/eclipxe13/generic-collections

[badge-source]: http://img.shields.io/badge/source-eclipxe13/generic--collections-blue.svg?style=flat-square
[badge-release]: https://img.shields.io/github/release/eclipxe13/generic-collections.svg?style=flat-square
[badge-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[badge-build]: https://img.shields.io/travis/eclipxe13/generic-collections.svg?style=flat-square
[badge-quality]: https://img.shields.io/scrutinizer/g/eclipxe13/generic-collections/master.svg?style=flat-square
[badge-coverage]: https://img.shields.io/coveralls/eclipxe13/generic-collections/master.svg?style=flat-square
[badge-downloads]: https://img.shields.io/packagist/dt/eclipxe13/generic-collections.svg?style=flat-square
