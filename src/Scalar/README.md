# PHP Scalar Datatypes

Currently, this package supports only **Scalar Strings**. You can choose between `Str` and `NString` string objects.

**Scalar Strings** are wrapper objects around primitive `strings`, which encapsulate all string related funcionality into
a single instance.

## Str vs. NString

`Str` and `NString` string datatypes will have the exact same functionality, but will have different instance management.
Both types inherit commonly used `protected` functionality from parent `AbstractBaseString` class. Parent methods will map to
native procedural string manipulation functions.

Both types of classes implement `__toString()` method, which means you can directly print their result:

```php
// Example of a Str.
$Str = Str::create("   This Is A String   ");

echo $Str; // Prints '   This Is A String   '
```

Use **accessor** methods to retrieve any information from within the instance. **Mutators** methods will manipulate the
value of the instance. Both classes are immutable Value Objects, which means that, they will always return a new
instance of themselves when changing internal value, which should remain immutable in original instance.

Both `Str` and `NString` instances have _fluent interfaces_, and therefore you can chain mutator methods, and make
several changes in the same line of code. The main difference between the two types, is that `Str` instances will
force all mutator's interfaces/methods to always use other `Str` as parameters, and never primitive `strings`.

Here are two examples:

```php
// Example of a Str string.
$string1 = Str::create("   This Is A String   ");

// Overrite initial variable with returned instance.
// Notice that we use other Str as parameters.
$search  = Str::create("This");
$replace = Str::create("That");
$string1 = $string1->replace($search, $replace);

// Perform operations on instance, and assign result to different variables.
$string2 = $string1->trim();
$string3 = $string2->toLower();

if ($string1 === $string2 || $string1 === $string3 || $string2 === $string3) {
    echo "This will never print, as all are different instances.";
}

if ($string1->equals($string2)) {
    echo "This will print, as both instances contain the same value.";
}

echo "{$string1} still has the value '   That Is A String   '.";
echo "{$string2} has the value 'That Is A String'.";
echo "{$string3} has the value 'that is a string'.";
```

```php
// Example of a NString string.
$string1 = NString::create("   This Is A String   ");

// Overrite initial variable with returned instance.
// Notice that we use primitive strings as parameters.
$search  = "This";
$replace = "That";
$string1 = $string1->replace($search, $replace);

// Perform operations on instance, and assign result to different variables.
$string2 = $string1->trim();
$string3 = $string2->toLower();

if ($string1 === $string2 && $string1 === $string3 && $string2 === $string3) {
    echo "This will never print, as all are different instances.";
}

echo "{$string1} still has the value '   That Is A String   '.";
echo "{$string2} has the value 'That Is A String'.";
echo "{$string3} has the value 'that is a string'.";
```

### Fluent Interfaces

You can also do the previous processing, by channing the methods, independently of what type of datatype it is.

```php
// Example of the instance's fluent interface usage.
$string = NString::create("   This Is A String   ")
    ->replace("This", "That")
    ->replace("String", "Great Feature")
    ->trim()
    ->toLower();

echo "{$string} has the value 'that is a great feature'";
```

### Class usage

You can easily import, use and manipulate primitive native data in the following way:

```php
use HraDigital\Datatypes\Scalar\Str;

// ...

$string = Str::create(' This is the string I am trying to manipulate.   ');
```

### Class conversion

You can also convert from one type of string to the other.

```php
// Originally creates an Instance of NString.
$string = NString::create('This is originally a NString.')
    ->replace(' is ', ' was ')
    ->toStr();

echo get_class($string); // Should echo \HraDigital\Datatypes\Scalar\Str
echo $string; // This was originally a NString.

// Converts to original type.
$string = $string->replace(Str::create(' was '), Str::create(' is '))->toNString();

echo get_class($string); // Should echo \HraDigital\Datatypes\Scalar\NString
echo $string; // This is originally a NString.
```
