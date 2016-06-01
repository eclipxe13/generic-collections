# eclipxe/generic-collections: To do list

## Doubts

A deque (also queue and stack) throws exception on add when:

- null element and deque does not allow nulls
- type missmatch
- duplicated element and deque does not allow duplicates

When should throw an exception on offer? looks like when:

- null element and deque does not allow nulls
- type missmatch

And return FALSE when

- duplicated element and deque does not allow duplicates

It would be better to just return false on offer and never throw a exception?

## Ideas

- [X] TypeChecker could be part of of TypeProperty, in that way every property would
      know what to do and if it allows nulls. It would be possible to check against more than one type.
- [X] Implement option allowNulls for collections and maps, omits type checking for NULL elements/values.


### TypedPropertiesMap

This is an special map where every member has its own type.
It could be very useful for arrays as entities:

```php
// User class extends TypedProperties, so:
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

- [X] Include library on packagist to use it in composer
- [ ] Create the wiki structure
- [ ] Document classes and examples
- [ ] Release first version

## Integration

- [X] Include dependences instead of installing by Travis CI
