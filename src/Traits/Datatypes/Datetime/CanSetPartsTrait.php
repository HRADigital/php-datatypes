<?php declare(strict_types=1);

namespace Hradigital\Datatypes\Traits\Datatypes\Datetime;

use Carbon\Carbon;
use Hradigital\Datatypes\Exceptions\Datatypes\PositiveIntegerException;

/**
 * Datetime adding dedicated methods for Datetime datatype.
 *
 * @package   Hradigital\Datatypes
 * @copyright Hradigital\Datatypes
 * @license   Proprietary
 * @link      http://carbon.nesbot.com/docs/
 */
trait CanSetPartsTrait
{
    /** @var Carbon $carbon - Carbon's instance. */
    protected Carbon $carbon;

    /**
     * Sets the Year part of the instance.
     *
     * Supports chaining.
     *
     * @param  int $year - Year to be set on the instance.
     *
     * @throws PositiveIntegerException - If a negative parameter was supplied.
     *
     * @return self
     */
    public function setYear(int $year): self
    {
        // Validates provided parameter.
        if ($year <= 0) {
            throw new PositiveIntegerException();
        }

        // Sets the year on the carbon's instance.
        $this->carbon->year($year);

        return $this;
    }

    /**
     * Sets the Month part of the instance.
     *
     * Supports chaining.
     *
     * @param  int $month - Month to be set on the instance.
     *
     * @throws PositiveIntegerException - If a negative parameter was supplied.
     *
     * @return self
     */
    public function setMonth(int $month): self
    {
        // Validates provided parameter.
        if ($month <= 0) {
            throw new PositiveIntegerException();
        }

        // Sets the month on the carbon's instance.
        $this->carbon->month($month);

        return $this;
    }

    /**
     * Sets the Day part of the instance.
     *
     * Supports chaining.
     *
     * @param  int $day - Day to be set on the instance.
     *
     * @throws PositiveIntegerException - If a negative parameter was supplied.
     *
     * @return self
     */
    public function setDay(int $day): self
    {
        // Validates provided parameter.
        if ($day <= 0) {
            throw new PositiveIntegerException();
        }

        // Sets the day on the carbon's instance.
        $this->carbon->day($day);

        return $this;
    }

    /**
     * Sets the Hour part of the instance.
     *
     * Supports chaining.
     *
     * @param  int $hour - Hour to be set on the instance.
     *
     * @throws PositiveIntegerException - If a negative parameter was supplied.
     *
     * @return self
     */
    public function setHour(int $hour): self
    {
        // Validates provided parameter.
        if ($hour < 0) {
            throw new PositiveIntegerException();
        }

        // Sets the hour on the carbon's instance.
        $this->carbon->hour($hour);

        return $this;
    }

    /**
     * Sets the Minute part of the instance.
     *
     * Supports chaining.
     *
     * @param  int $minute - Minute to be set on the instance.
     *
     * @throws PositiveIntegerException - If a negative parameter was supplied.
     *
     * @return self
     */
    public function setMinute(int $minute): self
    {
        // Validates provided parameter.
        if ($minute < 0) {
            throw new PositiveIntegerException();
        }

        // Sets the minute on the carbon's instance.
        $this->carbon->minute($minute);

        return $this;
    }

    /**
     * Sets the Second part of the instance.
     *
     * Supports chaining.
     *
     * @param  int $second - Second to be set on the instance.
     *
     * @throws PositiveIntegerException - If a negative parameter was supplied.
     *
     * @return self
     */
    public function setSecond(int $second): self
    {
        // Validates provided parameter.
        if ($second < 0) {
            throw new PositiveIntegerException();
        }

        // Sets the second on the carbon's instance.
        $this->carbon->second($second);

        return $this;
    }
}
