# PHP Datatypes

## Master branch build status:
[![Build](https://img.shields.io/circleci/build/github/HRADigital/php-datatypes.svg)](https://github.com/HRADigital/php-datatypes)
[![Coverage](https://codecov.io/gh/HRADigital/php-datatypes/branch/master/graph/badge.svg?token=voJmDwksFU)](https://github.com/HRADigital/php-datatypes)
[![Quality](https://api.codacy.com/project/badge/Grade/3be6c231eea84329878a59a66af49e2f)](https://github.com/HRADigital/php-datatypes)
[![Downloads](https://img.shields.io/github/downloads/HRADigital/php-datatypes/total.svg)](https://github.com/HRADigital/php-datatypes)
[![Licence](https://img.shields.io/github/license/HRADigital/php-datatypes.svg)](https://github.com/HRADigital/php-datatypes)
[![Version](https://img.shields.io/github/release/HRADigital/php-datatypes.svg)](https://github.com/HRADigital/php-datatypes)

## About

**PHP Datatypes** is a project is based and inspired on many other projects around, and is mainly meant to bring support
for **Scalar objects** and other common **Complex datatypes** into PHP, while native support isn't around.

Some of the projects that inspired this one, are mainly [Nikita Popov's Scalar Objects](https://github.com/nikic/scalar_objects),
but also [Martin Helmich's Scalar Classes](https://github.com/martin-helmich/php-scalarclasses/) and
[Michael Hall's Datatypes](https://github.com/themichaelhall/datatypes/).

### Scalar objects

**PHP Datatypes** will initially wrap common functionality to PHP's native datatypes, such as `string`, `integer`, `float`
and `boolean`.

### Complex datatypes

There will also be wrapping classes around **Complex Datatypes** such as `Datetime`, `Email`, `Color`, `UrlAddress`, ...,
and both _Linear_ and _Associative_ **Collections** such as `Queues`, `Stacks` and `Sets`/`Stores`.

## Installation

In order to install this package, just add it to your **composer**, by executing `composer require hradigital/php-datatypes`.

For general usage of the project's code, please read the project's [usage notes](/src).

## Contributing

Contributing to the project is easy and contributions are welcomed and appreciated.

It's obviously harder to maintain the project alone, but efforts will be made to keep and improve it, as I plan to use it
as a dependency in other projects.
