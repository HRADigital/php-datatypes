<?php

/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at https://mozilla.org/MPL/2.0/.
 *
 * Copyright (c) HRADigital - Hugo Rafael Azevedo.
 */

declare(strict_types=1);

namespace HraDigital\Datatypes\Attributes\General;

use HraDigital\Datatypes\Exceptions\Datatypes\NonEmptyStringException;
use HraDigital\Datatypes\Scalar\Str;

/**
 * Gives Surname information capabilities to an Entity/Value Object.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 */
trait HasSurnameTrait
{
    /** @var Str $surname - Instance's Surname. */
    protected Str $surname;

    /**
     * Setter method for Surname.
     *
     * @throws NonEmptyStringException - Supplied Surname must be a non empty string.
     */
    protected function castSurname(string $surname): void
    {
        // Validates supplied parameter.
        $surnameValue = Str::create($surname)->trim();

        if ($surnameValue->getLength() === 0) {
            throw NonEmptyStringException::withName('$surname');
        }

        $this->surname = $surnameValue;
    }

    /**
     * Returns the Instance's Surname.
     */
    public function getSurname(): Str
    {
        return $this->surname;
    }
}
