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
 * Trait for an Entity's Street Aditional attribute.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 */
trait HasStreetAdditionalTrait
{
    /** @var Str $street_additional - Street Additional */
    protected Str $street_additional;

    /**
     * Mutator method for setting the value into the Attribute.
     */
    protected function castStreetAdditional(string $street): void
    {
        $this->street_additional = Str::create($street)->trim();
    }

    /**
     * Returns the Entity's Street Additional.
     */
    public function getStreetAdditional(): Str
    {
        return $this->street_additional;
    }
}
