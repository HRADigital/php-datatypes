<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Datetime;

use DateTimeImmutable;
use HraDigital\Datatypes\Scalar\Str;

/**
 * Datetime utility class.
 *
 * The purpose of this class, is to wrap native Datetime class, and provide some extra commonly used
 * functionality, while adding better type hinting, for parameters and returned types.
 *
 * The instance's value is always immutable, therefore, any mutator methods will return a new instance
 * of the same class, with the updated value.
 *
 * This class was inspired by Carbon\Carbon package, yet it's meant to be a very stripped down version,
 * and is also meant not to have any 3rd party dependencies.
 *
 * If a more complete set of functionality is required, please check Carbon\Carbon.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 * @link      http://php.net/manual/en/timezones.php
 * @link      https://timezonedb.com/download
 */
class Datetime extends DateTimeImmutable implements \JsonSerializable
{
    use HasStaticFactoryMethodsTrait;

    /** Format used for internal object instantiation */
    const START_FORMAT = \DateTimeImmutable::W3C;

    /**
     * Magic method for instance printing.
     *
     * @return string
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

    protected function toFormatInternal(string $format): Str
    {
        return Str::create(
            $this->format($format)
        );
    }

    /**
     * Returns Str instance with value in format "Y-m-d\TH:i:sP".
     *
     * @return Str
     */
    public function toATOM(): Str
    {
        return $this->toFormatInternal(\Datetime::ATOM);
    }

    /**
     * Returns Str instance with value in format "l, d-M-Y H:i:s T".
     *
     * @return Str
     */
    public function toCookie(): Str
    {
        return $this->toFormatInternal(\Datetime::COOKIE);
    }

    /**
     * Returns Str instance with value in format "Y-m-d\TH:i:sO".
     *
     * @return Str
     */
    public function toISO8601(): Str
    {
        return $this->toFormatInternal(\Datetime::ISO8601);
    }

    /**
     * Returns Str instance with value in format "D, d M y H:i:s O".
     *
     * @return Str
     */
    public function toRFC822(): Str
    {
        return $this->toFormatInternal(\Datetime::RFC822);
    }

    /**
     * Returns Str instance with value in format "l, d-M-y H:i:s T".
     *
     * @return Str
     */
    public function toRFC850(): Str
    {
        return $this->toFormatInternal(\Datetime::RFC850);
    }

    /**
     * Returns Str instance with value in format "D, d M y H:i:s O".
     *
     * @return Str
     */
    public function toRFC1036(): Str
    {
        return $this->toFormatInternal(\Datetime::RFC1036);
    }

    /**
     * Returns Str instance with value in format "D, d M Y H:i:s O".
     *
     * @return Str
     */
    public function toRFC1123(): Str
    {
        return $this->toFormatInternal(\Datetime::RFC1123);
    }

    /**
     * Returns Str instance with value in format "D, d M Y H:i:s \G\M\T".
     *
     * @return Str
     */
    public function toRFC7231(): Str
    {
        return $this->toFormatInternal(\Datetime::RFC7231);
    }

    /**
     * Returns Str instance with value in format "D, d M Y H:i:s O".
     *
     * @return Str
     */
    public function toRFC2822(): Str
    {
        return $this->toFormatInternal(\Datetime::RFC2822);
    }

    /**
     * Returns Str instance with value in format "Y-m-d\TH:i:sP".
     *
     * @return Str
     */
    public function toRFC3339(): Str
    {
        return $this->toFormatInternal(\Datetime::RFC3339);
    }

    /**
     * Returns Str instance with value in format "Y-m-d\TH:i:s.vP".
     *
     * @return Str
     */
    public function toRFC3339Extended(): Str
    {
        return $this->toFormatInternal(\Datetime::RFC3339_EXTENDED);
    }

    /**
     * Returns Str instance with value in format "D, d M Y H:i:s O".
     *
     * @return Str
     */
    public function toRSS(): Str
    {
        return $this->toFormatInternal(\Datetime::RSS);
    }

    /**
     * Returns Str instance with value in format "Y-m-d\TH:i:sP".
     *
     * @return Str
     */
    public function toW3C(): Str
    {
        return $this->toFormatInternal(\Datetime::W3C);
    }

