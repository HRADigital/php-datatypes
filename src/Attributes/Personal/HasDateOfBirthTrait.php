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

use HraDigital\Datatypes\Datetime\DateTimeImmutable;

/**
 * Trait for an Entity's DateOfBirth attribute.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 */
trait HasDateOfBirthTrait
{
    /** @var DateTimeImmutable|null $dob - Timestamp representing a Date of Birth. */
    protected ?DateTimeImmutable $dob = null;

    /**
     * Mutator method for setting the value into the Attribute
     */
    protected function castDob(string $dob): void
    {
        $this->dob = DateTimeImmutable::fromString($dob);
    }

    /**
     * Returns a Datetime representation for the Entity's Date of Birth.
     */
    public function getDateOfBirth(): ?DateTimeImmutable
    {
        return $this->dob;
    }
}
