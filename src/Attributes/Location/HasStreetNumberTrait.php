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
 * Trait for an Entity's Street Number attribute.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 */
trait HasStreetNumberTrait
{
    /** @var Str $street_adicional - Street Number */
    protected Str $street_no;

    /**
     * Mutator method for setting the value into the Attribute.
     */
    protected function castStreetNo(string $number): void
    {
        $this->street_no = Str::create($number)->trim();
    }

    /**
     * Returns the Entity's Street Number.
     */
    public function getStreetNumber(): Str
    {
        return $this->street_no;
    }
}
