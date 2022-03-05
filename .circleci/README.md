# CircleCI Continuous Integration

PHP-Datatypes uses CircleCI for code testing and coverage.

The project currently supports version `7.4`, `8.0` & `8.1` of PHP.

## Installation

In order to validate CircleCI configuration, you'll need to install locally `circleci` cli utility:

```bash
sudo snap install circlec
```

After installation of `circleci` utility, you can assess Cding Standards and Testing in multiple supported PHP versions.

## Coding Standards

Run `circleci local execute --job php-cs` from the route of the project in order to test Coding Standards.

## Testing

Run `circleci local execute --job php-74` to test `v7.4`, or replace `74` with `80` or `81`, for versions v`8.0` and `v8.1`.
