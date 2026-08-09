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
 * Trait for an Entity's Street attribute.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 */
trait HasStreetTrait
{
    /** @var Str $street - Street */
    protected Str $street;

    /**
     * Mutator method for setting the value into the Attribute.
     */
    protected function castStreet(string $street): void
    {
        $this->street = Str::create($street)->trim();
    }

    /**
     * Returns the Entity's Street.
     */
    public function getStreet(): Str
    {
        return $this->street;
    }
}
