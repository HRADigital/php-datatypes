<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Datetime;

use DateTimeImmutable;
use HraDigital\Datatypes\Scalar\VoString;
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
class DatetimeInheritance extends DateTimeImmutable implements \JsonSerializable
{
    public static function create(string $datetime): DatetimeInheritance
    {
        return new DatetimeInheritance($datetime);
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

    protected function toFormatInternal(string $format): VoString
    {
        return VoString::create(
            $this->format($format)
        );
    }

    /**
     * Returns VoString instance with value in format "Y-m-d\TH:i:sP".
     *
     * @return VoString
     */
    public function toATOM(): VoString
    {
        return $this->toFormatInternal(\Datetime::ATOM);
    }

    /**
     * Returns VoString instance with value in format "l, d-M-Y H:i:s T".
     *
     * @return VoString
     */
    public function toCookie(): VoString
    {
        return $this->toFormatInternal(\Datetime::COOKIE);
    }

    /**
     * Returns VoString instance with value in format "Y-m-d\TH:i:sO".
     *
     * @return VoString
     */
    public function toISO8601(): VoString
    {
        return $this->toFormatInternal(\Datetime::ISO8601);
    }

    /**
     * Returns VoString instance with value in format "D, d M y H:i:s O".
     *
     * @return VoString
     */
    public function toRFC822(): VoString
    {
        return $this->toFormatInternal(\Datetime::RFC822);
    }

    /**
     * Returns VoString instance with value in format "l, d-M-y H:i:s T".
     *
     * @return VoString
     */
    public function toRFC850(): VoString
    {
        return $this->toFormatInternal(\Datetime::RFC850);
    }

    /**
     * Returns VoString instance with value in format "D, d M y H:i:s O".
     *
     * @return VoString
     */
    public function toRFC1036(): VoString
    {
        return $this->toFormatInternal(\Datetime::RFC1036);
    }

    /**
     * Returns VoString instance with value in format "D, d M Y H:i:s O".
     *
     * @return VoString
     */
    public function toRFC1123(): VoString
    {
        return $this->toFormatInternal(\Datetime::RFC1123);
    }

    /**
     * Returns VoString instance with value in format "D, d M Y H:i:s \G\M\T".
     *
     * @return VoString
     */
    public function toRFC7231(): VoString
    {
        return $this->toFormatInternal(\Datetime::RFC7231);
    }

    /**
     * Returns VoString instance with value in format "D, d M Y H:i:s O".
     *
     * @return VoString
     */
    public function toRFC2822(): VoString
    {
        return $this->toFormatInternal(\Datetime::RFC2822);
    }

    /**
     * Returns VoString instance with value in format "Y-m-d\TH:i:sP".
     *
     * @return VoString
     */
    public function toRFC3339(): VoString
    {
        return $this->toFormatInternal(\Datetime::RFC3339);
    }

    /**
     * Returns VoString instance with value in format "Y-m-d\TH:i:s.vP".
     *
     * @return VoString
     */
    public function toRFC3339Extended(): VoString
    {
        return $this->toFormatInternal(\Datetime::RFC3339_EXTENDED);
    }

    /**
     * Returns VoString instance with value in format "D, d M Y H:i:s O".
     *
     * @return VoString
     */
    public function toRSS(): VoString
    {
        return $this->toFormatInternal(\Datetime::RSS);
    }

    /**
     * Returns VoString instance with value in format "Y-m-d\TH:i:sP".
     *
     * @return VoString
     */
    public function toW3C(): VoString
    {
        return $this->toFormatInternal(\Datetime::W3C);
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

    /**
     * Returns VoString instance with value in format "H:i:s".
     *
     * @return VoString
     */
    public function toTimeString(): VoString
    {
        return $this->toFormatInternal('H:i:s');
    }

    /**
     * Returns VoString instance with value in specified format.
     *
     * @param  VoString $format - VoString instance containing desired Datetime format.
     * @return VoString
     */
    public function toFormat(VoString $format): VoString
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
}
