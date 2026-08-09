# PHP Datatypes

## Master branch build status

[![CI](https://github.com/HRADigital/php-datatypes/actions/workflows/ci.yml/badge.svg?branch=master)](https://github.com/HRADigital/php-datatypes/actions/workflows/ci.yml)
[![Coverage](https://img.shields.io/codecov/c/github/HRADigital/php-datatypes.svg)](https://app.codecov.io/gh/HRADigital/php-datatypes)
[![Quality](https://app.codacy.com/project/badge/Grade/de03155208c64196899848458c2ced8a)](https://www.codacy.com/gh/HRADigital/php-datatypes/dashboard?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=HRADigital/php-datatypes&amp;utm_campaign=Badge_Grade)
[![Downloads](https://img.shields.io/github/downloads/HRADigital/php-datatypes/total.svg)](https://github.com/HRADigital/php-datatypes)
[![Licence](https://img.shields.io/github/license/HRADigital/php-datatypes.svg)](https://github.com/HRADigital/php-datatypes)
[![Version](https://img.shields.io/github/release/HRADigital/php-datatypes.svg)](https://github.com/HRADigital/php-datatypes)
[![PHP](https://img.shields.io/packagist/php-v/hradigital/php-datatypes.svg)](https://github.com/HRADigital/php-datatypes)

## Code Usage

This package is mean to provide you an easy way to do this (_and much more_):

```php
$user = new User([
    'id' => 123,
    'active' => true,
    'name' => ' John Doe ',
]);

echo $user->getId(); // (int) 123
echo $user->isActive(); // (bool) true
echo $user->getName(); // Prints ' John Doe '
echo $user->getName()->trim()->toUpper()->replace(' ', '-'); // Prints 'JOHN-DOE'
echo $user->getName(); // Prints ' John Doe ' again, as Attribute is immutable.
```

... just by building your object like this:

```php
class User extends AbstractValueObject
{
    use HasPositiveIntegerIDTrait,
        HasActiveTrait,
        HasNameTrait;
}
```

Also, out-of-box, it will allow you to do the following:

```php
$user = new User([
    'id' => 123,
    'active' => true,
    'name' => ' John Doe ',
]);

echo json_encode($user); // {"id":123,"active":true,"name":"John Doe"}

$serialized = serialize($user);
$otherUser = unserialize($serialized);

printf($otherUser->toArray());
/*
[
    'id' => 123,
    'active' => true,
    'name' => 'John Doe',
]
*/
```

... and much more. This will leave your objects clean from repetitive state management code, which frees you to
implement your business logic in them.

In order to learn more about the code, please go [here](https://github.com/HRADigital/php-datatypes/blob/master/src/ValueObjects).

## About

**PHP Datatypes** is meant to provide an easy way to create your Value Objects/Entities/Aggregates, in a fast and
platform agnostic way, that promotes:

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

- PHP >= 8.1
- `ext-intl`

```bash
composer require hradigital/php-datatypes
```

## Usage

For more information about how to to use these Datatypes, please see the project's **usage notes** and some implementation examples
in [here](src/).

## Continuous Integration & Testing

The project is validated on every push and pull request through [GitHub Actions](.github/workflows/ci.yml).
The CI pipeline runs:

- **Semantic Commits** - validates that new commit messages follow [Conventional Commits](https://www.conventionalcommits.org),
  via `commitlint` and the rules in [commitlint.config.mjs](commitlint.config.mjs). Only the commits introduced by the
  push/pull request are checked - existing history is never re-validated.
- **Coding Standards** - `PSR2` checks via `PHP_CodeSniffer`.
- **Tests** - the full `PHPUnit` suite against PHP `8.1`, `8.2`, `8.3`, `8.4` and `8.5`, each running inside its own official `php:<version>-cli` Docker container.
- **Code Coverage** - a `clover` report generated with `pcov` and uploaded to [Codecov](https://app.codecov.io/gh/HRADigital/php-datatypes).

Composer scripts are available to run the same checks locally:

```bash
composer run test-cs    # Coding standards (PSR2) over src/
composer run test-code  # PHPUnit suite with coverage + JUnit reports (written to ci/)
composer run test-all   # Runs both of the above
```

To run the test suite without a coverage driver installed:

```bash
./vendor/bin/phpunit --no-coverage
```

### Makefile targets

A [Makefile](Makefile) wraps the same gates with a consistent interface. Run `make help` for the full list:

```bash
make lint       # PHPCS code-style check (report only)
make lint-fix   # Apply PHPCBF code-style fixes
make validate   # Run every report gate concurrently
make test       # Full PHPUnit suite
make test-unit  # Unit testsuite only
```

Scope any target with `FILES` and narrow a test run with `FILTER`. Append `QUIET=1` for silent-on-success -
gates print only on failure, test targets print only their final summary:

```bash
make lint FILES="src/Web/Url.php" QUIET=1
make test-unit FILTER=UrlTest QUIET=1
```

The targets run natively against `vendor/`. Override the `EXEC` prefix to run them elsewhere, e.g.
`make lint EXEC="docker exec <container>"`.

## Versioning & Releases

Releases are cut automatically by [GitHub Actions](.github/workflows/release.yml). The workflow is gated on CI:
it only runs once the CI workflow completes for a `master` push, and it tags the exact commit CI validated - so a
red commit is never released.

The next version is derived entirely from the commit messages since the last tag:

| Commit | Bump |
| --- | --- |
| A `BREAKING CHANGE:` footer | **Major** |
| `feat:` | **Minor** |
| `fix:`, `perf:`, `refactor:`, `revert:`, `build:` | **Patch** |
| `ci:`, `chore:`, `docs:`, `style:`, `test:` | *No release* |

Every change to shipped code therefore bumps at least the revision number, while a docs-only or
tooling-only push does not burn a version. A commit whose message is not a valid Conventional Commit
is skipped entirely by the version calculation - which is what the commitlint CI gate prevents.

> **Breaking changes must use the footer.** The release action detects a major bump *only* from a `BREAKING CHANGE:`
> note - the shorthand `!` suffix (`feat!: ...`) is **not** recognised and would silently release a minor instead.
> Write it on its own line, after a blank line:
>
> ```
> feat: change Url::getHash() to return a Str
>
> BREAKING CHANGE: getHash() now returns Str instead of string. Cast with (string) at call sites.
> ```

## License

Mozilla Public License 2.0. See [LICENSE](LICENSE).

You may use this package in closed-source and commercial products. If you modify and
distribute the package's own files, those files must remain under the MPL-2.0.

The `HRADigital` name and package names are not covered by that licence - see
[TRADEMARK.md](TRADEMARK.md).

## Contributing

Contributing to the project is easy and contributions are welcomed and appreciated.

Commit messages must follow [Conventional Commits](https://www.conventionalcommits.org) - CI rejects anything else,
and the type you pick decides the next release version (see [Versioning & Releases](#versioning--releases) above).

It's obviously harder to maintain the project alone, but efforts will be made to keep and improve it, as I plan to use it as
a dependency in other projects.
