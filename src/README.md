# PHP Datatypes

PHP Datatypes is an Utility package, meant to provide base/system-wide record and field centralized processing.

When developing bigger projects, you might find yourself validating **fields**, **records** and/or **collections**
of **fields/records** in more than one place.

This packages is meant to supply base classes for most commonly used types of fields, and base functionality that
can facilitate the creation of strongly typed records.

For more information about each type of available object, please read dedicated information:

- [Attributes](Attributes/)
- [Collections](Collections/)
- [Datetime](Datetime/)
- [Exceptions](Exceptions/)
- [Fiscal](Fiscal/)
- [Scalar](Scalar/)
- [Traits](Traits/)
- [ValueObjects](ValueObjects/)
- [Web](Web/)

## Datetime

The package gives two competing date and time classes, with the same method set:

| Class | A changing method (`addDays()`, `startOfMonth()`, `withTimezone()`, ...) |
|---|---|
| `DateTimeImmutable` | returns a NEW instance, and leaves this one untouched |
| `DateTime` | changes THIS instance, and returns it |

Neither class extends the other, and neither extends a native date class. Each one wraps a native
`\DateTimeImmutable`. Both implement `DatetimeContract`: accept that type when a caller can hand in
either class. `equals()`, `compare()`, `isBefore()`, `isAfter()` and `isBetween()` compare the
instant only, so a `DateTime` and a `DateTimeImmutable` of the same instant are equal.

Convert between the two with `DateTime::toImmutable()` and `DateTimeImmutable::toMutable()`.

### The native `\DateTimeInterface`

PHP does not let a user class implement `\DateTimeInterface`. The wrappers are therefore NOT a
`\DateTimeInterface`. When an API needs the native type (Doctrine, `IntlDateFormatter`, a framework):

```php
$entity->setCreatedAt($datetime->toNative());            // a \DateTimeImmutable copy
$datetime = DateTimeImmutable::fromNative($nativeValue); // accepts \DateTime and \DateTimeImmutable
```

### Clock

`now()`, `today()`, `tomorrow()`, `yesterday()`, `isToday()`, `isPast()` and `isFuture()` read the
PSR-20 clock held by `Clock`. It defaults to `SystemClock`. A test freezes the time with:

```php
Clock::set(new FrozenClock(new \DateTimeImmutable('2024-01-01 10:00:00')));
// ...
Clock::reset(); // in tearDown()
```

The clock is set statically, because Entity Traits (eg. `HasUpdatableUpdatedAtTrait`) call `now()`
where a caller cannot pass a clock in.

### Invalid values

`fromString()` and `fromUnits()` throw `Exceptions\Datatypes\InvalidDatetimeException` for a value
that is not a valid date and time, eg. `"2021-02-30"`.

### Migration from `Datetime`

| Before | After |
|---|---|
| `Datetime` | `DateTimeImmutable` |
| `new Datetime($string)` | `DateTimeImmutable::fromString($string)` |
| `Datetime::createFromMutable($native)` | `DateTimeImmutable::fromNative($native)` |
| pass it where a `\DateTimeInterface` is expected | pass `$datetime->toNative()` |
| `$a < $b`, `$a == $b` | `$a->isBefore($b)`, `$a->equals($b)` |
| `fromUnits()` without timezone: default timezone | `fromUnits()` without timezone: `+00:00` |
| an invalid string throws `\Exception` | an invalid string throws `InvalidDatetimeException` |

## Getting started

If you want to get started with this package, please read
[Abstract Value Object's documentation](https://github.com/HRADigital/php-datatypes/blob/master/src/ValueObjects).
