<?php

/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at https://mozilla.org/MPL/2.0/.
 *
 * Copyright (c) HRADigital - Hugo Rafael Azevedo.
 */

declare(strict_types=1);

namespace HraDigital\Datatypes\Attributes\Timezone;

/**
 * Trait for an Entity's Timestamp attribute.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 */
trait HasTimestampTrait
{
    /** @var int $timestamp - Instance's Unix timestamp. */
    protected int $timestamp = 0;

    /**
     * Setter method for UNIX Timestamp.
     */
    protected function castTimestamp(int $timestamp): void
    {
        $this->timestamp = $timestamp;
    }

    /**
     * Returns the Instance's Unix timestamp.
     */
    public function getTimestamp(): int
    {
        return $this->timestamp;
    }
}
