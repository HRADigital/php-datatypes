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
 * Trait for an Entity's Parish attribute.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 */
trait HasParishTrait
{
    /** @var Str|null $parish - Parish */
    protected ?Str $parish;

    /**
     * Mutator method for setting the value into the Attribute.
     *
     * @throws NonEmptyStringException - If supplied value is not a non empty string.
     */
    protected function castParish(?string $parish): void
    {
        $parishValue = $parish ? Str::create($parish)->trim() : null;

        if ($parishValue !== null && $parishValue->getLength() === 0) {
            throw NonEmptyStringException::withName('$parish');
        }

        $this->parish = $parishValue;
    }

    /**
     * Returns the Entity's Parish.
     */
    public function getParish(): ?Str
    {
        return $this->parish;
    }
}
