<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Datetime;

use DateInterval as ParentDateInterval;
use HraDigital\Datatypes\Exceptions\Datatypes\InvalidDateIntervalException;
use HraDigital\Datatypes\Scalar\Str;

/**
 * DateInterval utility class.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 * @link      http://php.net/manual/en/timezones.php
 * @link      https://timezonedb.com/download
 */
class DateInterval extends ParentDateInterval
{
    #[\ReturnTypeWillChange]
    public static function createFromDateString($datetime): DateInterval
    {
        $result = parent::createFromDateString($datetime);

        if ($result === false) {
            throw new InvalidDateIntervalException();
        }

        return DateInterval::fromDuration(
            Str::create(self::toDurationInternal($result)),
            (bool) $result->invert
        );
    }

    public static function fromDuration(Str $duration, bool $inverted = false): DateInterval
    {
        return new DateInterval((string) $duration, $inverted);
    }

    public static function fromYears(int $years): DateInterval
    {
        return new DateInterval(
            \sprintf("P%dY", \abs($years)),
            ($years < 0)
        );
    }

    public static function fromMonths(int $months): DateInterval
    {
        return new DateInterval(
            \sprintf("P%dM", \abs($months)),
            ($months < 0)
        );
    }

    public static function fromDays(int $days): DateInterval
    {
        return new DateInterval(
            \sprintf("P%dD", \abs($days)),
            ($days < 0)
        );
    }

    public static function fromHours(int $hours): DateInterval
    {
        return new DateInterval(
            \sprintf("PT%dH", \abs($hours)),
            ($hours < 0)
        );
    }

    public static function fromMinutes(int $minutes): DateInterval
    {
        return new DateInterval(
            \sprintf("PT%dM", \abs($minutes)),
            ($minutes < 0)
        );
    }

    public static function fromSeconds(int $seconds): DateInterval
    {
        return new DateInterval(
            \sprintf("PT%dS", \abs($seconds)),
            ($seconds < 0)
        );
    }

    public function __construct(string $duration, bool $inverted = false)
    {
        parent::__construct($duration);

        $this->invert = (int) $inverted;
    }

    public function __toString(): string
    {
        return (string) $this->toDatetimeString();
    }

    protected function invertValue(int $value, int $invert): int
    {
        return $invert ? (0 - $value) : $value;
    }

    public function getYears(): int
    {
        return $this->invertValue($this->y, $this->invert);
    }

    public function getMonths(): int
    {
        return $this->invertValue($this->m, $this->invert);
    }

    public function getDays(): int
    {
        return $this->invertValue($this->d, $this->invert);
    }

    public function getHours(): int
    {
        return $this->invertValue($this->h, $this->invert);
    }

    public function getMinutes(): int
    {
        return $this->invertValue($this->i, $this->invert);
    }

    public function getSeconds(): int
    {
        return $this->invertValue($this->s, $this->invert);
    }

    public function getMicroSeconds(): float
    {
        return $this->invert ? (0 - $this->f) : $this->f;
    }

    protected function toFormatInternal(string $format): Str
    {
        return Str::create(
            $this->format($format)
        );
    }

    /**
     * Returns Str instance with value in format "Y-m-d H:i:s".
     *
     * @return Str
     */
    public function toDatetimeString(): Str
    {
        return $this->toFormatInternal('%r%Yy %Mm %Dd %H:%I:%S');
    }

    public function toFormat(Str $format): Str
    {
        return $this->toFormatInternal((string) $format);
    }

    protected static function toDurationInternal(ParentDateInterval $interval): string
    {
        return \sprintf(
            'P%dY%dM%dDT%dH%dM%dS',
            $interval->y,
            $interval->m,
            $interval->d,
            $interval->h,
            $interval->i,
            $interval->s
        );
    }

    public function toDuration(): Str
    {
        return Str::create(
            self::toDurationInternal($this)
        );
    }

    public function isNegative(): bool
    {
        return (bool) $this->invert;
    }
}
