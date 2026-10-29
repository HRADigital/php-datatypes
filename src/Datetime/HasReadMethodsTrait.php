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
use HraDigital\Datatypes\Scalar\Str;
use IntlDateFormatter;
use InvalidArgumentException;
use function array_keys;
use function implode;
use function intdiv;
use function sprintf;
use function strtolower;

/**
 * Read methods shared by DateTime and DateTimeImmutable. None of them changes the instance.
 *
 * The using class holds the wrapped value in `$this->value`.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 */
trait HasReadMethodsTrait
{
    /**
     * Magic method for instance printing.
     */
    public function __toString(): string
    {
        return (string) $this->toDatetimeString();
    }

    /** @inheritDoc */
    public function jsonSerialize(): string
    {
        return (string) $this;
    }

    /**
     * Returns a copy of the wrapped native value, for APIs that need a \DateTimeInterface.
     */
    public function toNative(): NativeDateTimeImmutable
    {
        return clone $this->value;
    }

    public function format(string $format): string
    {
        return $this->value->format($format);
    }

    public function getTimestamp(): int
    {
        return $this->value->getTimestamp();
    }

    protected function toFormatInternal(string $format): Str
    {
        return Str::create(
            $this->value->format($format)
        );
    }

    /**
     * Returns Str instance with value in format "Y-m-d\TH:i:sP".
     */
    public function toATOM(): Str
    {
        return $this->toFormatInternal(self::ATOM);
    }

    /**
     * Returns Str instance with value in format "l, d-M-Y H:i:s T".
     */
    public function toCookie(): Str
    {
        return $this->toFormatInternal(self::COOKIE);
    }

    /**
     * Returns Str instance with value in format "Y-m-d\TH:i:sO".
     */
    public function toISO8601(): Str
    {
        return $this->toFormatInternal(self::ISO8601);
    }

    /**
     * Returns Str instance with value in format "D, d M y H:i:s O".
     */
    public function toRFC822(): Str
    {
        return $this->toFormatInternal(self::RFC822);
    }

    /**
     * Returns Str instance with value in format "l, d-M-y H:i:s T".
     */
    public function toRFC850(): Str
    {
        return $this->toFormatInternal(self::RFC850);
    }

    /**
     * Returns Str instance with value in format "D, d M y H:i:s O".
     */
    public function toRFC1036(): Str
    {
        return $this->toFormatInternal(self::RFC1036);
    }

    /**
     * Returns Str instance with value in format "D, d M Y H:i:s O".
     */
    public function toRFC1123(): Str
    {
        return $this->toFormatInternal(self::RFC1123);
    }

    /**
     * Returns Str instance with value in format "D, d M Y H:i:s \G\M\T".
     */
    public function toRFC7231(): Str
    {
        return $this->toFormatInternal(self::RFC7231);
    }

    /**
     * Returns Str instance with value in format "D, d M Y H:i:s O".
     */
    public function toRFC2822(): Str
    {
        return $this->toFormatInternal(self::RFC2822);
    }

    /**
     * Returns Str instance with value in format "Y-m-d\TH:i:sP".
     */
    public function toRFC3339(): Str
    {
        return $this->toFormatInternal(self::RFC3339);
    }

    /**
     * Returns Str instance with value in format "Y-m-d\TH:i:s.vP".
     */
    public function toRFC3339Extended(): Str
    {
        return $this->toFormatInternal(self::RFC3339_EXTENDED);
    }

    /**
     * Returns Str instance with value in format "D, d M Y H:i:s O".
     */
    public function toRSS(): Str
    {
        return $this->toFormatInternal(self::RSS);
    }

    /**
     * Returns Str instance with value in format "Y-m-d\TH:i:sP".
     */
    public function toW3C(): Str
    {
        return $this->toFormatInternal(self::W3C);
    }

    /**
     * Returns Str instance with value in format "Y-m-d H:i:s".
     */
    public function toDatetimeString(): Str
    {
        return $this->toFormatInternal('Y-m-d H:i:s');
    }

    /**
     * Returns Str instance with value in format "Y-m-d".
     */
    public function toDateString(): Str
    {
        return $this->toFormatInternal('Y-m-d');
    }

    /**
     * Returns Str instance with value in format "H:i:s".
     */
    public function toTimeString(): Str
    {
        return $this->toFormatInternal('H:i:s');
    }

    /**
     * Returns Str instance with value in specified format.
     */
    public function toFormat(Str $format): Str
    {
        return $this->toFormatInternal((string) $format);
    }

