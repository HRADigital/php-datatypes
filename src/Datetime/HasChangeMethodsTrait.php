<?php

/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at https://mozilla.org/MPL/2.0/.
 *
 * Copyright (c) HRADigital - Hugo Rafael Azevedo.
 */

declare(strict_types=1);

namespace HraDigital\Datatypes\Datetime;

use DateTimeImmutable as NativeDateTimeImmutable;

/**
 * Changing methods shared by DateTime and DateTimeImmutable.
 *
 * Each method only calculates the new native value, and hands it to `withValue()`. The using class
 * decides what a change means: DateTimeImmutable returns a new instance, DateTime replaces its own
 * value and returns `$this`.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 */
trait HasChangeMethodsTrait
{
    abstract private function withValue(NativeDateTimeImmutable $value): static;

    public function add(DateInterval $interval): static
    {
        return $this->withValue($this->value->add($interval));
    }

    public function sub(DateInterval $interval): static
    {
        return $this->withValue($this->value->sub($interval));
    }

    /**
     * Converts the instant to the supplied timezone. The instant does not change.
     */
    public function withTimezone(DateTimeZone $timezone): static
    {
        return $this->withValue($this->value->setTimezone($timezone));
    }

    /**
     * Add the supplied number of Seconds. A negative value subtracts.
     */
    public function addSeconds(int $seconds): static
    {
        return $this->add(DateInterval::fromSeconds($seconds));
    }

    /**
     * Add the supplied number of Minutes. A negative value subtracts.
     */
    public function addMinutes(int $minutes): static
    {
        return $this->add(DateInterval::fromMinutes($minutes));
    }

    /**
     * Add the supplied number of Hours. A negative value subtracts.
     */
    public function addHours(int $hours): static
    {
        return $this->add(DateInterval::fromHours($hours));
    }

    /**
     * Add the supplied number of Days. A negative value subtracts.
     */
    public function addDays(int $days): static
    {
        return $this->add(DateInterval::fromDays($days));
    }

    /**
     * Add the supplied number of Months. A negative value subtracts.
     */
    public function addMonths(int $months): static
    {
        return $this->add(DateInterval::fromMonths($months));
    }

    /**
     * Add the supplied number of Years. A negative value subtracts.
     */
    public function addYears(int $years): static
    {
        return $this->add(DateInterval::fromYears($years));
    }

    /**
     * Subtract the supplied number of Seconds. A negative value adds.
     */
    public function subSeconds(int $seconds): static
    {
        return $this->sub(DateInterval::fromSeconds($seconds));
    }

    /**
     * Subtract the supplied number of Minutes. A negative value adds.
     */
    public function subMinutes(int $minutes): static
    {
        return $this->sub(DateInterval::fromMinutes($minutes));
    }

    /**
     * Subtract the supplied number of Hours. A negative value adds.
     */
    public function subHours(int $hours): static
    {
        return $this->sub(DateInterval::fromHours($hours));
    }

    /**
     * Subtract the supplied number of Days. A negative value adds.
     */
    public function subDays(int $days): static
    {
        return $this->sub(DateInterval::fromDays($days));
    }

    /**
     * Subtract the supplied number of Months. A negative value adds.
     */
    public function subMonths(int $months): static
    {
        return $this->sub(DateInterval::fromMonths($months));
    }

    /**
     * Subtract the supplied number of Years. A negative value adds.
     */
    public function subYears(int $years): static
    {
        return $this->sub(DateInterval::fromYears($years));
    }

    /**
     * Sets the time to 00:00:00.000000.
     */
    public function startOfDay(): static
    {
        return $this->withValue($this->value->setTime(0, 0));
    }

    /**
     * Sets the time to 23:59:59.999999.
     */
    public function endOfDay(): static
    {
        return $this->withValue($this->value->setTime(23, 59, 59, 999999));
    }

    /**
     * Sets the first day of the month, at 00:00:00.000000.
     */
    public function startOfMonth(): static
    {
        return $this->withValue(
            $this->value->setDate($this->getYear(), $this->getMonth(), 1)->setTime(0, 0)
        );
    }

    /**
     * Sets the last day of the month, at 23:59:59.999999.
     */
    public function endOfMonth(): static
    {
        return $this->withValue(
            $this->value
                ->setDate($this->getYear(), $this->getMonth(), (int) $this->value->format('t'))
                ->setTime(23, 59, 59, 999999)
        );
    }

    /**
     * Sets January 1st, at 00:00:00.000000.
     */
    public function startOfYear(): static
    {
        return $this->withValue(
            $this->value->setDate($this->getYear(), 1, 1)->setTime(0, 0)
        );
    }

    /**
     * Sets December 31st, at 23:59:59.999999.
     */
    public function endOfYear(): static
    {
        return $this->withValue(
            $this->value->setDate($this->getYear(), 12, 31)->setTime(23, 59, 59, 999999)
        );
    }
}
