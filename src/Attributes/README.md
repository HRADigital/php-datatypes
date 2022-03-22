# Attribute's related Traits

In this namespace, you'll several Traits for individual fields, that will help you build your Aggregates/Entities/Value Objects.

Each individual Trait, contains minimum functionality for a specific field.

When adding each of these Traits to your object, you'll automatically add minimum state handling for that specific field.

## Attribute Loading

On the following example, you can see an object with an e-mail address being created:

```php
use HraDigital\Datatypes\Attributes\General\HasEmailTrait;
use HraDigital\Datatypes\ValueObjects\AbstractValueObject;

class MyObject extends AbstractValueObject
{
    use HasEmailTrait;
}
```

## Attribute Accessing

You can load and access the object's data in the following manner:

```php
$object = new MyObject([
    'email' => 'my.email.address@domain.tld',
]);

echo $object->getEmail(); // my.email.address@domain.tld
echo $object->getEmail()->getUsername()->toUpper(); // MY.EMAIL.ADDRESS

```
