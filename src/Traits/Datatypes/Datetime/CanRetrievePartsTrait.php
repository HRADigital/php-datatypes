<?php declare(strict_types=1);

namespace Hradigital\Datatypes\Traits\Datatypes\Datetime;

use Carbon\Carbon;

/**
 * Datetime part retrieval dedicated methods use in the datetime datatypes.
 *
 * This Trait is only meant to be used by the Datetime datatype. It assumes
 * a Carbon instance is already loaded into the main class.
 *
 * @package   Hradigital\Datatypes
 * @copyright Hradigital\Datatypes
 * @license   Proprietary
 * @link      http://carbon.nesbot.com/docs/
 */
trait CanRetrievePartsTrait
{
    /** @var Carbon $carbon - Carbon's instance. */
    protected Carbon $carbon;

    /**
     * Returns the Year part of the Datetime instance.
     *
     * @return int
     */
    public function partYear(): int
    {
        return $this->carbon->year;
    }

    /**
     * Returns the Month part of the Datetime instance.
     *
     * @return int
     */
    public function partMonth(): int
    {
        return $this->carbon->month;
    }

    /**
     * Returns the Day part of the Datetime instance.
     *
     * @return int
     */
    public function partDay(): int
    {
        return $this->carbon->day;
    }

    /**
     * Returns the Hour part of the Datetime instance.
     *
     * @return int
     */
    public function partHour(): int
    {
        return $this->carbon->hour;
    }

    /**
     * Returns the Minute part of the Datetime instance.
     *
     * @return int
     */
    public function partMinute(): int
    {
        return $this->carbon->minute;
    }

    /**
     * Returns the Second part of the Datetime instance.
     *
     * @return int
     */
    public function partSecond(): int
    {
        return $this->carbon->second;
    }

    /**
     * Returns the Week number in the given Month.
     *
     * 1 through 5.
     *
     * @return int
     */
    public function weekOfMonth(): int
    {
        return $this->carbon->weekOfMonth;
    }

    /**
     * Returns the Week number in the given Year.
     *
     * ISO-8601 week number of year, weeks starting on Monday.
     *
     * @return int
     */
    public function weekOfYear(): int
    {
        return $this->carbon->weekOfYear;
    }

    /**
     * Returns the Day of the Week for the Datetime instance.
     *
     * 0 (for Sunday) through 6 (for Saturday)
     *
     * @return int
     */
    public function dayOfWeek(): int
    {
        return $this->carbon->dayOfWeek;
    }

    /**
     * Returns the Day of the Year.
     *
     * 0 through 365.
     *
     * @return int
     */
    public function dayOfYear(): int
    {
        return $this->carbon->dayOfYear;
    }

    /**
     * Returns the total number of Days for the Month set in the Datetime instance.
     *
     * @return int
     */
    public function daysInMonth(): int
    {
        return $this->carbon->daysInMonth;
    }
}
