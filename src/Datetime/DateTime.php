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
 * Mutable Datetime utility class.
 *
 * Wraps a native \DateTimeImmutable, and adds commonly used functionality, with better type
 * hinting for parameters and returned types. Every changing method changes THIS instance, and
 * returns it. DateTimeImmutable is the immutable class with the same method set.
 *
 * The wrapped value is a native \DateTimeImmutable that a change replaces, so `toNative()` never
 * hands out a reference that can change this instance.
 *
 * This class is NOT a native \DateTimeInterface: PHP does not let a user class implement it,
 * and a wrapper does not extend the native class. Call `toNative()` when an API needs the native
 * type (Doctrine, IntlDateFormatter, a framework), and `fromNative()` to wrap one.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 * @link      http://php.net/manual/en/timezones.php
 * @link      https://timezonedb.com/download
 */
final class DateTime implements DatetimeContract, JsonSerializable, Stringable
{
    use HasStaticFactoryMethodsTrait;
    use HasReadMethodsTrait;
    use HasChangeMethodsTrait;

    private function __construct(private NativeDateTimeImmutable $value)
    {
    }

    /**
     * Returns an immutable DateTimeImmutable with the same value.
     */
    public function toImmutable(): DateTimeImmutable
    {
        return DateTimeImmutable::fromNative($this->value);
    }

    private function withValue(NativeDateTimeImmutable $value): static
    {
        $this->value = $value;

        return $this;
    }
}
