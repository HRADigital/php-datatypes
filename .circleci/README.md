# CircleCI Continuous Integration

PHP-Datatypes uses CircleCI for code testing and coverage.

The project currently supports version `7.4`, `8.0` & `8.1` of PHP.

## Installation

In order to validate CircleCI configuration, you'll need to install locally `circleci` cli utility:

```bash
sudo snap install circleci
```

After installation of `circleci` utility, you can assess Coding Standards and Testing in multiple supported PHP versions.

In order to test CircleCI configiuration file, you can run `circleci config validate`.

## Coding Standards

Run `circleci local execute --job php-cs` from the root of the project in order to test Coding Standards.

Coding standards' job will also give you information about the environment and project it's running on:

### PHP Version

```bash
PHP 7.4.26 (cli) (built: Nov 23 2021 21:06:06) ( NTS )
Copyright (c) The PHP Group
Zend Engine v3.4.0, Copyright (c) Zend Technologies
```

### Project's Statistics

```bash
-------------------------------------------------------------------------------
Language                     files          blank        comment           code
-------------------------------------------------------------------------------
PHP                            108           1129           4016           4139
Markdown                        27            171              0            431
YAML                             1              6              0             83
JSON                             1              0              0             47
-------------------------------------------------------------------------------
SUM:                           137           1306           4016           4700
-------------------------------------------------------------------------------
```

In order to access Code Coverage reports, please go to [CodeDov](https://app.codecov.io/gh/HRADigital/php-datatypes).

## Testing

Run `circleci local execute --job php-74` to test `v7.4`, or replace `74` with `80` or `81`, for versions `v8.0` & `v8.1`:

- `circleci local execute --job php-74`
- `circleci local execute --job php-80`
- `circleci local execute --job php-81`

In order to access CI reports, please got to [CircleCI](https://app.circleci.com/pipelines/github/HRADigital/php-datatypes?filter=all).
