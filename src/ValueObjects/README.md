# Value Objects & Entities

**Value Object** are objects used to transport data **from** and **to** the **Domain**, but also play an important part
in validating data integrity on a record.

3rd party objects, or _loosely typed_ values should be avoided at all costs.

**Value Objects** are also used to enforce data consistency within a record, and validate internal rules.

## Building a new Value Object

To start building your ValueObjects/Entities with this package, you'll need to create your class extending `AbstractValueObject`.
Afterwards, you should include the corresponding `Traits` for each one of the fields your object will have.

### Loading data into Value Object

After you define your ValueObject/Entity structure, you can load data into it by passing an associative array to its Constructor.

If the attribute is not set in the class through Attribute Traits, it will not be loaded into the object's state.

```php
$user = new UserEntity([
    'id' => 123,
    'active' => true,
    'name' => ' John Doe ',
]);

echo $user->getName(); // Prints ' John Doe '
echo $user->getName()->trim()->toUpper()->replace(' ', '-'); // Prints 'JOHN-DOE'
echo $user->getName(); // Prints ' John Doe ' again, as Attribute is immutable.
```

### Field Traits

Each Field Trait will have 3 required class members:

- Attribute (`protected`) - Holds field's state.
- Casting method (`protected`) - Casts primite value to strongly typed object (eg:. `"SomeString"` => `Str::class`).
- Getter (`public`) - Provides a way to access the field's value.

```php
trait HasEmailTrait
{
    protected ?EmailAddress $email = null;

    protected function castEmail(string $email): void
    {
        $this->email = EmailAddress::create($email);
    }

    public function getEmail(): ?EmailAddress
    {
        return $this->email;
    }
}
```

You can build whole objects using these `Traits`.

By default, when adding these `Traits`, your object will be immutable.
If you're creating a mutable Entity, you'll need to define state mutation logic within your class.

```php
class MyEntity extends AbstractValueObject
{
    use HasPositiveIntegerIDTrait,
        HasActiveTrait,
        HasNameTrait,
        HasEmailTrait,
        HasCreatedAtTrait,
        HasUpdatedAtTrait;
}
```

### Field Mapping & Requirement

As these ValueObjects/Entities are meant to be platform agnostic, they might be loaded into your application from different sources.
Eg:. Database, Webservice, WebRequests, Events, ...

Therefore, and because the same information might be represented with slight structural changes, `AbstractValueObject` provides you
with field mapping when loading data into it. Mapping will occour before state is loaded into the object.

You should define which fields names are mapped to which fields, in your class definition.

You can also define which fields are necessary on object's instantiation, by adding them to a `$required` array.
If these fields are not present while loading the class, and Exception will be raised.

In the following example, the names `full_name`, `fullname`, `fullName` will all be mapped to `name`, and we'll set `name` & `active`
as required fields for the class:

```php
class MyEntity extends AbstractValueObject
{
    use HasPositiveIntegerIDTrait,
        HasActiveTrait,
        HasNameTrait;

    protected array $maps = [
        'full_name' => 'name',
        'fullname' => 'name',
        'fullName' => 'name',
    ];

    protected array $required = [
        'active',
        'name',
    ];
}
```

### Field Rules & onLoad Event Handlers

You can define rules for the object, which will manipulate the loaded data bafore it is set on the object's state. You can also
add `onLoad` event handlers to manipulate data after class state is loaded, but before the object's instanciation is finalized.

For rules, define a as many `protected` methods as you'd like, with a prefix `rule`, that will take a `$fields` array,
and return it after mmanipulation.

For the `onLoad` event handlers, define as many as you'de like with a prefix `onLoad`, and no parameters nor returned type.
These handlers will get called, after the object's state is alreayd loaded.

```php
class UserEntity extends AbstractValueObject
{
    use HasPositiveIntegerIDTrait,
        HasNameTrait;

    protected function ruleConcatenateFirstAndLastNames(array $fields): array
    {
        if (isset($fields['first']) && isset($fields['last'])) {
            $fields['name'] = $fields['first'] . ' ' . $fields['last'];
        }

        return fields;
    }

    protected function onLoadConvertNameToUpperCase(): void
    {
        $this->name = $this->name->toUpper();
    }
}

$user = new UserEntity([
    'id' => 123,
    'first' => 'John',
    'last' => 'Doe',
]);

echo $user->getName(); // Prints 'JOHN DOE'
```

