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
use Psr\Clock\ClockInterface;

/**
 * Holds the PSR-20 clock that DateTime and DateTimeImmutable read the current time from.
 *
 * The clock is set statically, not passed as a parameter: `now()`, `isToday()`, `isPast()` and
 * `isFuture()` are called deep inside Entity Traits (eg. `HasUpdatableUpdatedAtTrait`), where a
 * caller cannot hand a clock in. A test sets a FrozenClock once, and every call reads it.
 * Call `reset()` in the test's tearDown, to go back to the SystemClock.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 * @link      https://www.php-fig.org/psr/psr-20/
 */
final class Clock
{
    private static ?ClockInterface $clock = null;

    public static function set(ClockInterface $clock): void
    {
        self::$clock = $clock;
    }

    public static function reset(): void
    {
        self::$clock = null;
    }

    public static function now(): NativeDateTimeImmutable
    {
        return (self::$clock ??= new SystemClock())->now();
    }
}
