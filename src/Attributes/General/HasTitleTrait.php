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
 * Gives Title information capabilities to an Entity/Value Object.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 */
trait HasTitleTrait
{
    /** @var Str $title - Instance's Title. */
    protected Str $title;

    /**
     * Casting method for Title.
     *
     * @throws NonEmptyStringException - Supplied Title must be a non empty string.
     */
    protected function castTitle(string $title): void
    {
        // Validates supplied parameter.
        $titleValue = Str::create($title)->trim();
        if ($titleValue->getLength() === 0) {
            throw NonEmptyStringException::withName('$title');
        }

        $this->title = $titleValue;
    }

    /**
     * Returns the Instance's Title.
     */
    public function getTitle(): Str
    {
        return $this->title;
    }
}
