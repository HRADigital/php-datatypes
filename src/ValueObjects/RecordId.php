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
use InvalidArgumentException;
use Ramsey\Uuid\Rfc4122\FieldsInterface as Rfc4122FieldsInterface;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use function bin2hex;
use function strlen;

/**
 * Record ID datatype - an RFC 4122 UUID, version 7 enforced.
 *
 * Holds the same UUID in two forms: the canonical lower-case string and the
 * 16-byte binary. The factories are the only way to create an instance - each
 * parses its input once, rejects any version other than 7 (nil and max as well),
 * and hands the parsed UUID to the private constructor. The constructor is
 * final, so a subclass cannot declare its own.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 */
readonly class RecordId
{
    public const VERSION = 7;

    public const BYTES_LENGTH = 16;

    private string $value;

    private string $bytes;

    final private function __construct(UuidInterface $uuid)
    {
        $this->value = $uuid->toString();
        $this->bytes = $uuid->getBytes();
    }

    public static function generate(): static
    {
        return new static(Uuid::uuid7());
    }

    public static function fromString(string $value): static
    {
        if (! Uuid::isValid($value)) {
            throw InvalidUuidException::withValue($value);
        }

        try {
            $uuid = Uuid::fromString($value);
        } catch (InvalidArgumentException $e) {
            throw InvalidUuidException::withValue($value, $e);
        }

        return new static(self::assertV7($uuid, $value));
    }

    public static function fromBytes(string $bytes): static
    {
        $printable = bin2hex($bytes);

        if (strlen($bytes) !== self::BYTES_LENGTH) {
            throw InvalidUuidException::withValue($printable);
        }

        try {
            $uuid = Uuid::fromBytes($bytes);
        } catch (InvalidArgumentException $e) {
            throw InvalidUuidException::withValue($printable, $e);
        }

        return new static(self::assertV7($uuid, $printable));
    }

    public function toBytes(): string
    {
        return $this->bytes;
    }

    public function equals(self $other): bool
    {
        return $other::class === static::class && $this->value === $other->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }

    private static function assertV7(UuidInterface $uuid, string $printable): UuidInterface
    {
        $fields = $uuid->getFields();

        if (! $fields instanceof Rfc4122FieldsInterface || $fields->getVersion() !== self::VERSION) {
            throw InvalidUuidException::withValue($printable);
        }

        return $uuid;
    }
}
