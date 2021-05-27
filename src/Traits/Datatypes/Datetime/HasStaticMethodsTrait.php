<?php declare(strict_types=1);

namespace Hradigital\Datatypes\Traits\Datatypes\Datetime;

use Hradigital\Datatypes\Datatypes\Datetime;

/**
 * Static querying methods for Datetime's Adapter class.
 *
 * This Trait is only meant to be used by the Datetime datatype. It assumes
 * a Carbon instance is already loaded into the main class.
 *
 * @package   Hradigital\Datatypes
 * @copyright Hradigital\Datatypes
 * @license   Proprietary
 * @link      http://carbon.nesbot.com/docs/
 */
trait HasStaticMethodsTrait
{
    /**
     * Returns a Datetime instance for the supplied string representation of a DateTime.
     *
     * @param  string $datetime - String representation of a DateTime.
     *
     * @return Datetime
     */
    public static function fromString(string $datetime): Datetime
    {
        return new Datetime($datetime);
    }

    /**
     * Returns a Datetime instance for the supplied string representation of a DateTime and
     * a Timezone.
     *
     * @param  string $datetime - String representation of a DateTime.
     * @param  string $timezone - String representation of a Timezone.
     *
     * @return Datetime
     */
    public static function fromStringWithTimezone(string $datetime, string $timezone): Datetime
    {
        return new Datetime($datetime, $timezone);
    }

    /**
     * Returns a Datetime instance for the supplied Timestamp representation.
     *
     * @param  int $timestamp . Timestamp in seconds.
     * @return Datetime
     */
    public static function fromTimestamp(int $timestamp): Datetime
    {
        return new Datetime('@'. $timestamp);
    }

    /**
     * Returns a Datetime instance for the current date and time.
     *
     * @param  string|null $timezone - Optional timezone.
     * @return Datetime
     */
    public static function now(?string $timezone = null): Datetime
    {
        return new Datetime(null, $timezone);
    }

    /**
     * Returns a Datetime instance for today.
     *
     * @param  string|null $timezone - Optional timezone.
     * @return Datetime
     */
    public static function today(?string $timezone = null): Datetime
    {
        return new Datetime('today', $timezone);
    }

    /**
     * Returns a Datetime instance for tomorrow.
     *
     * @param  string|null $timezone - Optional timezone.
     * @return Datetime
     */
    public static function tomorrow(?string $timezone = null): Datetime
    {
        return new Datetime('tomorrow', $timezone);
    }

    /**
     * Returns a Datetime instance for yesterday.
     *
     * @param  string|null $timezone - Optional timezone.
     * @return Datetime
     */
    public static function yesterday(?string $timezone = null): Datetime
    {
        return new Datetime('yesterday', $timezone);
    }

    /**
     * Returns a Datetime instance for the first day of the year.
     *
     * @param  string|null $timezone - Optional timezone.
     * @return Datetime
     */
    public static function firstDayOfYear(?string $timezone = null): Datetime
    {
        return new Datetime('first day of january this year', $timezone);
    }

    /**
     * Returns a Datetime instance for the last day of the year.
     *
     * @param  string|null $timezone - Optional timezone.
     * @return Datetime
     */
    public static function lastDayOfYear(?string $timezone = null): Datetime
    {
        return new Datetime('last day of december this year', $timezone);
    }
}
