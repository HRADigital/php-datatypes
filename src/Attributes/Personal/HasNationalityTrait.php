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
 * Trait for an Entity's Nationality attribute.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 */
trait HasNationalityTrait
{
    /** @var Str $nationality - Nationality */
    protected ?Str $nationality = null;

    /**
     * Mutator method for setting the value into the Attribute.
     *
     * @param  string $nationality - Nationality.
     */
    protected function castNationality(?string $nationality): void
    {
        $nationalityValue = $nationality ? Str::create($nationality)->trim() : null;

        if ($nationalityValue !== null && $nationalityValue->getLength() === 0) {
            throw NonEmptyStringException::withName('$nationality');
        }

        $this->nationality = $nationalityValue;
    }

    /**
     * Returns the Entity's Nationality.
     */
    public function getNationality(): ?Str
    {
        return $this->nationality;
    }
}
