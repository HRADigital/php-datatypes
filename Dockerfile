# Test-run image for php-datatypes.
#
# One parameterised image serves every PHP version the package supports, so a
# developer runs the suite against 8.2/8.3/8.4/8.5 with the same Dockerfile CI
# uses. Build arg picks the interpreter:
#
#     docker build --build-arg PHP_VERSION=8.4 -t php-datatypes:8.4 .
#     docker run --rm -v "$PWD":/app php-datatypes:8.4 vendor/bin/phpunit
ARG PHP_VERSION=8.2

FROM php:${PHP_VERSION}-cli

# php:<v>-cli is deliberately minimal. The package requires intl (composer.json);
# PHPCS and the PHPStan parser need mbstring; Composer needs git/unzip to install
# from dist; zip backs the archive handling Composer prefers over the PHP fallback.
RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        git \
        unzip \
        libicu-dev \
        libonig-dev \
        libzip-dev \
    && docker-php-ext-install intl mbstring zip \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer

ENV COMPOSER_ALLOW_SUPERUSER=1

# Without it every Composer call that reads the repo version fails on the
# bind-mounted .git being owned by a different user ("dubious ownership").
RUN git config --system --add safe.directory /app

WORKDIR /app

CMD ["php", "-v"]
