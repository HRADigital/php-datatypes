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

use HraDigital\Datatypes\Exceptions\Datatypes\PositiveIntegerException;

/**
 * Trait for a Record's positive integer ID attribute.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 */
trait HasPositiveIntegerIDTrait
{
    /** @var int|null $id - Positive Integer ID */
    protected ?int $id = null;

    /**
     * Mutator method for setting the value into the Attribute.
     */
    protected function castId(int $id): void
    {
        if ($id < 1) {
            throw new PositiveIntegerException('$id');
        }

        $this->id = $id;
    }

    /**
     * Returns the Positive Integer ID
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * If record is a new record. Not returned from DB.
     *
     * Validates if the VO/Entity has an ID set.
     */
    public function isNew(): bool
    {
        return ($this->id === null);
    }
}
