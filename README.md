# PHP Datatypes

[![CI](https://github.com/HRADigital/php-datatypes/actions/workflows/ci.yml/badge.svg?branch=master)](https://github.com/HRADigital/php-datatypes/actions/workflows/ci.yml)
[![Release](https://github.com/HRADigital/php-datatypes/actions/workflows/release.yml/badge.svg?branch=master)](https://github.com/HRADigital/php-datatypes/actions/workflows/release.yml)
[![Release](https://img.shields.io/github/v/release/HRADigital/php-datatypes)](https://github.com/HRADigital/php-datatypes/releases)
[![Latest Version on Packagist](https://img.shields.io/packagist/v/hradigital/php-datatypes)](https://packagist.org/packages/hradigital/php-datatypes)
[![Total Downloads](https://img.shields.io/packagist/dt/hradigital/php-datatypes)](https://packagist.org/packages/hradigital/php-datatypes)
[![PHP Version](https://img.shields.io/packagist/php-v/hradigital/php-datatypes)](https://packagist.org/packages/hradigital/php-datatypes)
[![License](https://img.shields.io/github/license/HRADigital/php-datatypes)](LICENSE)
[![Last Commit](https://img.shields.io/github/last-commit/HRADigital/php-datatypes)](https://github.com/HRADigital/php-datatypes/commits/master)
[![Open Issues](https://img.shields.io/github/issues/HRADigital/php-datatypes)](https://github.com/HRADigital/php-datatypes/issues)
[![Contributors](https://img.shields.io/github/contributors/HRADigital/php-datatypes)](https://github.com/HRADigital/php-datatypes/graphs/contributors)
[![Stars](https://img.shields.io/github/stars/HRADigital/php-datatypes)](https://github.com/HRADigital/php-datatypes/stargazers)
[![Code Size](https://img.shields.io/github/languages/code-size/HRADigital/php-datatypes)](https://github.com/HRADigital/php-datatypes)
[![PHPStan](https://img.shields.io/badge/PHPStan-level%206-brightgreen)](phpstan.neon.dist)
[![Code Style](https://img.shields.io/badge/code%20style-PSR2-blue)](phpcs.xml.dist)
[![Conventional Commits](https://img.shields.io/badge/Conventional%20Commits-1.0.0-FE5196?logo=conventionalcommits&logoColor=white)](https://conventionalcommits.org)

**PHP Datatypes** builds your Value Objects, Entities and Aggregates from predefined, tested Traits -
one per attribute - leaving the class definition free for the business logic that belongs to it.

Getters return Value Objects rather than primitives wherever possible, so a value carries its own
validation and normalization instead of every caller remembering it. There is no 3rd party
dependency beyond PHP itself, so these values work without a framework, an HTTP request or a
template engine.

- **`AbstractValueObject`** - the base a Value Object, Entity or Aggregate extends, giving it
  construction from an array, full serialization and `toArray()` out of the box.
- **Entity Traits** - one Trait per attribute (`HasPositiveIntegerIDTrait`, `HasActiveTrait`,
  `HasNameTrait`, ...), each carrying the type hints and normalization for that attribute.
- **Scalar datatypes** - immutable `Str`, integer and float wrappers, with a fluent API that
  returns a new instance on every operation rather than mutating the value in place.
- **Web datatypes** - `Slug`, `Url` and `EmailAddress`, each validating and normalising itself.
- **Datetime datatypes** - date and time values, without pulling in a datetime library.
- **Exception vocabulary** - a typed exception per datatype under `Exceptions\Datatypes\*`, so a
  rejected value says what it rejected and why.

## Scope

This package holds datatypes: values that validate and normalise themselves, and that any PHP
application can use without a framework, an HTTP request or a template engine. The "_No 3rd party
dependency_" rule is a scope rule as much as a dependency rule.

Behaviour that renders, parses documents, or exists to serve a web page is not a datatype, and lives
in [hradigital/php-markup](https://github.com/HRADigital/php-markup) instead. php-markup depends on
this package - never the other way round.

## Inspiration

Some of the projects that inspired this one, are mainly [Nikita Popov's Scalar Objects](https://github.com/nikic/scalar_objects),
but also [Martin Helmich's Scalar Classes](https://github.com/martin-helmich/php-scalarclasses/) and
[Michael Hall's Datatypes](https://github.com/themichaelhall/datatypes/).

Due to the "_No 3rd party dependency_" rule, this package will use some simplified versions of more popular datatypes. Some examples are:

- [synfony/string](https://github.com/symfony/string), for String related manipulations.
- [nesbot/carbon](https://github.com/briannesbitt/Carbon), for DateTime manipulations.
- ...

## Requirements & Installation

- PHP >= 8.2
- `ext-intl`

```bash
composer require hradigital/php-datatypes
```

## Scope reference

| Concern | Package |
|---|---|
| `Slug`, `Url`, `EmailAddress`, `Money`, `Datetime`, … | **php-datatypes** |
| Exception vocabulary (`Exceptions\Datatypes\*`) | **php-datatypes** |
| `Markup` - plain text to structured HTML | php-markup |
| `SocialPreviewImageExtractor` - reads an HTML `<head>` | php-markup |
| `SeoMetadata`, `SocialImage`, `ArticleMetadata`, Open Graph / Twitter enums | php-markup |
| schema.org JSON-LD nodes and their builders | php-markup |

A datatype that needed `Illuminate\*` to work would stop being usable in the non-Laravel hosts this
package exists to serve.

> **Moved in 3.0.0.** `Web\Markup\Markup`, `Web\Markup\MarkupConfiguration`,
> `Web\Seo\SocialPreviewImageExtractor`, `Web\Seo\SeoMetadata`, `Web\Seo\SocialImage`,
> `Web\Seo\ArticleMetadata`, `Web\Seo\OpenGraphType` and `Web\Seo\TwitterCardType` were
> removed from this package and now live in php-markup, under
> `HraDigital\Components\Markup\` and `HraDigital\Components\Markup\Seo\`. `Web\Seo\Slug`,
> `Web\Url` and `Web\EmailAddress` are unaffected and stay here.

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

An Aggregate/Entity/ValueObject that extends [AbstractValueObject](https://github.com/HRADigital/php-datatypes/blob/master/src/ValueObjects/AbstractValueObject.php)
will be built using predefined/tested [Traits](https://github.com/HRADigital/php-datatypes/tree/master/src/Traits/Entities) for each of the class attributes,
leaving your class definition cleaned/free for your business logic implementation.

This will also allow you to reuse/load your objects with data that can come from a Database, Webservice, Event payload, etc...

To learn how to use this package, please go to [AbstractValueObject](https://github.com/HRADigital/php-datatypes/blob/master/src/ValueObjects/) documentation.

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
- **Tests** - the full `PHPUnit` suite against PHP `8.2`, `8.3`, `8.4` and `8.5`, each running inside its own official `php:<version>-cli` Docker container.

Composer scripts are available to run the same checks locally:

```bash
composer run test-cs    # Coding standards (PSR2) over src/
composer run test-code  # PHPUnit suite with JUnit report (written to ci/)
composer run test-all   # Runs both of the above
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

## Contributing

Contributing to the project is easy and contributions are welcomed and appreciated.

Commit messages must follow [Conventional Commits](https://www.conventionalcommits.org) - CI rejects anything else,
and the type you pick decides the next release version (see [Versioning & Releases](#versioning--releases) above).

It's obviously harder to maintain the project alone, but efforts will be made to keep and improve it, as I plan to use it as
a dependency in other projects.

## License

Mozilla Public License 2.0. See [LICENSE](LICENSE).

You may use this package in closed-source and commercial products. If you modify and
distribute the package's own files, those files must remain under the MPL-2.0.

The `HRADigital` name and package names are not covered by that licence - see
[TRADEMARK.md](TRADEMARK.md).
