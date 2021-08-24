# PHP Datatypes

## Master branch build status
[![Build](https://img.shields.io/circleci/build/github/HRADigital/php-datatypes.svg)](https://github.com/HRADigital/php-datatypes)
[![Coverage](https://img.shields.io/codecov/c/github/HRADigital/php-datatypes.svg)](https://github.com/HRADigital/php-datatypes)
[![Quality](https://app.codacy.com/project/badge/Grade/de03155208c64196899848458c2ced8a)](https://github.com/HRADigital/php-datatypes)
[![Downloads](https://img.shields.io/github/downloads/HRADigital/php-datatypes/total.svg)](https://github.com/HRADigital/php-datatypes)
[![Licence](https://img.shields.io/github/license/HRADigital/php-datatypes.svg)](https://github.com/HRADigital/php-datatypes)
[![Version](https://img.shields.io/github/release/HRADigital/php-datatypes.svg)](https://github.com/HRADigital/php-datatypes)
[![PHP](https://img.shields.io/packagist/php-v/hradigital/php-datatypes.svg)](https://github.com/HRADigital/php-datatypes)

## About

**PHP Datatypes** is a project meant to conviniently aggregate commonly used **Scalar objects**, other **datatypes** and
**Data Transfer Object**'s base classes into a single package.

Some of the projects that inspired this one, are mainly [Nikita Popov's Scalar Objects](https://github.com/nikic/scalar_objects),
but also [Martin Helmich's Scalar Classes](https://github.com/martin-helmich/php-scalarclasses/) and
[Michael Hall's Datatypes](https://github.com/themichaelhall/datatypes/).

## Requirements

- PHP >= 7.4

## Installation

``` bash
$ composer require hradigital/php-datatypes
```

### Project's purpose/mission

The project's mission is based on the following 4 principles:

- Deliver the biggest amount of datatypes on a single project, that can serve as base code for many different projects.
- Be a self reliant project, without extra dependencies, that only depends on PHP's version and/or native code.
- Provide reliable code, which is fully tested/coverade.
- Provide fully documented code.

### When not to use this project

**PHP Datatypes** provides easily used, simple class interfaces, and each of the supplied datatypes is not meant to fully
provide all code combinations and/or functionality. It's code created for developer's convinience.

If you need a more comprehensive handling of each datatype, there are other alternatives online. Here are a few:

- `nesbot/carbon` for Datetime's processing
- `symfony/string` for String's processing
- `moneyphp/money` for currency's processing
- `egulias/email-validator` for e-mail's processing
- ...

## Usage

For more information about how to to use these Datatypes, please see the project's **usage notes** and some implementation examples
in [here](src/).

## Contributing

Contributing to the project is easy and contributions are welcomed and appreciated.

It's obviously harder to maintain the project alone, but efforts will be made to keep and improve it, as I plan to use it as
a dependency in other projects.
