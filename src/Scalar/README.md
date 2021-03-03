# PHP Scalar Datatypes

Currently, this package supports only **Scalar Strings**. You can choose between `Immutable` and `Mutable` string objects.

**Scalar Strings** are wrapper objects around primitive `strings`, which encapsulate all string related funcionality into
a single instance.

## Immutable vs. Mutable

`Mutable` and `Immutable` string datatypes will have the exact same functionality, but will have different instance management.
Both types inherit commonly used `protected` functionality from parent `AbstractBaseString` class. Parent methods will map to
native procedural string manipulation functions.

Both types of classes implement `__toString()` method, which means you can directly print their result:

```php
// Example of an Immutable string.
$string = ImmutableString::fromString("   This Is A String   ");

echo $string; // Prints '   This Is A String   '
```

Use **accessor** methods to retrieve any information from within the instance. **Mutators** methods will manipulate the
value of the instance.

Both `Mutable` and `Immutable` instances have _fluent interfaces_, and therefore you can chain mutator methods, and make
several changes in the same line of code. The main difference between the two types, is that `Mutable` instances will return
the same instance everytime, and therefore, will change the internal state as you call its _mutators_. `Immutable` instances
will instead return a new instance of the same type, with the processed value.

Here are two examples:

```php
// Example of an Immutable string.
$string1 = ImmutableString::fromString("   This Is A String   ");
$string2 = $string1->trim();
$string3 = $string2->toLower();

if ($string1 === $string2 || $string1 === $string3 || $string2 === $string3) {
    echo "This will never print, as all are different instances.";
}

if ($string1->equals($string2)) {
    echo "This will print, as both instances contain the same value.";
}

echo "{$string1} still has the value '   This Is A String   '.";
echo "{$string2} has the value 'This Is A String'.";
echo "{$string3} has the value 'this is a string'.";
```

```php
// Example of a Mutable string.
$string1 = MutableString::fromString("   This Is A String   ");
$string2 = $string1->trim();
$string3 = $string2->toLower();

if ($string1 === $string2 && $string1 === $string3 && $string2 === $string3) {
    echo "This will print, as all are the same instance.";
}

echo "All variables have the same 'this is a string' value.";
```

### Fluent Interfaces

You can also do the previous processing, by channing the methods, independently of what type of datatype it is.

```php
// Example of chaning methods.
$immutable = ImmutableString::fromString("   This Is A String   ");
$mutable   = MutableString::fromString("   This Is A String   ");

// Both will print out 'this is a string'.
echo $immutable->trim()->toLower();
echo $mutable->trim()->toLower();
```

### Class usage

You can easily import, use and manipulate primitive native data in the following way:

```php
use Hradigital\Datatypes\Scalar\MutableString as Str;

// ...

$string = Str::fromString(' This is the string I am trying to manipulate.   ');
```
