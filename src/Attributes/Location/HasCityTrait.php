<?php

/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at https://mozilla.org/MPL/2.0/.
 *
 * Copyright (c) HRADigital - Hugo Rafael Azevedo.
 */

declare(strict_types=1);

namespace HraDigital\Datatypes\Attributes\Location;

use HraDigital\Datatypes\Exceptions\Datatypes\NonEmptyStringException;
use HraDigital\Datatypes\Scalar\Str;

/**
 * Trait for an Entity's City attribute.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 */
trait HasCityTrait
{
    /** @var Str|null $city - City */
    protected ?Str $city;

    /**
     * Mutator method for setting the value into the Attribute.
     *
     * @throws NonEmptyStringException - If supplied value is not a non empty string.
     */
    protected function castCity(?string $city): void
    {
        $cityValue = $city ? Str::create($city)->trim() : null;

        if ($cityValue !== null && $cityValue->getLength() === 0) {
            throw NonEmptyStringException::withName('$city');
        }

        $this->city = $cityValue;
    }

    /**
     * Returns the Entity's City.
     */
    public function getCity(): ?Str
    {
        return $this->city;
    }
}
