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
 * Trait for a Record CreatedAt attribute.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 */
trait HasCreatedAtTrait
{
    /** @var DateTimeImmutable|null $created_at - Timestamp representing the instant the record was created. */
    protected ?DateTimeImmutable $created_at = null;

    /**
     * Mutator method for setting the value into the Attribute
     */
    protected function castCreatedAt(string $timestamp): void
    {
        $this->created_at = DateTimeImmutable::fromString($timestamp);
    }

    /**
     * Returns a Datetime representation from the instant the record was last updated.
     */
    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->created_at;
    }
}
