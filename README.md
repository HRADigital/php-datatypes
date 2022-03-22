# PHP Datatypes

## Master branch build status

[![Build](https://img.shields.io/circleci/build/github/HRADigital/php-datatypes.svg)](https://github.com/HRADigital/php-datatypes)
[![Coverage](https://img.shields.io/codecov/c/github/HRADigital/php-datatypes.svg)](https://github.com/HRADigital/php-datatypes)
[![Quality](https://app.codacy.com/project/badge/Grade/de03155208c64196899848458c2ced8a)](https://www.codacy.com/gh/HRADigital/php-datatypes/dashboard?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=HRADigital/php-datatypes&amp;utm_campaign=Badge_Grade)
[![Downloads](https://img.shields.io/github/downloads/HRADigital/php-datatypes/total.svg)](https://github.com/HRADigital/php-datatypes)
[![Licence](https://img.shields.io/github/license/HRADigital/php-datatypes.svg)](https://github.com/HRADigital/php-datatypes)
[![Version](https://img.shields.io/github/release/HRADigital/php-datatypes.svg)](https://github.com/HRADigital/php-datatypes)
[![PHP](https://img.shields.io/packagist/php-v/hradigital/php-datatypes.svg)](https://github.com/HRADigital/php-datatypes)

## Code

In order to learn more about the code, please go [here](https://github.com/HRADigital/php-datatypes/blob/master/src/).

## About

**PHP Datatypes** is meant to provide an easy way to create your Value Objects/Entities/Aggregates, in a fast and platform agnostic way,
that promotes:

- Code reusability
- Data normalization
- Type hint enforcement
- Full data serializing
- No 3rd party dependency apart from PHP. Clean/Self reliant project.

An Aggregate/Entity/ValueObject that extends [AbstractValueObject](https://github.com/HRADigital/php-datatypes/blob/master/src/ValueObjects/AbstractValueObject.php)
will be built using predefined/tested [Traits](https://github.com/HRADigital/php-datatypes/tree/master/src/Traits/Entities) for each of the class attributes,
leaving your class definition cleaned/free for your business logic implementation.

This will also allow you to reuse/load your objects with data that can come from a Database, Webservice, Event payload, etc...

Getters/Accessors for class attributes will return ValueObjects instead of primitive types, as much as possible. All these datatypes will
also be included in the package, as it doesn't have any dependencies apart from, PHP itself.

To learn how to use this package, please go to [AbstractValueObject](https://github.com/HRADigital/php-datatypes/blob/master/src/ValueObjects/) documentation.

### Inspiration

Some of the projects that inspired this one, are mainly [Nikita Popov's Scalar Objects](https://github.com/nikic/scalar_objects),
but also [Martin Helmich's Scalar Classes](https://github.com/martin-helmich/php-scalarclasses/) and
[Michael Hall's Datatypes](https://github.com/themichaelhall/datatypes/).

Due to the "_No 3rd party dependency_" rule, this package will use some simplified versions of more popular datatypes. Some examples are:

- [synfony/string](https://github.com/symfony/string), for String related manipulations.
- [nesbot/carbon](https://github.com/briannesbitt/Carbon), for DateTime manipulations.
- ...

## Requirements & Installation

- PHP >= 7.4||8.*

```bash
composer require hradigital/php-datatypes
```

## Usage

For more information about how to to use these Datatypes, please see the project's **usage notes** and some implementation examples
in [here](src/).

## Contributing

Contributing to the project is easy and contributions are welcomed and appreciated.

It's obviously harder to maintain the project alone, but efforts will be made to keep and improve it, as I plan to use it as
a dependency in other projects.
