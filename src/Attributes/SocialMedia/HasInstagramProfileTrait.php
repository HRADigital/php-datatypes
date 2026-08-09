<?php

/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at https://mozilla.org/MPL/2.0/.
 *
 * Copyright (c) HRADigital - Hugo Rafael Azevedo.
 */

declare(strict_types=1);

namespace HraDigital\Datatypes\Attributes\SocialMedia;

use HraDigital\Datatypes\Scalar\Str;

/**
 * Adds Instagram's Social Media account URL field.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 */
trait HasInstagramProfileTrait
{
    /** @var Str|null $instagram - Social Media account's URL. */
    protected ?Str $instagram = null;

    /**
     * Sets the Social Media account URL value of an Entity.
     */
    protected function castInstagram(?string $instagram): void
    {
        $this->instagram = $instagram ? Str::create($instagram)->trim() : null;
    }

    /**
     * Retrieves record's Social Media account's URL.
     */
    public function getInstagramUrl(): ?Str
    {
        return $this->instagram;
    }

    /**
     * Is Instagram's Social Media account URL is set.
     */
    public function hasInstagramProfileUrl(): bool
    {
        return ($this->instagram !== null);
    }
}