## Accessing & Serializing data

By default, your ValueObject's/Entity's attributes can be accessed by Getters available in the different `Traits`, but you might
want to retrieve the full record in your application.
`AbstractValueObject` provides you with two methods for this:

- `getAttributes()` will get you the attributes, for the first level record only.
- `toArray()` will return a full representation of record, including nested ValueObjects/Entities in it (eg:. _Aggregate Roots_).

You can also easily serialize and unserialize objects that extend `AbstractValueObject`:

```php
$oldUser = new UserEntity([
    'id' => 123,
    'name' => 'John Doe',
]);

$serialized = serialize($oldUser);
$newUser = unserialize($serialized);

echo $newUser->getName(); // Prints 'John Doe'
```

### JSON Serializing

Apart from easy serializing, classes extending `AbstractValueObject` can also easily be converted to JSON, if you which to output
them, for example, in an API Response.

On top of this, and because you might want to protect certain fields, you can also define which fields won't be serializable into
JSON, by filling in a `$guarded` internal array.

```php
class MyEntity extends AbstractValueObject
{
    use HasPositiveIntegerIDTrait,
        HasNameTrait,
        HasEmailTrait,
        HasPasswordTrait,
        HasCreatedAtTrait;

    protected array $guarded = [
        'email',
        'password',
    ];
}

$user = new UserEntity([
    'id' => 123,
    'name' => 'John Doe',
    'email' => 'john.doe@domain.tld',
    'password' => 'poiouashfiahsifuahpsdfphapsdfpoasopasyeytnracsyntaynetyaoeya',
    'created_at' => '2022-02-02 12:30:00',
]);

$json = json_encode($user);
echo $json; // NO EMAIL OR PASSWORD

/*
{
  "id": 123,
  "name": "John Doe",
  "created_at": "2022-02-02 12:30:00"
}
*/
```

## Manipulating State

If you want to keep track of the object's state, you can include the Trait `CanProcessEntityStateTrait` in your class.

This `Trait` can provide you information, about attributes that have been changed since load.

```php
class UserEntity extends AbstractValueObject
{
    use HasPositiveIntegerIDTrait,
        HasActiveTrait,
        HasNameTrait,
        CanProcessEntityStateTrait;

    public function activate(): void
    {
        $this->active = true;
    }
}

$user = new UserEntity([
    'id' => 123,
    'active' => false,
    'name' => 'John Doe',
]);

$user->isDirty(); // FALSE
$user->activate();
$user->isDirty(); // TRUE

/*
$user->getDirty();

OUTPUTS
[
    'active' => true,
]
*/
```

### Reacting to State changes

You can react to state changes, by adding a second Trait `CanProcessOnUpdateEventsTrait` to your class.

Afterwards, and at this point, your class will need to call `$this->triggerOnUpdate();` inside your Mutators/Setters,
in order to trigger all "_onUpdate_" event handlers. This is not done automatically, at this point.

If you need to react to this event, you can declare as many `protected` methods as you which, with the prefix `onUpdate`,
without any parameters or returned type.

```php
class UserEntity extends AbstractValueObject
{
    use HasPositiveIntegerIDTrait,
        HasActiveTrait,
        HasNameTrait,
        HasCreatedAtTrait,
        CanProcessEntityStateTrait,
        CanProcessOnUpdateEventsTrait;

    public function activate(): void
    {
        $this->active = true;
        $this->triggerOnUpdate();
    }

    public function rename(Str $newName): void
    {
        $this->name = $newName;
        $this->triggerOnUpdate();
    }

    protected function onUpdateChangeUpdatedAtField(): void
    {
        $this->updated_at = DateTime::now();
    }
}

$user->getUpdatedAt(); // Initially loaded DateTime.
$user->activate();
$user->rename(
    Str::create('John Smith')
);
$user->getUpdatedAt(); // Updated DateTime.
```
