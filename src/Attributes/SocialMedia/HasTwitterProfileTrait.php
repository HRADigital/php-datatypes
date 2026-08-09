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
 * Adds Twitters's Social Media account URL field.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 */
trait HasTwitterProfileTrait
{
    /** @var Str|null $twitter - Social Media account's URL. */
    protected ?Str $twitter = null;

    /**
     * Sets the Social Media account URL value of an Entity.
     */
    protected function castTwitter(?string $twitter): void
    {
        $this->twitter = $twitter ? Str::create($twitter)->trim() : null;
    }

    /**
     * Retrieves record's Social Media account's URL.
     */
    public function getTwitterUrl(): ?Str
    {
        return $this->twitter;
    }

    /**
     * Is Twitter's Social Media account URL is set.
     */
    public function hasTwitterProfileUrl(): bool
    {
        return ($this->twitter !== null);
    }
}
