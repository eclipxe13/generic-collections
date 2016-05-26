# eclipxe/generic-collections: To do list

## Ideas

### Class allowNull members

If a class allow `null` members then it would be possible to insert inside a map a null value
 like `$map->put('x', null);`. This is permitted in java so it can be considered a correct behavior.

The classes that are impacted by this are
- `Collection` and its derivated classes like `Set`
- `Map`

I found different stategies for this:

```php
// plain in the constructor as 4 argument
$map = new Map('string', Foo::class, true, true);

// as option flags
$map = new Map('string', Foo::class, MAP::ALLOWNULLS + MAP::COMPAREEQUALS);

// as an options object, it looks like hell!
$options = new MapOptions([
    MapOptions::NULLS_ARE_ALLOWED,
    MapOptions::COMPARISON_EQUALS
]);
$map = new Map('string', Foo::class, $options);
```

Following the current coding approach it would be better to just implement the options flag
and also offer the MapOptions object to help extending the classes.

Anyhow, to be able to manage this behavior we will need extend the interfaces to support options.
Maybe we must create an interface ClassAllowNulls and ClassCompareMethod

- [ ] TypeChecker could be part of of TypeProperty, in that way every property would
      know what to do and if it allows nulls. It would be possible to check against more than one type.
- [ ] Implement option allowNulls for collections and maps, omits type checking for NULL elements/values.

## Core Development

- [x] Implement \ArrayAccess interface on Map
- [ ] Document GenericCollections\Abstracts\AbstractCollection

## Project

- [ ] Include library on packagist to use it in composer
- [ ] Create the wiki structure
- [ ] Document classes and examples
