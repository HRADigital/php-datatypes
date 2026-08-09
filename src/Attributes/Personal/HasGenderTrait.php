<?php

/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at https://mozilla.org/MPL/2.0/.
 *
 * Copyright (c) HRADigital - Hugo Rafael Azevedo.
 */

declare(strict_types=1);

namespace HraDigital\Datatypes\Attributes\Personal;

use HraDigital\Datatypes\Exceptions\Entities\UnexpectedEntityValueException;
use HraDigital\Datatypes\Scalar\Str;

/**
 * Trait for an Entity's Gender attribute.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 */
trait HasGenderTrait
{
    /** @var Str $gender - Gender */
    protected Str $gender;

    /**
     * Mutator method for setting the value into the Attribute.
     */
    protected function castGender(string $gender): void
    {
        // Sanitizes and checks supplied value.
        $genderValue = Str::create($gender)->toLower()->toUpperFirst();

        if (!(
            $genderValue->equals('Male') ||
            $genderValue->equals('Female') ||
            $genderValue->equals('Other')
        )) {
            throw UnexpectedEntityValueException::withName('$gender');
        }

        $this->gender = $genderValue;
    }

    /**
     * Returns the Entity's Gender.
     */
    public function getGender(): Str
    {
        return $this->gender;
    }
}
