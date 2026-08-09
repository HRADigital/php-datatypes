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
 * Gives Name information capabilities to an Entity/Value Object.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 */
trait HasNameTrait
{
    /** @var Str $name - Instance's Name. */
    protected Str $name;

    /**
     * Setter method for name.
     *
     * @throws NonEmptyStringException - Supplied Name must be a non empty string.
     */
    protected function castName(string $name): void
    {
        // Validates supplied parameter.
        $nameValue = Str::create($name)->trim();
        if ($nameValue->getLength() === 0) {
            throw NonEmptyStringException::withName('$name');
        }

        $this->name = $nameValue;
    }

    /**
     * Returns the Instance's name.
     */
    public function getName(): Str
    {
        return $this->name;
    }
}
