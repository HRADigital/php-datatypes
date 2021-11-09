<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Datetime;

use HraDigital\Datatypes\Scalar\Str;
use HraDigital\Datatypes\Traits\Datetime\Datetime\HasStaticFactoryMethodsTrait;

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
class Datetime implements \JsonSerializable //extends \Datetime //implements \Serializable
{
    use HasStaticFactoryMethodsTrait;

    /** Format used for internal object instantiation */
    const START_FORMAT = \DateTimeImmutable::W3C;

    /** @var \DateTimeImmutable $dateTime - Internal value holding instance. */
    protected \DateTimeImmutable $dateTime;

    protected function __construct(string $datetime, ?DateTimeZone $timezone = null)
    {
        $this->dateTime = new \DateTimeImmutable($datetime, $timezone);
    }

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

    /**
     * Returns the Timestamp of the Datetime instance.
     *
     * Number of seconds since the Unix Epoch.
     *
     * @return int
     */
    public function getTimestamp(): int
    {
        return $this->dateTime->getTimestamp();
    }

    /**
     * Returns the timezone's offset.
     *
     * @return int
     */
    public function getOffset(): int
    {
        return $this->dateTime->getOffset();
    }

    /**
     * Get Year part of the instance.
     *
     * @return int
     */
    public function getYear(): int
    {
        return (int) ((string) $this->toFormat(Str::create('Y')));
    }

    /**
     * Get Month part of the instance.
     *
     * @return int
     */
    public function getMonth(): int
    {
        return (int) ((string) $this->toFormat(Str::create('m')));
    }

    /**
     * Get Day part of the instance.
     *
     * @return int
     */
    public function getDay(): int
    {
        return (int) ((string) $this->toFormat(Str::create('d')));
    }

    /**
     * Get Hour part of the instance.
     *
     * @return int
     */
    public function getHour(): int
    {
        return (int) ((string) $this->toFormat(Str::create('H')));
    }

    /**
     * Get Minute part of the instance.
     *
     * @return int
     */
    public function getMinute(): int
    {
        return (int) ((string) $this->toFormat(Str::create('i')));
    }

    /**
     * Get Second part of the instance.
     *
     * @return int
     */
    public function getSecond(): int
    {
        return (int) ((string) $this->toFormat(Str::create('s')));
    }

    /**
     * Internal method for DateInterval addition and subtraction.
     *
     * @param  string $duration - Duration string
     * @param  int    $value
     * @return Datetime
     */
    protected function addDateIntervalValue(string $duration, int $value): Datetime
    {
        $isNegative = ($value < 0);
        $value = (int) \abs($value);

        $dateInterval = new \DateInterval(
            \sprintf($duration, $value)
        );

        if ($isNegative) {
            $dateInterval->invert = 1;
        }

        return new Datetime(
            $this->dateTime
                ->add($dateInterval)
                ->format(self::START_FORMAT)
        );
    }

    /**
     * Add the supplied number of Seconds to the Datetime instance.
     *
     * Supports chaining.
     *
     * @param  int $seconds - Number of Seconds to add to instance. Supports negative numbers for subtraction.
     * @return Datetime
     */
    public function addSeconds(int $seconds): Datetime
    {
        return $this->addDateIntervalValue("PT%dS", $seconds);
    }

    /**
     * Add the supplied number of Minutes to the Datetime instance.
     *
     * Supports chaining.
     *
     * @param  int $minutes - Number of Minutes to add to instance. Supports negative numbers for subtraction.
     * @return Datetime
     */
    public function addMinutes(int $minutes): Datetime
    {
        return $this->addDateIntervalValue("PT%dM", $minutes);
    }

    /**
     * Add the supplied number of Hours to the Datetime instance.
     *
     * Supports chaining.
     *
     * @param  int $hours - Number of Hours to add to instance. Supports negative numbers for subtraction.
     * @return Datetime
     */
    public function addHours(int $hours): Datetime
    {
        return $this->addDateIntervalValue("PT%dH", $hours);
    }

    /**
     * Add the supplied number of Days to the Datetime instance.
     *
     * Supports chaining.
     *
     * @param  int $days - Number of Days to add to instance. Supports negative numbers for subtraction.
     * @return Datetime
     */
    public function addDays(int $days): Datetime
    {
        return $this->addDateIntervalValue("P%dD", $days);
    }

    /**
     * Add the supplied number of Months to the Datetime instance.
     *
     * Supports chaining.
     *
     * @param  int $months - Number of Months to add to instance. Supports negative numbers for subtraction.
     * @return Datetime
     */
    public function addMonths(int $months): Datetime
    {
        return $this->addDateIntervalValue("P%dM", $months);
    }

    /**
     * Add the supplied number of Years to the Datetime instance.
     *
     * Supports chaining.
     *
     * @param  int $years - Number of Years to add to instance. Supports negative numbers for subtraction.
     * @return Datetime
     */
    public function addYears(int $years): Datetime
    {
        return $this->addDateIntervalValue("P%dY", $years);
    }

    public function difference(Datetime $datetime, bool $absolute = false): DateInterval
    {
        $dateInterval = $this->dateTime->diff(
            new \DateTime((string) $datetime),
            $absolute
        );

        return DateInterval::fromDuration(
            Str::create(
                \sprintf(
                    'P%dY%dM%dDT%dH%dM%dS',
                    $dateInterval->y,
                    $dateInterval->m,
                    $dateInterval->d,
                    $dateInterval->h,
                    $dateInterval->i,
                    $dateInterval->s
                )
            ),
            $dateInterval->invert === 1
        );
    }

    public function getStartOfDay(): Datetime
    {
        return new Datetime(
            $this->dateTime->format('Y-m-d 00:00:00')
        );
    }

    public function getEndOfDay(): Datetime
    {
        return new Datetime(
            $this->dateTime->format('Y-m-d 23:59:59')
        );
    }

    protected function toFormatInternal(string $format): Str
    {
        return Str::create(
            $this->dateTime->format($format)
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
     * Returns the Timezone set on the Datetime's instance.
     *
     * @return \DateTimeZone
     */
    public function getTimezone(): \DateTimeZone
    {
        return new \DateTimeZone("Europe/London");
    }

    /**
     * Returns the Timezone set on the Datetime's instance, in string format.
     *
     * @return string
     */
    public function getTimezoneName(): string
    {
        return $this->carbon->timezoneName;
    }
}
