# PHP Fiscal Datatypes

- **`Nif`** - Portuguese tax number. Removes all whitespace, requires 9 digits and a valid
  modulo-11 check digit, and casts to its 9-digit string.
- **`NifType`** - `NATURAL_PERSON` (prefixes `1`, `2`, `3`, `45`) or `LEGAL_PERSON` (every other
  valid NIF), as returned by `Nif::getType()` (DL 14/2013, art. 4.º).

```php
$nif = Nif::create('123 456 789');

echo $nif;            // '123456789'
$nif->getType();      // NifType::NATURAL_PERSON

Nif::create('123456788'); // throws InvalidNifException
```
