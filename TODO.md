# eclipxe/generic-collections: To do list

## Ideas

- [ ] TypeChecker could be part of of TypeProperty, in that way every property would
      know what to do and if it allows nulls. It would be possible to check against more than one type.
- [ ] Implement option allowNulls for collections and maps, omits type checking for NULL elements/values.

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

### TypedPropertiesMap

This is an special map where every member has its own type.
It could be very useful for arrays as entities:

```php
// Class User extends TypedProperties, so:
$user = new User();
$user['id'] = 12345; // (id => integer)
$user['name'] = 'some text'; // (name => string)
$user['birthdate'] = 'in the past'; // throw an exception, 'birthdate' expect a \DateTimeInterface
```

See <https://github.com/ramsey/collection/blob/master/src/Map/NamedParameterMap.php>

### Specialized maps: IntegerKeysMap, StringKeysMap, HashMap

As php only allows this type of keys in the array, could be possible to imlement this two
specific cases.

What to do with other objects? what about a HashMap where the key is calculated
using the spl_object_hash function. What to do with a non-object? cast it as string?

The HashMap give me the idea of a SelfIdentifiedMap, where values have their own id and they identify
themselves.

```php
// let say that $map is a SelfIdentifiedMap
// where the key is supplied by Foo::id()
// and $foo->id returns 1

$map[] = $foo; // ok, its like $map[$foo->id()] = $foo
$map[1] = $foo; // ok, since $foo->id() === 1
$map[2] = $foo; // must throw an exception


```

## Core Development

- [x] Implement \ArrayAccess interface on Map
- [ ] Document GenericCollections\Abstracts\AbstractCollection

## Project

- [ ] Include library on packagist to use it in composer
- [ ] Create the wiki structure
- [ ] Document classes and examples

## Integration

- [X] Include dependences instead of installing by Travis CI
