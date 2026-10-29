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
 * Trait for an Entity DeletedAt attribute.
 *
 * Only use this Trait in in Entities/Value Objects that have Soft Delete capabilities.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 */
trait HasDeletedAtTrait
{
    /** @var DateTimeImmutable|null $deleted_at - Timestamp representing the instant the record was marked as deleted. */
    protected ?DateTimeImmutable $deleted_at = null;

    /**
     * Mutator method for setting the value into the Attribute
     */
    protected function castDeletedAt(?string $timestamp): void
    {
        $this->deleted_at = ($timestamp ? DateTimeImmutable::fromString($timestamp) : null);
    }

    /**
     * Returns a Datetime representation from the instant the record was marked as deleted.
     */
    public function getDeletedAt(): ?DateTimeImmutable
    {
        return $this->deleted_at;
    }

    /**
     * Returns TRUE if the record is marked as deleted in the system.
     */
    public function isDeleted(): bool
    {
        return ($this->deleted_at !== null);
    }
}
