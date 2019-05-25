# PHP Datatypes

You can build up to **3 types** of objects per datatype. A `Readonly`, an `Immutable` object and a `Mutable` object.

## Readonly vs. Immutable vs. Mutable

`Mutable` and `Immutable` datatypes will inherit functionality from the `Readonly` datatypes. `Readonly` instances provide
**accessor** methods to retrieve any information from within the instance. The other two datatypes will provide **mutators**
that can manipulate the internal state of the instance.

Both `Mutable` and `Immutable` instances have _fluent interfaces_, and therefore you can chain mutator methods, and make
several changes in the same line of code. The main difference between the two, is that `Mutable` instances will return the
same instance everytime, and therefore, will change the internal state as you call its _mutators_. `Immutable` instances
will instead return a new instance of the same type, with the processed value. Here are two examples:

```php
// Example of an Immutable string.
$string1 = ImmutableString::fromString("   This Is A String   ");
$string2 = $string1->trim();
$string3 = $string2->toLower();

if ($string1 === $string2 || $string1 === $string3 || $string2 === $string3) {
    echo "This will never print, as all are different instances.";
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

### Method chaning

You can also do the previous processing, by channing the methods, independently of what type of datatype it is.

```php
// Example of chaning methods.
$string1 = ImmutableString::fromString("   This Is A String   ");
$string2 = MutableString::fromString("   This Is A String   ");

// Both will print out 'this is a string'.
echo $string1->trim()->toLower();
echo $string2->trim()->toLower();
```

## Domain Driven Design

These datatypes are great if your implementing **Domain Driven Design** methodology to your project, as you can return
`Immutable` datatypes as **Value Objects** in your _Entities_.
