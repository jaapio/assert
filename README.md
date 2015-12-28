bovigo/assert
==============

Provides assertions for unit tests.


Package status
--------------

[![Build Status](https://secure.travis-ci.org/mikey179/bovigo-assert.png)](http://travis-ci.org/mikey179/bovigo-assert) [![Coverage Status](https://coveralls.io/repos/mikey179/bovigo-assert/badge.png?branch=master)](https://coveralls.io/r/mikey179/bovigo-assert?branch=master)

[![Latest Stable Version](https://poser.pugx.org/bovigo/assert/version.png)](https://packagist.org/packages/bovigo/assert) [![Latest Unstable Version](https://poser.pugx.org/bovigo/assert/v/unstable.png)](//packagist.org/packages/bovigo/assert)


Installation
------------

_bovigo/assert_ is distributed as [Composer](https://getcomposer.org/) package.
To install it as a development dependency of your package use the following
command:

    composer require --dev "bovigo/assert": "^1.0"

To install it as a runtime dependency for your package use the following command:

    composer require "bovigo/assert=^1.0"


Requirements
------------

_bovigo/assert_ requires at least PHP 5.6.


Usage
-----

All assertions are written in the same way using functions:

```php
assert(303, equals(303));
assert(someCondition(), isTrue(), 'condition should always be true');
```

The first parameter is the value to test, and the second is the predicate that
should be used to test the value. Additionally, an optional description can be
supplied to enhance clarity in case the assertion fails.

In case the predicate fails an `AssertionFailure` will be thrown with useful
information of why the test failed. In case PHPUnit is used `AssertionFailure`
is an instance of `\PHPUnit_Framework_ExpectationFailedException` so it
integrates nicely into PHPUnit, yielding a similar test output as PHPUnit's
constraints. Here is an example of the output in case of a test failure:

```
1) bovigo\assert\predicate\RegexTest::stringRepresentationContainsRegex
Failed asserting that 'matches regular expression "/^([a-z]{3})$/"' is equal to <string:matches regular expession "/^([a-z]{3})$/">.
--- Expected
+++ Actual
@@ @@
-'matches regular expession "/^([a-z]{3})$/"'
+'matches regular expression "/^([a-z]{3})$/"'

bovigo-assert/src/test/php/predicate/RegexTest.php:99
```

Note: for the sake of brevity below it is assumed the used functions are
imported into the current namespace via
```php
use function bovigo\assert\assert;
use function bovigo\assert\predicate\isTrue;
use function bovigo\assert\predicate\equals;
// ... and so on
```


List of predicates
------------------

This is the list of predicates that are included in _bovigo/assert_ by default.


### `isNull()`

Tests if value is `null`.

```php
assert($value, isNull());
```


### `isNotNull()`

Tests that value is not `null`.

```php
assert($value, isNotNull());
```


### `isEmpty()`

Tests that value is empty. Empty is defined as follows:

* In case the value is an instance of `\Countable` it is empty when its count
  is 0.
* For all other values the rules for PHP's `empty()` apply.

```php
assert($value, isEmpty());
```


### `isNotEmpty()`

Tests that value is not empty. See `isEmpty()` for definition of emptyness.

```php
assert($value, isNotEmpty());
```


### `isTrue()`

Tests that a value is true. The value must be boolean true, no value conversion
is applied.

```php
assert($value, isTrue());
```


### `isFalse()`

Tests that a value is false. The value must be boolean false, no value
conversion is applied.

```php
assert($value, isFalse());
```


### `equals($expected, $delta = 0.0)`

Tests that a value equals the expected value. The optional parameter `$delta`
can be used when equality of float values should be tested and allows for a
certain range in which two floats are considered equal.

```php
assert($value, equals('Roland TB 303'));
```


### `isNotEqualTo($unexpected, $delta = 0.0)`

Tests that a value is not equal to the unexpected value. The optional parameter
`$delta` can be used when equality of float values should be tested and allows
for a certain range in which two floats are considered equal.

```php
assert($value, isNotEqualTo('Roland TB 303'));
```


### `isInstanceOf($expectedType)`

Tests that a value is an instance of the expected type.

```php
assert($value, isInstanceOf(\stdClass::class));
```


### `isNotInstanceOf($unexpectedType)`

Tests that a value is not an instance of the unexpected type.

```php
assert($value, isNotInstanceOf(\stdClass::class));
```


### `isSameAs($expected)`

Tests that a value is identical to the expected value. Both values are compared
with `===`, the according rules apply.

```php
assert($value, isSameAs($anotherValue));
```


### `isNotSameAs($unexpected)`

Tests that a value is not identical to the unexpected value. Both values are
compared with `===`, the according rules apply.

```php
assert($value, isNotSameAs($anotherValue));
```


### `isOfSize($expectedSize)`

Tests that a value has the expected size. The rules for the size are as follows:

* For strings, their length in bytes is used.
* For array and instances of `\Countable` the value of `count()` is used.
* For instances of `\Traversable` the value of `iterator_count()` is used. To
  prevent moving the pointer of the traversable, `iterator_count()` is applied
  against a clone of the traversable.
* All other value types will be rejected.

```php
assert($value, isOfSize(3));
```


### `isNotOfSize($unexpectedSize)`

Tests that a value does not have the unexpected size. The rules are the same as
for `isOfSize($expectedSize)`.

```php
assert($value, isNotOfSize(3));
```


### `isOfType($expectedType)`

Tests that a value is of the expected internal PHP type.

```php
assert($value, isOfType('resource'));
```


### `isNotOfType($unexpectedType)`

Tests that a value is not of the unexpected internal PHP type.

```php
assert($value, isNotOfType('resource'));
```


### `isGreaterThan($expected)`

Tests that a value is greater than the expected value.

```php
assert($value, isGreaterThan(3));
```


### `isGreaterThanOrEqualTo($expected)`

Tests that a value is greater than or equal to the expected value.

```php
assert($value, isGreaterThanOrEqualTo(3));
```


### `isLessThan($expected)`

Tests that a value is less than the expected value.

```php
assert($value, isLessThan(3));
```


### `isLessThanOrEqualTo($expected)`

Tests that a value is less than or equal to the expected value.

```php
assert($value, isLessThanOrEqualTo(3));
```


### `contains($needle)`

Tests that `$needle` is contained in value. The following rules apply:

* `null` is contained in `null`.
* A string can be contained in another string. The comparison is case sensitive.
* `$needle` can be a value of an array or a `\Traversable`. Value and `$needle`
  are compared with `===`.
* For all other cases, the value is rejected.

```php
assert($value, contains('Roland TB 303'));
```


### `doesNotContain($needle)`

Tests that `$needle` is not contained in value. The rules of `contains($needle)`
apply.

```php
assert($value, doesNotContain('Roland TB 303'));
```


### `hasKey($key)`

Tests that an array or an instance of `\ArrayAccess` have a key with given name.
The key must be either of type `integer` or `string`. Values that are neither an
array nor an instance of `\ArrayAccess` are rejected.

```php
assert($value, hasKey('roland'));
```


### `doesNotHaveKey($key)`

Tests that an array or an instance of `\ArrayAccess` does not have a key with
given name. The key must be either of type `integer` or `string`. Values that
are neither an array nor an instance of `\ArrayAccess` are rejected.

```php
assert($value, doesNotHaveKey('roland'));
```


### `matches($pattern)`

Tests that a string matches the given pattern of a regular expression. If the
value is not a string it is rejected. The test is successful if the pattern
yields at least one match in the value.

```php
assert($value, matches('/^([a-z]{3})$/'));
```


### `doesNotMatch($pattern)`

Tests that a string does not match the given pattern of a regular expression. If
the value is not a string it is rejected. The test is successful if the pattern
yields no match in the value.

```php
assert($value, doesNotMatch('/^([a-z]{3})$/'));
```


### `isExistingFile($basePath = null)`

Tests that the value denotes an existing file. If no `$basepath` is supplied the
value must either be an absolute path or a relative path to the current working
directory. When `$basepath` is given the value must be a relative path to this
basepath.

```php
assert($value, isExistingFile());
assert($value, isExistingFile('/path/to/files'));
```


### `isNonExistingFile($basePath = null)`

Tests that the value denotes a file which does not exist. If no `$basepath` is
supplied the value must either be an absolute path or a relative path to the
current working directory. When `$basepath` is given the value must be a
relative path to this basepath.

```php
assert($value, isNonExistingFile());
assert($value, isNonExistingFile('/path/to/files'));
```


### `isExistingDirectory($basePath = null)`

Tests that the value denotes an existing directory. If no `$basepath` is
supplied the value must either be an absolute path or a relative path to the
current working directory. When `$basepath` is given the value must be a
relative path to this basepath.

```php
assert($value, isExistingDirectory());
assert($value, isExistingDirectory('/path/to/directories'));
```


### `isNonExistingDirectory($basePath = null)`

Tests that the value denotes a non-existing directory. If no `$basepath` is
supplied the value must either be an absolute path or a relative path to the
current working directory. When `$basepath` is given the value must be a
relative path to this basepath.

```php
assert($value, isNonExistingDirectory());
assert($value, isNonExistingDirectory('/path/to/directories'));
```


### `startsWith($prefix)`
_Available since release 1.1.0._

Tests that the value which must be a string starts with given prefix.

```php
assert($value, startsWith('foo'));
```


### `doesNotStartWith($prefix)`
_Available since release 1.1.0._

Tests that the value which must be a string does not start with given prefix.

```php
assert($value, startsWith('foo'));
```


### `endsWith($suffix)`
_Available since release 1.1.0._

Tests that the value which must be a string ends with given suffix.

```php
assert($value, endsWith('foo'));
```


### `doesNotEndWith($suffix)`
_Available since release 1.1.0._

Tests that the value which must be a string does not end with given suffix.

```php
assert($value, doesNotEndWith('foo'));
```


### `isNan()`
_Available since release 1.1.0._

Tests that the value is not a number.

```php
assert($value, isNan());
```


### `isFinite()`
_Available since release 1.1.0._

Tests that the value is finite.

```php
assert($value, isFinite());
```


### `isInfinite()`
_Available since release 1.1.0._

Tests that the value is infinite.

```php
assert($value, isInfinite());
```


### `each(Predicate $predicate)`
_Available since release 1.1.0._

Applies a predicate to each value of an array or traversable.

```php
assert($value, each(isInstanceOf($expectedType));
```

Please note that an empty array or traversable will result in a successful test.
If it must not be empty use `isNotEmpty()->asWellAs(each($predicate))`:

```php
assert($value, isNotEmpty()->asWellAs(each(isInstanceOf($expectedType))));
```


PHPUnit compatibility layer
---------------------------

In case you want to check out how _bovigo/assert_ works with your tests there is
a PHPUnit compatibility layer available. Instead of extending directly from
`\PHPUnit_Framework_TestCase` let your tests extend
`bovigo\assert\phpunit\PHPUnit_Framework_TestCase`. It overlays all constraints
from PHPUnit with predicates from _bovigo/assert_  where they are available.
For constraints which have no equivalent predicate in _bovigo/assert_ the
default constraints from PHPUnit are used.


FAQ
---

### How can I access a property of a class or object for the assertions?

Unlike PHPUnit _bovigo/assert_  does not provide means to assert that a property
of a class fullfills a certain constraint. If the property is public you can
pass it directly into the `assert()` function as a value. In any other case
_bovigo/assert_ does not support accessing protected or private properties.
There's a reason why they are protected or private, and a test should only be
against the public API of a class, not against their inner workings.
