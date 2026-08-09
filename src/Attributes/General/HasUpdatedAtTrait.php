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
 * Trait for a Record UpdatedAt attribute.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 */
trait HasUpdatedAtTrait
{
    /** @var Datetime|null $updated_at - Timestamp representing the instant the record was last updated. */
    protected ?Datetime $updated_at = null;

    /**
     * Mutator method for setting the value into the Attribute
     */
    protected function castUpdatedAt(?string $timestamp): void
    {
        $this->updated_at = ($timestamp ? Datetime::fromString($timestamp) : null);
    }

    /**
     * Returns a Datetime representation from the instant the record was last updated.
     */
    public function getUpdatedAt(): ?Datetime
    {
        return $this->updated_at;
    }
}
