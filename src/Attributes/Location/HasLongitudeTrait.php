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

/**
 * Trait for an Entity's Longitude attribute.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 */
trait HasLongitudeTrait
{
    /** @var float $longitude - Longitude */
    protected float $longitude = 0.0;

    /**
     * Mutator method for setting the value into the Attribute.
     */
    protected function castLongitude(float $longitude): void
    {
        $this->longitude = $longitude;
    }

    /**
     * Returns the Entity's Longitude.
     */
    public function getLongitude(): float
    {
        return $this->longitude;
    }
}
