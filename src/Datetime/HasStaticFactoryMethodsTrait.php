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
use DateTimeInterface as NativeDateTimeInterface;
use DateTimeZone as NativeDateTimeZone;
use Exception;
use HraDigital\Datatypes\Exceptions\Datatypes\InvalidDatetimeException;
use function checkdate;
use function sprintf;

/**
 * Static factories shared by DateTime and DateTimeImmutable.
 *
 * `now()`, `today()`, `tomorrow()` and `yesterday()` read the time from Clock.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 */
trait HasStaticFactoryMethodsTrait
{
    public static function now(): static
    {
        return new static(Clock::now());
    }

    public static function today(): static
    {
        return new static(
            Clock::now()->setTime(0, 0)
        );
    }

    public static function tomorrow(): static
    {
        return new static(
            Clock::now()->setTime(0, 0)->add(DateInterval::fromDays(1))
        );
    }

    public static function yesterday(): static
    {
        return new static(
            Clock::now()->setTime(0, 0)->sub(DateInterval::fromDays(1))
        );
    }

    /**
     * Builds an instance from a date and time string. A NULL string gives the current time.
     *
     * A relative string (eg. "+1 day") is relative to the system time, not to Clock.
     *
     * @throws InvalidDatetimeException When the string is not a valid date and time.
     */
    public static function fromString(?string $datetime = null, ?DateTimeZone $timezone = null): static
    {
        if ($datetime === null) {
            $now = Clock::now();

            return new static($timezone === null ? $now : $now->setTimezone($timezone));
        }

        try {
            $native = new NativeDateTimeImmutable($datetime, $timezone);
        } catch (Exception $e) {
            throw InvalidDatetimeException::withValue($datetime, $e);
        }

        // A date that does not exist (eg. "2021-02-30") parses with a warning, not an exception.
        $errors = NativeDateTimeImmutable::getLastErrors();
        if ($errors !== false && $errors['warning_count'] > 0) {
            throw InvalidDatetimeException::withValue($datetime);
        }

        return new static($native);
    }

    /**
     * Builds an instance from a Unix timestamp, in the supplied timezone, or the default one.
     */
    public static function fromTimestamp(int $timestamp, ?DateTimeZone $timezone = null): static
    {
        $native = (new NativeDateTimeImmutable())->setTimestamp($timestamp);

        return new static($timezone === null ? $native : $native->setTimezone($timezone));
    }

    /**
     * Builds an instance from its units, in the supplied timezone, or "+00:00" when none is given.
     *
     * @throws InvalidDatetimeException When a unit is out of range.
     */
    public static function fromUnits(
        int $years,
        int $months,
        int $days,
        int $hours = 0,
        int $minutes = 0,
        int $seconds = 0,
        ?DateTimeZone $timezone = null
    ): static {
        if (!checkdate($months, $days, $years)
            || $hours < 0 || $hours > 23
            || $minutes < 0 || $minutes > 59
            || $seconds < 0 || $seconds > 59
        ) {
            throw InvalidDatetimeException::withValue(
                sprintf('%04d-%02d-%02d %02d:%02d:%02d', $years, $months, $days, $hours, $minutes, $seconds)
            );
        }

        $native = (new NativeDateTimeImmutable('now', $timezone ?? new NativeDateTimeZone('+00:00')))
            ->setDate($years, $months, $days)
            ->setTime($hours, $minutes, $seconds);

        return new static($native);
    }

    /**
     * Builds an instance from a native \DateTime or \DateTimeImmutable.
     */
    public static function fromNative(NativeDateTimeInterface $datetime): static
    {
        return new static(
            NativeDateTimeImmutable::createFromInterface($datetime)
        );
    }
}
