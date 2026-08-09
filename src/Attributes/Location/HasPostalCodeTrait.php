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
 * Trait for an Entity's Postal Code attribute.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 */
trait HasPostalCodeTrait
{
    /** @var Str $postal_code - Postal Code */
    protected Str $postal_code;

    /**
     * Mutator method for setting the value into the Attribute.
     */
    protected function castPostalCode(string $postalCode): void
    {
        $this->postal_code = Str::create($postalCode)->trim();
    }

    /**
     * Returns the Entity's Postal Code.
     */
    public function getPostalCode(): Str
    {
        return $this->postal_code;
    }
}
