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
 * Gives Alias information capabilities to an Entity/Value Object.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 */
trait HasAliasTrait
{
    /** @var Str $alias - Instances's Alias. */
    protected Str $alias;

    /**
     * Setter method for alias.
     *
     * @throws NonEmptyStringException - Supplied Alias must be a non empty string.
     */
    protected function castAlias(string $alias): void
    {
        // Sanitizes supplied parameter.
        $aliasValue = Str::create($alias)->trim()->toLower()->replace(' ', '_');

        // Validates if alias is filled.
        if ($aliasValue->getLength() === 0) {
            throw NonEmptyStringException::withName('$alias');
        }

        // We'll set the alias value on the attribute, but use the sanitizeAlias() method
        // to sanitize its value.
        $this->alias = $aliasValue;
    }

    /**
     * Returns the Entity's alias.
     */
    public function getAlias(): Str
    {
        return $this->alias;
    }
}
