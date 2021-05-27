<?php declare(strict_types=1);

namespace Hradigital\Datatypes\Traits\Datatypes\Datetime;

use Carbon\Carbon;

/**
 * Datetime adding and subtracting dedicated methods for Datetime datatype.
 *
 * @package   Hradigital\Datatypes
 * @copyright Hradigital\Datatypes
 * @license   Proprietary
 * @link      http://carbon.nesbot.com/docs/
 */
trait CanAddAndSubtractPartsTrait
{
    /** @var Carbon $carbon - Carbon's instance. */
    protected Carbon $carbon;

    /**
     * Add a single Year to the instance.
     *
     * Supports chaining.
     *
     * @return self
     */
    public function addYear(): self
    {
        $this->addYears(1);

        return $this;
    }

    /**
     * Add the supplied number of Years to the instance.
     *
     * Supports chaining.
     *
     * @param int $years - Number of years to add to instance. Supports negative numbers for subtraction.
     *
     * @return self
     */
    public function addYears(int $years): self
    {
        $this->carbon->addYears($years);

        return $this;
    }

    /**
     * Returns the different between the current instance an the provided one, in Years.
     *
     * @param  self  $dt       - instance to compare with.
     * @param  bool  $absolute - Gets the absolute of the difference.
     *
     * @return int
     */
    public function differenceInYears(self $dt, bool $absolute = true): int
    {
        return $this->carbon->diffInYears(
            Carbon::createFromTimestamp($dt->getTimestamp(), $dt->getTimezone()),
            $absolute
        );
    }

    /**
     * Add a single Month to the instance.
     *
     * Supports chaining.
     *
     * @return self
     */
    public function addMonth(): self
    {
        $this->addMonths(1);

        return $this;
    }

    /**
     * Add the supplied number of Months to the instance.
     *
     * Supports chaining.
     *
     * @param int $months - Number of Months to add to instance. Supports negative numbers for subtraction.
     *
     * @return self
     */
    public function addMonths(int $months): self
    {
        $this->carbon->addMonths($months);

        return $this;
    }

    /**
     * Returns the different between the current instance an the provided one, in Months.
     *
     * @param  self  $dt       - instance to compare with.
     * @param  bool  $absolute - Gets the absolute of the difference.
     *
     * @return int
     */
    public function differenceInMonths(self $dt, bool $absolute = true): int
    {
        return $this->carbon->diffInMonths(
            Carbon::createFromTimestamp($dt->getTimestamp(), $dt->getTimezone()),
            $absolute
        );
    }

    /**
     * Returns the different between the current instance an the provided one, in Weeks.
     *
     * @param  self $dt       - instance to compare with.
     * @param  bool $absolute - Gets the absolute of the difference.
     *
     * @return int
     */
    public function differenceInWeeks(self $dt, bool $absolute = true): int
    {
        return $this->carbon->diffInWeeks(
            Carbon::createFromTimestamp($dt->getTimestamp(), $dt->getTimezone()),
            $absolute
        );
    }

    /**
     * Add a single Day to the instance.
     *
     * Supports chaining.
     *
     * @return self
     */
    public function addDay(): self
    {
        $this->addDays(1);

        return $this;
    }

    /**
     * Add the supplied number of Days to the instance.
     *
     * Supports chaining.
     *
     * @param int $days - Number of Days to add to instance. Supports negative numbers for subtraction.
     *
     * @return self
     */
    public function addDays(int $days): self
    {
        $this->carbon->addDays($days);

        return $this;
    }

    /**
     * Returns the different between the current instance an the provided one, in Days.
     *
     * @param  self  $dt       - instance to compare with.
     * @param  bool  $absolute - Gets the absolute of the difference.
     *
     * @return int
     */
    public function differenceInDays(self $dt, bool $absolute = true): int
    {
        return $this->carbon->diffInDays(
            Carbon::createFromTimestamp($dt->getTimestamp(), $dt->getTimezone()),
            $absolute
        );
    }

    /**
     * Add a single Hour to the instance.
     *
     * Supports chaining.
     *
     * @return self
     */
    public function addHour(): self
    {
        $this->addHours(1);

        return $this;
    }

    /**
     * Add the supplied number of Hours to the instance.
     *
     * Supports chaining.
     *
     * @param int $hours - Number of Hours to add to instance. Supports negative numbers for subtraction.
     *
     * @return self
     */
    public function addHours(int $hours): self
    {
        $this->carbon->addHours($hours);

        return $this;
    }

    /**
     * Returns the different between the current instance an the provided one, in Hours.
     *
     * @param  self  $dt       - instance to compare with.
     * @param  bool  $absolute - Gets the absolute of the difference.
     *
     * @return int
     */
    public function differenceInHours(self $dt, bool $absolute = true): int
    {
        return $this->carbon->diffInHours(
            Carbon::createFromTimestamp($dt->getTimestamp(), $dt->getTimezone()),
            $absolute
        );
    }

    /**
     * Add a single Minute to the instance.
     *
     * Supports chaining.
     *
     * @return self
     */
    public function addMinute(): self
    {
        $this->addMinutes(1);

        return $this;
    }

    /**
     * Add the supplied number of Minutes to the instance.
     *
     * Supports chaining.
     *
     * @param int $minutes - Number of Minutes to add to instance. Supports negative numbers for subtraction.
     *
     * @return self
     */
    public function addMinutes(int $minutes): self
    {
        $this->carbon->addMinutes($minutes);

        return $this;
    }

    /**
     * Returns the different between the current instance an the provided one, in Minutes.
     *
     * @param  self  $dt       - instance to compare with.
     * @param  bool  $absolute - Gets the absolute of the difference.
     *
     * @return int
     */
    public function differenceInMinutes(self $dt, bool $absolute = true): int
    {
        return $this->carbon->diffInMinutes(
            Carbon::createFromTimestamp($dt->getTimestamp(), $dt->getTimezone()),
            $absolute
        );
    }

    /**
     * Add a single Second to the instance.
     *
     * Supports chaining.
     *
     * @return self
     */
    public function addSecond(): self
    {
        $this->addSeconds(1);

        return $this;
    }

    /**
     * Add the supplied number of Seconds to the instance.
     *
     * Supports chaining.
     *
     * @param int $seconds - Number of Seconds to add to instance. Supports negative numbers for subtraction.
     *
     * @return self
     */
    public function addSeconds(int $seconds): self
    {
        $this->carbon->addSeconds($seconds);

        return $this;
    }

    /**
     * Returns the different between the current instance an the provided one, in Seconds.
     *
     * @param  self  $dt       - instance to compare with.
     * @param  bool  $absolute - Gets the absolute of the difference.
     *
     * @return int
     */
    public function differenceInSeconds(self $dt, bool $absolute = true): int
    {
        return $this->carbon->diffInSeconds(
            Carbon::createFromTimestamp($dt->getTimestamp(), $dt->getTimezone()),
            $absolute
        );
    }
}
