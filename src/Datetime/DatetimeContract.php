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
use HraDigital\Datatypes\Exceptions\Datatypes\InvalidDatetimeException;
use HraDigital\Datatypes\Scalar\Str;
use JsonSerializable;
use Stringable;

/**
 * Shared contract of DateTime (mutable) and DateTimeImmutable.
 *
 * Accept this type when a caller can hand in either class. A changing method returns `static`:
 * DateTimeImmutable gives a new instance, DateTime changes itself and gives `$this`.
 *
 * It extends the package's DateTimeInterface, so the format constants (`ATOM`, `W3C`, ...) stay in
 * one place and stay reachable as `DateTimeImmutable::ATOM`, as they were on the old `Datetime`.
 *
 * This is NOT the native \DateTimeInterface: PHP does not let a user class implement it. Use
 * `toNative()` when an API needs the native type.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 */
interface DatetimeContract extends DateTimeInterface, JsonSerializable, Stringable
{
    /**
     * Returns the value in format "Y-m-d H:i:s".
     */
    public function jsonSerialize(): string;

    public static function now(): static;

    public static function today(): static;

    public static function tomorrow(): static;

    public static function yesterday(): static;

    /**
     * @throws InvalidDatetimeException When the string is not a valid date and time.
     */
    public static function fromString(?string $datetime = null, ?DateTimeZone $timezone = null): static;

    public static function fromTimestamp(int $timestamp, ?DateTimeZone $timezone = null): static;

    /**
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
    ): static;

    public static function fromNative(NativeDateTimeInterface $datetime): static;

    public function toNative(): NativeDateTimeImmutable;

    public function format(string $format): string;

    public function getTimestamp(): int;

    public function toATOM(): Str;

    public function toCookie(): Str;

    public function toISO8601(): Str;

    public function toRFC822(): Str;

    public function toRFC850(): Str;

    public function toRFC1036(): Str;

    public function toRFC1123(): Str;

    public function toRFC7231(): Str;

    public function toRFC2822(): Str;

    public function toRFC3339(): Str;

    public function toRFC3339Extended(): Str;

    public function toRSS(): Str;

    public function toW3C(): Str;

    public function toDatetimeString(): Str;

    public function toDateString(): Str;

    public function toTimeString(): Str;

    public function toFormat(Str $format): Str;

    public function toLocalizedDateTime(Str $dateStyle, Str $timeStyle, Str $locale): Str;

    public function getYear(): int;

    public function getMonth(): int;

    public function getDay(): int;

    public function getHour(): int;

    public function getMinute(): int;

    public function getSecond(): int;

    public function getMicrosecond(): int;

    public function getDayOfWeek(): int;

    public function getDayOfYear(): int;

    public function getWeekOfYear(): int;

    public function getQuarter(): int;

    public function isWeekend(): bool;

    public function isToday(): bool;

    public function isPast(): bool;

    public function isFuture(): bool;

    public function equals(DatetimeContract $other): bool;

    public function isBefore(DatetimeContract $other): bool;

    public function isAfter(DatetimeContract $other): bool;

    public function isBetween(DatetimeContract $start, DatetimeContract $end, bool $inclusive = true): bool;

    public function compare(DatetimeContract $other): int;

    public function diff(DatetimeContract $other): DateInterval;

    public function getTimezone(): DateTimeZone;

    public function withTimezone(DateTimeZone $timezone): static;

    public function add(DateInterval $interval): static;

    public function sub(DateInterval $interval): static;

    public function addSeconds(int $seconds): static;

    public function addMinutes(int $minutes): static;

    public function addHours(int $hours): static;

    public function addDays(int $days): static;

    public function addMonths(int $months): static;

    public function addYears(int $years): static;

    public function subSeconds(int $seconds): static;

    public function subMinutes(int $minutes): static;

    public function subHours(int $hours): static;

    public function subDays(int $days): static;

    public function subMonths(int $months): static;

    public function subYears(int $years): static;

    public function startOfDay(): static;

    public function endOfDay(): static;

    public function startOfMonth(): static;

    public function endOfMonth(): static;

    public function startOfYear(): static;

    public function endOfYear(): static;
}
