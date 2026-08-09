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
 * Gives Publishing capabilities to an Entity/Value Object.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 */
trait HasPublishedTrait
{
    /** @var bool $published - If the record is marked as Published for the frontend. */
    protected bool $is_published = false;

    /**
     * Sets the published value of an Entity/Value Object.
     */
    protected function castIsPublished(bool $published): void
    {
        $this->is_published = $published;
    }

    /**
     * Returns TRUE if the record is marked as PUBLISHED for the frontend.
     */
    public function isPublished(): bool
    {
        return $this->is_published;
    }
}
