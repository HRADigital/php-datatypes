<?php

/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at https://mozilla.org/MPL/2.0/.
 *
 * Copyright (c) HRADigital - Hugo Rafael Azevedo.
 */

declare(strict_types=1);

namespace HraDigital\Datatypes\Fiscal;

use HraDigital\Datatypes\Exceptions\Datatypes\InvalidNifException;
use function preg_match;
use function preg_replace;
use function str_starts_with;

/**
 * Portuguese tax number (NIF) datatype.
 *
 * Nine digits, the last of which is a modulo-11 check digit over the first eight.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 */
readonly class Nif
{
    /** Leading digits that identify a natural person (DL 14/2013, art. 4.º). */
    private const NATURAL_PERSON_PREFIXES = ['1', '2', '3', '45'];

    private string $value;

    protected function __construct(string $value)
    {
        $normalized = (string) preg_replace('/\s+/u', '', $value);

        if (preg_match('/^[0-9]{9}$/', $normalized) !== 1 || !self::hasValidCheckDigit($normalized)) {
            throw InvalidNifException::withValue($value);
        }

        $this->value = $normalized;
    }

    /**
     * Builds a new Nif instance from a primitive string. Whitespace is removed before validation.
     *
     * @throws InvalidNifException When the value is not 9 digits or its check digit does not match.
     */
    public static function create(string $value): self
    {
        return new self($value);
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public function equals(self $other): bool
    {
        return $this->value === (string) $other;
    }

    public function getType(): NifType
    {
        foreach (self::NATURAL_PERSON_PREFIXES as $prefix) {
            if (str_starts_with($this->value, $prefix)) {
                return NifType::NATURAL_PERSON;
            }
        }

        return NifType::LEGAL_PERSON;
    }

    /**
     * Sums the first 8 digits with weights 9 down to 2. A remainder below 2 maps to check
     * digit 0, any other remainder to 11 minus the remainder.
     */
    private static function hasValidCheckDigit(string $digits): bool
    {
        $sum = 0;
        for ($i = 0; $i < 8; $i++) {
            $sum += (int) $digits[$i] * (9 - $i);
        }

        $remainder = $sum % 11;
        $checkDigit = $remainder < 2 ? 0 : 11 - $remainder;

        return $checkDigit === (int) $digits[8];
    }
}
