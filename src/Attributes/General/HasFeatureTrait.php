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

/**
 * Gives Featured information capabilities to an Entity/Value Object.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 */
trait HasFeatureTrait
{
    /** @var bool $is_featured - If the record is marked as Featured in the system. */
    protected bool $is_featured = false;

    /**
     * Sets the FEATURED value of an Entity.
     */
    protected function castIsFeatured(bool $featured): void
    {
        $this->is_featured = $featured;
    }

    /**
     * Returns TRUE if the record is marked as FEATURED in the system.
     */
    public function isFeatured(): bool
    {
        return $this->is_featured;
    }
}
