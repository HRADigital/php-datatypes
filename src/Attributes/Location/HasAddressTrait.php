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
 * Trait for an Entity's Address attribute.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 */
trait HasAddressTrait
{
    /** @var Str $address - Address */
    protected Str $address;

    /**
     * Mutator method for setting the value into the Attribute.
     */
    protected function castAddress(string $address): void
    {
        $this->address = Str::create($address)->trim();
    }

    /**
     * Returns the Entity's Address.
     */
    public function getAddress(): Str
    {
        return $this->address;
    }
}