    /**
     * Returns Str instance with value in format "Y-m-d H:i:s".
     *
     * @return Str
     */
    public function toDatetimeString(): Str
    {
        return $this->toFormatInternal('Y-m-d H:i:s');
    }

    /**
     * Returns Str instance with value in format "H:i:s".
     *
     * @return Str
     */
    public function toTimeString(): Str
    {
        return $this->toFormatInternal('H:i:s');
    }

    /**
     * Returns Str instance with value in specified format.
     *
     * @param  Str $format - Str instance containing desired Datetime format.
     * @return Str
     */
    public function toFormat(Str $format): Str
    {
        return $this->toFormatInternal((string) $format);
    }

    /**
     * Get Year part of the instance.
     *
     * @return int
     */
    public function getYear(): int
    {
        return (int) ((string) $this->toFormatInternal('Y'));
    }

    /**
     * Get Month part of the instance.
     *
     * @return int
     */
    public function getMonth(): int
    {
        return (int) ((string) $this->toFormatInternal('m'));
    }

    /**
     * Get Day part of the instance.
     *
     * @return int
     */
    public function getDay(): int
    {
        return (int) ((string) $this->toFormatInternal('d'));
    }

    /**
     * Get Hour part of the instance.
     *
     * @return int
     */
    public function getHour(): int
    {
        return (int) ((string) $this->toFormatInternal('H'));
    }

    /**
     * Get Minute part of the instance.
     *
     * @return int
     */
    public function getMinute(): int
    {
        return (int) ((string) $this->toFormatInternal('i'));
    }

    /**
     * Get Second part of the instance.
     *
     * @return int
     */
    public function getSecond(): int
    {
        return (int) ((string) $this->toFormatInternal('s'));
    }

    /**
     * Internal method for DateInterval addition and subtraction.
     *
     * @param  string $duration - Duration string
     * @param  int    $value
     * @return self
     */
    protected function addDateIntervalValue(string $duration, int $value): self
    {
        $isNegative = ($value < 0);
        $value = (int) \abs($value);

        $dateInterval = new \DateInterval(
            \sprintf($duration, $value)
        );

        if ($isNegative) {
            $dateInterval->invert = 1;
        }

        return new self(
            $this->add($dateInterval)->format(self::START_FORMAT)
        );
    }

    /**
     * Add the supplied number of Seconds to the Datetime instance.
     *
     * Supports chaining.
     *
     * @param  int $seconds - Number of Seconds to add to instance. Supports negative numbers for subtraction.
     * @return self
     */
    public function addSeconds(int $seconds): self
    {
        return $this->addDateIntervalValue("PT%dS", $seconds);
    }

    /**
     * Add the supplied number of Minutes to the Datetime instance.
     *
     * Supports chaining.
     *
     * @param  int $minutes - Number of Minutes to add to instance. Supports negative numbers for subtraction.
     * @return self
     */
    public function addMinutes(int $minutes): self
    {
        return $this->addDateIntervalValue("PT%dM", $minutes);
    }

    /**
     * Add the supplied number of Hours to the Datetime instance.
     *
     * Supports chaining.
     *
     * @param  int $hours - Number of Hours to add to instance. Supports negative numbers for subtraction.
     * @return self
     */
    public function addHours(int $hours): self
    {
        return $this->addDateIntervalValue("PT%dH", $hours);
    }

    /**
     * Add the supplied number of Days to the Datetime instance.
     *
     * Supports chaining.
     *
     * @param  int $days - Number of Days to add to instance. Supports negative numbers for subtraction.
     * @return self
     */
    public function addDays(int $days): self
    {
        return $this->addDateIntervalValue("P%dD", $days);
    }

    /**
     * Add the supplied number of Months to the Datetime instance.
     *
     * Supports chaining.
     *
     * @param  int $months - Number of Months to add to instance. Supports negative numbers for subtraction.
     * @return self
     */
    public function addMonths(int $months): self
    {
        return $this->addDateIntervalValue("P%dM", $months);
    }

    /**
     * Add the supplied number of Years to the Datetime instance.
     *
     * Supports chaining.
     *
     * @param  int $years - Number of Years to add to instance. Supports negative numbers for subtraction.
     * @return self
     */
    public function addYears(int $years): self
    {
        return $this->addDateIntervalValue("P%dY", $years);
    }
}
