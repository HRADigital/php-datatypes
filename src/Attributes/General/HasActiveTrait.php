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
 * Gives Activation information capabilities to an Entity/Value Object.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 */
trait HasActiveTrait
{
    /** @var bool $active - If the record is marked as ACTIVE in the system. */
    protected bool $active = false;

    /**
     * Sets the active value of an Entity.
     */
    protected function castActive(bool $active): void
    {
        $this->active = $active;
    }

    /**
     * Returns TRUE if the record is marked as ACTIVE in the system.
     */
    public function isActive(): bool
    {
        return $this->active;
    }
}
