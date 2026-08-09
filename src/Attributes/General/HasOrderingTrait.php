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

use HraDigital\Datatypes\Exceptions\Datatypes\NonNegativeNumberException;

/**
 * Gives record Ordering capabilities to an Entity/Value Object.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 */
trait HasOrderingTrait
{
    /** @var int $ordering - The ordering of this record, in a parent container. */
    protected int $ordering = 0;

    /**
     * Setter method for the record's order.
     *
     * @throws NonNegativeNumberException - Supplied Order must be a non negative integer.
     */
    protected function castOrdering(int $order): void
    {
        // Validates supplied parameter.
        if ($order < 0) {
            throw NonNegativeNumberException::withName('$ordering');
        }

        // Sets the value in the class.
        $this->ordering = $order;
    }

    /**
     * The ordering of this record, in a parent container's context.
     */
    public function getOrdering(): int
    {
        return $this->ordering;
    }
}
