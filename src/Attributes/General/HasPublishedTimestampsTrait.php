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

use HraDigital\Datatypes\Datetime\DateTimeImmutable;

/**
 * Gives Publishing with timestamps capabilities to an Entity.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 */
trait HasPublishedTimestampsTrait
{
    /** @var DateTimeImmutable|null $published_from - Instant from which the record becomes published. */
    protected ?DateTimeImmutable $published_from = null;

    /** @var DateTimeImmutable|null $published_to - Instant from which the record stops being published. */
    protected ?DateTimeImmutable $published_to = null;

    /**
     * Mutator method for setting the value into the Attribute
     */
    protected function castPublishedFrom(?string $timestamp): void
    {
        $this->published_from = ($timestamp ? DateTimeImmutable::fromString($timestamp) : null);
    }

    /**
     * Mutator method for setting the value into the Attribute
     */
    protected function castPublishedTo(?string $timestamp): void
    {
        $this->published_to = ($timestamp ? DateTimeImmutable::fromString($timestamp) : null);
    }

    /**
     * Returns a Datetime representation from the instant the record becomes published.
     */
    public function getPublishedFrom(): ?DateTimeImmutable
    {
        return $this->published_from;
    }

    /**
     * Returns a Datetime representation from the instant the record stops being published.
     */
    public function getPublishedTo(): ?DateTimeImmutable
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
        $now = DateTimeImmutable::now();

        if ($this->published_from !== null && $now->isBefore($this->published_from)) {
            return false;
        }

        return !($this->published_to !== null && $now->isAfter($this->published_to));
    }
}
