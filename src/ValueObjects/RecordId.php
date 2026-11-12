<?php

/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at https://mozilla.org/MPL/2.0/.
 *
 * Copyright (c) HRADigital - Hugo Rafael Azevedo.
 */

declare(strict_types=1);

namespace HraDigital\Datatypes\ValueObjects;

use HraDigital\Datatypes\Exceptions\Datatypes\InvalidUuidException;
use Ramsey\Uuid\Uuid;

/**
 * Record ID datatype - UUID v7 based.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 *
 * @phpstan-consistent-constructor
 */
readonly class RecordId
{
    protected function __construct(protected string $value)
    {
    }

    public static function generate(): static
    {
        return new static(Uuid::uuid7()->toString());
    }

    public static function fromString(string $value): static
    {
        if (! Uuid::isValid($value)) {
            throw InvalidUuidException::withValue($value);
        }

        return new static(Uuid::fromString($value)->toString());
    }

    public function equals(self $other): bool
    {
        return $other::class === static::class && $this->value === $other->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
