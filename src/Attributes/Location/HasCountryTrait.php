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

use HraDigital\Datatypes\Scalar\Str;

/**
 * Trait for an Entity's Country attribute.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 */
trait HasCountryTrait
{
    /** @var Str $country - Country */
    protected Str $country;

    /**
     * Mutator method for setting the value into the Attribute.
     */
    protected function castCountry(string $country): void
    {
        $this->country = Str::create($country)->trim();
    }

    /**
     * Returns the Entity's Country.
     */
    public function getCountry(): Str
    {
        return $this->country;
    }
}
