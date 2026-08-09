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
 * Trait for an Entity's District attribute.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 */
trait HasDistrictTrait
{
    /** @var Str|null $district - District */
    protected ?Str $district;

    /**
     * Mutator method for setting the value into the Attribute.
     *
     * @throws NonEmptyStringException - If supplied value is not a non empty string.
     */
    protected function castDistrict(?string $district): void
    {
        $districtValue = $district ? Str::create($district)->trim() : null;

        if ($districtValue !== null && $districtValue->getLength() === 0) {
            throw NonEmptyStringException::withName('$district');
        }

        $this->district = $districtValue;
    }

    /**
     * Returns the Entity's District.
     */
    public function getDistrict(): ?Str
    {
        return $this->district;
    }
}
