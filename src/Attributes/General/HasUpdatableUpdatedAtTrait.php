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
 * Trait for an Updatable Record UpdatedAt attribute.
 *
 * Provides an onUpdate handler, on top of existing HasUpdatedAtTrait.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 */
trait HasUpdatableUpdatedAtTrait
{
    use HasUpdatedAtTrait;

    /**
     * Event handler to be called when the record has been updated successfully.
     */
    protected function onUpdateRecalculateUpdatedAt(): void
    {
        $this->updated_at = Datetime::now();
    }
}