    /**
     * Returns Str instance with value formatted for the supplied locale, using CLDR locale-driven
     * date and time styles.
     *
     * The date/time *style* (full/long/medium/short/none) lets CLDR pick the correct separators,
     * ordering and prepositions per locale - eg. pt_PT "27 de maio de 2026 às 14:32",
     * en_GB "27 May 2026 at 14:32", de_DE "27. Mai 2026 um 14:32".
     *
     * Hand-rolled ICU patterns force one shape across all locales and produce unidiomatic output,
     * so this method intentionally does not accept a pattern.
     */
    public function toLocalizedDateTime(Str $dateStyle, Str $timeStyle, Str $locale): Str
    {
        $styles = [
            'none'   => IntlDateFormatter::NONE,
            'short'  => IntlDateFormatter::SHORT,
            'medium' => IntlDateFormatter::MEDIUM,
            'long'   => IntlDateFormatter::LONG,
            'full'   => IntlDateFormatter::FULL,
        ];

        $date = strtolower((string) $dateStyle);
        $time = strtolower((string) $timeStyle);

        if (!isset($styles[$date]) || !isset($styles[$time])) {
            throw new InvalidArgumentException(
                sprintf('Invalid style. Expected one of: %s.', implode(', ', array_keys($styles)))
            );
        }

        $formatter = new IntlDateFormatter(
            (string) $locale,
            $styles[$date],
            $styles[$time],
            $this->value->getTimezone()
        );

        return Str::create(
            (string) $formatter->format($this->value)
        );
    }

    /**
     * Get Year part of the instance.
     */
    public function getYear(): int
    {
        return (int) $this->value->format('Y');
    }

    /**
     * Get Month part of the instance.
     */
    public function getMonth(): int
    {
        return (int) $this->value->format('m');
    }

    /**
     * Get Day part of the instance.
     */
    public function getDay(): int
    {
        return (int) $this->value->format('d');
    }

    /**
     * Get Hour part of the instance.
     */
    public function getHour(): int
    {
        return (int) $this->value->format('H');
    }

    /**
     * Get Minute part of the instance.
     */
    public function getMinute(): int
    {
        return (int) $this->value->format('i');
    }

    /**
     * Get Second part of the instance.
     */
    public function getSecond(): int
    {
        return (int) $this->value->format('s');
    }

    /**
     * Get Microsecond part of the instance.
     */
    public function getMicrosecond(): int
    {
        return (int) $this->value->format('u');
    }

    /**
     * Get the ISO-8601 day of the week: 1 is Monday, 7 is Sunday.
     */
    public function getDayOfWeek(): int
    {
        return (int) $this->value->format('N');
    }

    /**
     * Get the day of the year: 1 is January 1st.
     */
    public function getDayOfYear(): int
    {
        return (int) $this->value->format('z') + 1;
    }

    /**
     * Get the ISO-8601 week of the year.
     */
    public function getWeekOfYear(): int
    {
        return (int) $this->value->format('W');
    }

    /**
     * Get the quarter of the year: 1 to 4.
     */
    public function getQuarter(): int
    {
        return intdiv($this->getMonth() - 1, 3) + 1;
    }

    public function isWeekend(): bool
    {
        return $this->getDayOfWeek() >= 6;
    }

    /**
     * TRUE when the instance falls on the Clock's current day, in the instance's timezone.
     */
    public function isToday(): bool
    {
        $today = Clock::now()->setTimezone($this->value->getTimezone());

        return $today->format('Y-m-d') === $this->value->format('Y-m-d');
    }

    /**
     * TRUE when the instance is before the Clock's current time.
     */
    public function isPast(): bool
    {
        return $this->value < Clock::now();
    }

    /**
     * TRUE when the instance is after the Clock's current time.
     */
    public function isFuture(): bool
    {
        return $this->value > Clock::now();
    }

    /**
     * Compares the instant (timestamp and microseconds) with another instance: -1 when this one
     * is before, 0 when both are the same instant, 1 when this one is after.
     *
     * The timezone and the class (mutable or immutable) are not compared.
     */
    public function compare(DatetimeContract $other): int
    {
        return $this->value <=> $other->toNative();
    }

    public function equals(DatetimeContract $other): bool
    {
        return $this->compare($other) === 0;
    }

    public function isBefore(DatetimeContract $other): bool
    {
        return $this->compare($other) < 0;
    }

    public function isAfter(DatetimeContract $other): bool
    {
        return $this->compare($other) > 0;
    }

    public function isBetween(DatetimeContract $start, DatetimeContract $end, bool $inclusive = true): bool
    {
        if ($inclusive) {
            return $this->compare($start) >= 0 && $this->compare($end) <= 0;
        }

        return $this->compare($start) > 0 && $this->compare($end) < 0;
    }

    /**
     * Returns the interval from this instance to the supplied one. It is negative when the
     * supplied instance is before this one.
     */
    public function diff(DatetimeContract $other): DateInterval
    {
        $native = $this->value->diff($other->toNative());

        $interval = new DateInterval(
            sprintf('P%dY%dM%dDT%dH%dM%dS', $native->y, $native->m, $native->d, $native->h, $native->i, $native->s),
            (bool) $native->invert
        );
        $interval->f = $native->f;

        return $interval;
    }

    public function getTimezone(): DateTimeZone
    {
        return new DateTimeZone(
            $this->value->getTimezone()->getName()
        );
    }
}
