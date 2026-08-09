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
 * Trait for an Entity's Country Code attribute.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 */
trait HasCountryCodeTrait
{
    /** @var Str $countryCode - Country Code */
    protected Str $country_code;

    /**
     * Mutator method for setting the value into the Attribute.
     */
    protected function castCountryCode(string $countryCode): void
    {
        $this->country_code = Str::create($countryCode);
    }

    /**
     * Returns the Entity's Country Code.
     */
    public function getCountryCode(): Str
    {
        return $this->country_code;
    }
}
