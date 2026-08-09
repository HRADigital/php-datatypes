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
 * Gives Hits information to an Entity/Value Object.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 */
trait HasHitsTrait
{
    /** @var int $hits - Number of HITS in the system. */
    protected int $hits = 0;

    /**
     * Sets the HITS value of an Entity.
     *
     * @throws NonNegativeNumberException - If supplied Hit's counter is negative.
     */
    protected function castHits(int $hits): void
    {
        // Validates supplied $hits value.
        if ($hits < 0) {
            throw NonNegativeNumberException::withName('$hits');
        }

        // Sets value in class' attribute.
        $this->hits = $hits;
    }

    /**
     * Returns the number of Hits.
     */
    public function getHits(): int
    {
        return $this->hits;
    }
}
