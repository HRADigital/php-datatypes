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
 * Adds Linkedin's Social Media account URL field.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 */
trait HasLinkedinProfileTrait
{
    /** @var Str|null $linkedin - Social Media account's URL. */
    protected ?Str $linkedin = null;

    /**
     * Sets the Social Media account URL value of an Entity.
     */
    protected function castLinkedin(?string $linkedin): void
    {
        $this->linkedin = $linkedin ? Str::create($linkedin)->trim() : null;
    }

    /**
     * Retrieves record's Social Media account's URL.
     */
    public function getLinkedinUrl(): ?Str
    {
        return $this->linkedin;
    }

    /**
     * Is Linkedin's Social Media account URL is set.
     */
    public function hasLinkedinProfileUrl(): bool
    {
        return ($this->linkedin !== null);
    }
}
