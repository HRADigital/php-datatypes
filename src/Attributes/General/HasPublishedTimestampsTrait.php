<?php

/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at https://mozilla.org/MPL/2.0/.
 *
 * Copyright (c) HRADigital - Hugo Rafael Azevedo.
 */

declare(strict_types=1);

namespace HraDigital\Datatypes\Attributes\General;

use HraDigital\Datatypes\Datetime\Datetime;

/**
 * Gives Publishing with timestamps capabilities to an Entity.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 */
trait HasPublishedTimestampsTrait
{
    /** @var Datetime|null $published_from - Instant from which the record becomes published. */
    protected ?Datetime $published_from = null;

    /** @var Datetime|null $published_to - Instant from which the record stops being published. */
    protected ?Datetime $published_to = null;

    /**
     * Mutator method for setting the value into the Attribute
     */
    protected function castPublishedFrom(?string $timestamp): void
    {
        $this->published_from = ($timestamp ? Datetime::fromString($timestamp) : null);
    }

    /**
     * Mutator method for setting the value into the Attribute
     */
    protected function castPublishedTo(?string $timestamp): void
    {
        $this->published_to = ($timestamp ? Datetime::fromString($timestamp) : null);
    }

    /**
     * Returns a Datetime representation from the instant the record becomes published.
     */
    public function getPublishedFrom(): ?Datetime
    {
        return $this->published_from;
    }

    /**
     * Returns a Datetime representation from the instant the record stops being published.
     */
    public function getPublishedTo(): ?Datetime
    {
        return $this->published_to;
    }

    /**
     * Returns TRUE if the record is within its publishing window.
     *
     * An unset boundary means the window is open on that end.
     */
    public function isWithinPublishingPeriod(): bool
    {
        $now = Datetime::now();

        if ($this->published_from !== null && $now < $this->published_from) {
            return false;
        }

        return !($this->published_to !== null && $now > $this->published_to);
    }
}
