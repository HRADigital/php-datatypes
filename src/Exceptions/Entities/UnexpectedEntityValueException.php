<?php

/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at https://mozilla.org/MPL/2.0/.
 *
 * Copyright (c) HRADigital - Hugo Rafael Azevedo.
 */

declare(strict_types=1);

namespace HraDigital\Datatypes\Exceptions\Entities;

use HraDigital\Datatypes\Exceptions\UnprocessableEntityException;
use Exception;
use function sprintf;

/**
 * Unexpected value Entity Exception.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 *
 * @phpstan-consistent-constructor
 */
class UnexpectedEntityValueException extends UnprocessableEntityException
{
    protected $message = "Application tried to load one or more unexpected values into the Entity.";

    public static function withName(string $name, ?Exception $inner = null): self
    {
        return new static(
            sprintf("Field '%s' had an unexpected value, while loading into an Entity.", $name),
            $inner
        );
    }
}
