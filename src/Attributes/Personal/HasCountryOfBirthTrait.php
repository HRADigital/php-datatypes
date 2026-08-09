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
 * Trait for an Entity's Country of Birth attribute.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 */
trait HasCountryOfBirthTrait
{
    /** @var Str $country_of_birth - Country of Birth */
    protected Str $country_of_birth;

    /**
     * Mutator method for setting the value into the Attribute.
     */
    protected function castCountryOfBirth(string $country): void
    {
        $countryValue = Str::create($country)->trim();

        if ($countryValue->getLength() === 0) {
            throw NonEmptyStringException::withName('$country_of_birth');
        }

        $this->country_of_birth = $countryValue;
    }

    /**
     * Returns the Entity's Country of Birth.
     */
    public function getCountryOfBirth(): Str
    {
        return $this->country_of_birth;
    }
}
