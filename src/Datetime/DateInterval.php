<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Datetime;

use HraDigital\Datatypes\Scalar\VoString;

/**
 * DateInterval utility class.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 * @link      http://php.net/manual/en/timezones.php
 * @link      https://timezonedb.com/download
 */
class DateInterval
{
    protected \DateInterval $interval;

    public static function fromDuration(VoString $duration, bool $inverted = false): DateInterval
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
            \sprintf("P%dH", \abs($hours)),
            ($hours < 0)
        );
    }

    public static function fromMinutes(int $minutes): DateInterval
    {
        return new DateInterval(
            \sprintf("P%dI", \abs($minutes)),
            ($minutes < 0)
        );
    }

    public static function fromSeconds(int $seconds): DateInterval
    {
        return new DateInterval(
            \sprintf("P%dS", \abs($seconds)),
            ($seconds < 0)
        );
    }

    protected function __construct(string $duration, bool $inverted = false)
    {
        $this->interval = new \DateInterval($duration);
        $this->interval->invert = (int) $inverted;
    }

    public function __toString(): string
    {
        return (string) $this->toDatetimeString();
    }

    protected function invertValue(int $value, int $invert): int
    {
        return $invert ? (0 - $value) : $value;
    }

    public function inYears(): int
    {
        return $this->invertValue($this->interval->y, $this->interval->invert);
    }

    public function inMonths(): int
    {
        return $this->invertValue($this->interval->m, $this->interval->invert);
    }

    public function inDays(): int
    {
        return $this->invertValue($this->interval->d, $this->interval->invert);
    }

    public function inHours(): int
    {
        return $this->invertValue($this->interval->h, $this->interval->invert);
    }

    public function inMinutes(): int
    {
        return $this->invertValue($this->interval->i, $this->interval->invert);
    }

    public function inSeconds(): int
    {
        return $this->invertValue($this->interval->s, $this->interval->invert);
    }

    public function inMicroSeconds(): float
    {
        return $this->interval->invert ? (0 - $this->interval->f) : $this->interval->f;
    }

    protected function toFormatInternal(string $format): VoString
    {
        return VoString::create(
            $this->interval->format($format)
        );
    }

    /**
     * Returns VoString instance with value in format "Y-m-d H:i:s".
     *
     * @return VoString
     */
    public function toDatetimeString(): VoString
    {
        return $this->toFormatInternal('Y-m-d H:i:s');
    }

    public function toFormat(VoString $format): VoString
    {
        return $this->toFormatInternal((string) $format);
    }

    public function toDuration(): VoString
    {
        return VoString::create(
            \sprintf(
                'P%dY%dM%dDT%dH%dM%dS',
                $this->interval->y,
                $this->interval->m,
                $this->interval->d,
                $this->interval->h,
                $this->interval->i,
                $this->interval->s
            )
        );
    }
}
