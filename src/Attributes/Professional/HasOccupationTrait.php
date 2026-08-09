<?php

/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at https://mozilla.org/MPL/2.0/.
 *
 * Copyright (c) HRADigital - Hugo Rafael Azevedo.
 */

declare(strict_types=1);

namespace HraDigital\Datatypes\Attributes\Professional;

use HraDigital\Datatypes\Exceptions\Datatypes\NonEmptyStringException;
use HraDigital\Datatypes\Scalar\Str;

/**
 * Gives Professional Occupation information capabilities to an Entity/Value Object.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 */
trait HasOccupationTrait
{
    /** @var Str|null $occupation - Profile's Professional Occupation */
    protected ?Str $occupation = null;

    /**
     * Sets the Profile's Professional Occupation value of an Entity.
     *
     * @throws NonEmptyStringException - Supplied Profile's Professional Occupation must be a non empty string.
     */
    protected function castOccupation(?string $occupation): void
    {
        // Validates supplied parameter.
        $occupationValue = $occupation ? Str::create($occupation)->trim() : null;

        if ($occupationValue !== null && $occupationValue->getLength() === 0) {
            throw NonEmptyStringException::withName('$occupation');
        }

        $this->occupation = $occupationValue;
    }

    /**
     * Returns the Instance's Profile's Occupation.
     */
    public function getOccupation(): ?Str
    {
        return $this->occupation;
    }

    /**
     * If record has Profile's Occupation.
     */
    public function hasOccupation(): bool
    {
        return ($this->occupation !== null);
    }
}
