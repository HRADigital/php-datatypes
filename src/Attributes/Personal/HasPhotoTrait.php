<?php

/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at https://mozilla.org/MPL/2.0/.
 *
 * Copyright (c) HRADigital - Hugo Rafael Azevedo.
 */

declare(strict_types=1);

namespace HraDigital\Datatypes\Attributes\Personal;

use HraDigital\Datatypes\Exceptions\Datatypes\NonEmptyStringException;
use HraDigital\Datatypes\Scalar\Str;

/**
 * Gives Photo information capabilities to an Entity/Value Object.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 */
trait HasPhotoTrait
{
    /** @var Str|null $photo - Profile's Photo file */
    protected ?Str $photo = null;

    /**
     * Sets the Profile's Photo value of an Entity.
     *
     * @throws NonEmptyStringException - Supplied Profile's Photo must be a non empty string.
     */
    protected function castPhoto(?string $photo): void
    {
        // Validates supplied parameter.
        $photoValue = Str::create($photo)->trim();

        if ($photoValue->getLength() === 0) {
            throw NonEmptyStringException::withName('$photo');
        }

        $this->photo = $photoValue;
    }

    /**
     * Returns the Instance's Profile's Photo.
     */
    public function getPhoto(): ?Str
    {
        return $this->photo;
    }

    /**
     * If record has Profile's Photo.
     */
    public function hasPhoto(): bool
    {
        return ($this->photo !== null);
    }
}
