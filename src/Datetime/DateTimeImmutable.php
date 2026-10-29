<?php

/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at https://mozilla.org/MPL/2.0/.
 *
 * Copyright (c) HRADigital - Hugo Rafael Azevedo.
 */

declare(strict_types=1);

namespace HraDigital\Datatypes\Datetime;

use DateTimeImmutable as NativeDateTimeImmutable;
use JsonSerializable;
use Stringable;

/**
 * Immutable Datetime utility class.
 *
 * Wraps a native \DateTimeImmutable, and adds commonly used functionality, with better type
 * hinting for parameters and returned types. Every changing method returns a NEW instance, and
 * leaves this one untouched. DateTime is the mutable class with the same method set.
 *
 * This class is NOT a native \DateTimeInterface: PHP does not let a user class implement it,
 * and a wrapper does not extend the native class. Call `toNative()` when an API needs the native
 * type (Doctrine, IntlDateFormatter, a framework), and `fromNative()` to wrap one.
 *
 * This class was inspired by Carbon\Carbon package, yet it's meant to be a very stripped down version,
 * and is also meant not to have any 3rd party dependencies.
 *
 * If a more complete set of functionality is required, please check Carbon\Carbon.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 * @link      http://php.net/manual/en/timezones.php
 * @link      https://timezonedb.com/download
 */
final class DateTimeImmutable implements DatetimeContract, JsonSerializable, Stringable
{
    use HasStaticFactoryMethodsTrait;
    use HasReadMethodsTrait;
    use HasChangeMethodsTrait;

    private function __construct(private readonly NativeDateTimeImmutable $value)
    {
    }

    /**
     * Returns a mutable DateTime with the same value.
     */
    public function toMutable(): DateTime
    {
        return DateTime::fromNative($this->value);
    }

    private function withValue(NativeDateTimeImmutable $value): static
    {
        return new static($value);
    }
}
