<?php

/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at https://mozilla.org/MPL/2.0/.
 *
 * Copyright (c) HRADigital - Hugo Rafael Azevedo.
 */

declare(strict_types=1);

namespace HraDigital\Datatypes\Attributes\Professional;

use HraDigital\Datatypes\Exceptions\Datatypes\NonEmptyStringException;
use HraDigital\Datatypes\Scalar\Str;

/**
 * Gives Professional Occupation information capabilities to an Entity/Value Object.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 */
trait HasIndustryTrait
{
    /** @var Str|null $industry - Profile's Professional Industry */
    protected ?Str $industry = null;

    /**
     * Sets the Profile's Professional Industry value of an Entity.
     *
     * @throws NonEmptyStringException - Supplied Profile's Professional Industry must be a non empty string.
     */
    protected function castIndustry(?string $industry): void
    {
        // Validates supplied parameter.
        $industryValue = $industry ? Str::create($industry)->trim() : null;

        if ($industryValue !== null && $industryValue->getLength() === 0) {
            throw NonEmptyStringException::withName('$occupation');
        }

        $this->industry = $industryValue;
    }

    /**
     * Returns the Instance's Profile's Industry.
     */
    public function getIndustry(): ?Str
    {
        return $this->industry;
    }
}
