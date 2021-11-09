# Domain Value Objects

**Value Object** are objects used to transport data **from** and **to** the **Domain**, but also play an important part
in validating data integrity on a record.

3rd party objects, or _loosely typed_ values should be avoided at all costs.

**Value Objects** are also used to enforce data consistency within a record, and validate internal rules.

## Building a new Value Object

The first thing you should assess, is the context of the **Value Object** you're trying to model.

Similar contexted **Value Objects**, will be placed near each other in the filesystem/namespace.

All **Value Objects** should be located in the `HraDigital\Basetypes\ValueObjects` namespace, followed by the same segments
present in the file system, up to the class definition.

### Value Objects are immutable

Value Objects should be treated as immutable, and therefore, once data is loaded into them, it should not be changed.

In order to change the values on a Value Object, a new one whould be created, opposite to Entities that can change state.

### Declaring Value Object's fields/attributes

You should declare as `protected`, all the **Value Object** fields you'll want loaded into the class, with the same
name they have in the **persistence layer**, when applicable.

Whenever possible, use **Traits** for commonly used attributes. This will facilitate reusing fields in different
attributes across the application.

If we're talking about a Database as a **persistence layer**, and a given datatable has the _fields_ **name**,
**surname** and **date_of_birth**, the **Value Object** should have the following `protected` _attributes_:

```php
class MyValueObject extends AbstractValueObject
{
    protected VoString $name;
    protected VoString $surname;
    protected Datetime $date_of_birth;
}
```

### Declaring Accessor methods for the Attributes you want visible

For each attribute that you want to make available from outside the Value Object, you should declare an accessor/getter.
These method's names can be whatever you want, they should be declared `public`, and should return the required value.

For an attribute called `$name`, a good accessor method's signature would be `public function name(): string;`.

### Casting and/or Sanitizing values into the Value Object's state

Each attribute should have a `protected` mutator starting with **cast** followed by the capitalized attribute name, without
the underscores. Eg:. An Attribute called `$user_id` would have a `protected` mutator/sanitizing method called
`castUserId(int $id)`. This mutator will be called internally, and will sanitize the attribute's value before setting it.

### Rules for multiple attributes

Sometimes, your Value Object might have more than one attributes which are dependent on each other. When this happens,
your should declare a **rule** in your **Value Object**.

**Rules** are just special methods, which take the initial data array as reference, and perform operations on it, breaking it
if required. You can have as many rules as required, and they should be declared in the Value Object for which they exist.

In order to declare a **rule**, you'll just need to declare a `protected` method, which takes an array of fields as reference.
Eg:. `protected function ruleMySpecialRule(array $fields): array;`.

### Setting Attributes as Required

Required attributes, are attributes that will need to be present when first loading the Value Object. If not present,
Value Object loading functionality will raise an Exception, and Value Object will not be instantiated. These are usually
fields that don't have a default value in the persistence layer.

In order to set attributes as required, you'll just need to list them in the `protected` array named `$required`.
Eg:. `protected $required = ['name', 'surname'];`

### Mapping different names to Attributes

You may wish to hide internal Attribute's names, or just have them load data when providing different names in the loading array.
One possible example is, if the fields in the Client's request, are different from the ones used internally in the Value Object.
You can do this by mapping those field names in the `protected $maps = [];` array.

As a **key**, you'll set the mapping attribute name, and in the **value**, you'll set the native Entity's attribute name.

```php
protected $maps = [
    'first' => 'name',
    'last'  => 'surname',
];
```

## Using the Value Object

### Example Value Object with Required attributes only

```php
class Person extends AbstractvalueObject
{
    protected VoString $name;
    protected VoString $surname;

    protected array $required = ['name', 'surname'];
}
```

### Example Value Object, where we add casting/sanitizing methods

```php
class Person extends AbstractValueObject
{
    // ... Previous content.

    protected function castName(string $name): void
    {
        $this->name = VoString::create($name)->trim();
    }

    protected function castSurname(string $surname): void
    {
        $this->surname = VoString::create($surname)->trim();
    }
}
```

### Example Value Object, where we add accessor methods

```php
class Person extends AbstractValueObject
{
    // ... Previous content.

    public function name(): VoString
    {
        return $this->name;
    }

    public function surname(): VoString
    {
        return $this->surname;
    }
}
```

### Using our Value Object, from within our application

```php
$person = new Person([
    'name'    => 'John',
    'surname' => 'Doe',
]);

// Echoing all the 'properties'.
echo $person->name();    // Echoes 'John'
echo $person->surname(); // Echoes 'Doe'

// The following code will break, because both $name and $surname are required.
$breaks = new Person([
    'name' => 'John',
]);
```

### Mapping different names to our attributes

Mapping definition:

```php
class Person extends AbstractValueObject
{
    // ... Previous content.

    protected $maps = [
        'first' => 'name',
        'last'  => 'surname',
    ];
}
```

```php
$person = new Person([
    'first' => 'John',
    'last'  => 'Doe',
]);

// Echoing all the 'properties'.
echo $person->name();    // Echoes 'John'
echo $person->surname(); // Echoes 'Doe'
```
