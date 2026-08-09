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
 * Required Entity Value Missing Exception.
 *
 * This Exception should be raised when an Entity's required field is missing while
 * loading the Entity.
 *
 * When possible, message should be overridden, and missing field should be specified
 * in error message.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 *
 * @phpstan-consistent-constructor
 */
class RequiredEntityValueMissingException extends UnprocessableEntityException
{
    protected $message = "A Required Entity field was missing, while loading.";

    public static function withName(string $name, ?Exception $inner = null): self
    {
        return new static(
            sprintf("Entity field '%s' was missing, while loading.", $name),
            $inner
        );
    }
}
