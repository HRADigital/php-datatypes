<?php declare(strict_types=1);

namespace Hradigital\Datatypes\Traits\Datatypes\Datetime;

use Carbon\Carbon;

/**
 * String exporting dedicated methods use in the datetime datatypes.
 *
 * This Trait is only meant to be used by the Datetime datatype. It assumes
 * a Carbon instance is already loaded into the main class.
 *
 * @package   Hradigital\Datatypes
 * @copyright Hradigital\Datatypes
 * @license   Proprietary
 * @link      http://carbon.nesbot.com/docs/
 */
trait CanFormatOutputTrait
{
    /** @var Carbon $carbon - Carbon's instance. */
    protected Carbon $carbon;

    /**
     * Returns date formatted according to given format
     *
     * @param  string $format - Format to be used on Datetime instance.
     *
     * @return string
     */
    public function format(string $format): string
    {
        return $this->carbon->format($format);
    }

    /**
     * Retrieves the Timestamp representation from the instance.
     *
     * @return integer
     */
    public function toTimestamp(): int
    {
        return $this->carbon->timestamp;
    }

    /**
     * Format the instance as Date.
     *
     * @return string
     */
    public function toDateString(): string
    {
        return $this->carbon->toDateString();
    }

    /**
     * Format the instance as a readable Date.
     *
     * @return string
     */
    public function toFormattedDateString(): string
    {
        return $this->carbon->toFormattedDateString();
    }

    /**
     * Format the instance as Time.
     *
     * @return string
     */
    public function toTimeString(): string
    {
        return $this->carbon->toTimeString();
    }

    /**
     * Format the instance as Date and Time.
     *
     * @return string
     */
    public function toDateTimeString(): string
    {
        return $this->carbon->toDateTimeString();
    }

    /**
     * Format the instance as ATOM
     *
     * @return string
     */
    public function toAtomString(): string
    {
        return $this->carbon->toAtomString();
    }

    /**
     * Format the instance as COOKIE.
     *
     * @return string
     */
    public function toCookieString(): string
    {
        return $this->carbon->toCookieString();
    }

    /**
     * Format the instance as ISO8601.
     *
     * @return string
     */
    public function toIso8601String(): string
    {
        return $this->carbon->toIso8601String();
    }

    /**
     * Format the instance as RFC822.
     *
     * @return string
     */
    public function toRfc822String(): string
    {
        return $this->carbon->toRfc822String();
    }

    /**
     * Format the instance as RFC850.
     *
     * @return string
     */
    public function toRfc850String(): string
    {
        return $this->carbon->toRfc850String();
    }

    /**
     * Format the instance as RFC1036.
     *
     * @return string
     */
    public function toRfc1036String(): string
    {
        return $this->carbon->toRfc1036String();
    }

    /**
     * Format the instance as RFC1123.
     *
     * @return string
     */
    public function toRfc1123String(): string
    {
        return $this->carbon->toRfc1123String();
    }

    /**
     * Format the instance as RFC2822.
     *
     * @return string
     */
    public function toRfc2822String(): string
    {
        return $this->carbon->toRfc2822String();
    }

    /**
     * Format the instance as RFC3339.
     *
     * @return string
     */
    public function toRfc3339String(): string
    {
        return $this->carbon->toRfc3339String();
    }

    /**
     * Format the instance as RSS.
     *
     * @return string
     */
    public function toRssString(): string
    {
        return $this->carbon->toRssString();
    }

    /**
     * Format the instance as W3C.
     *
     * @return string
     */
    public function toW3cString(): string
    {
        return $this->carbon->toW3cString();
    }

    /**
     * Format the instance to a valid DatetimeBox's value string.
     *
     * @return string
     */
    public function toDatetimeBoxString(): string
    {
        return $this->carbon->format('Y-m-d\TH:i:s');
    }

    /**
     * Retrieves the String representation of the Datatype.
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->toDateTimeString();
    }
}
