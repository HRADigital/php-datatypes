<?php

/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at https://mozilla.org/MPL/2.0/.
 *
 * Copyright (c) HRADigital - Hugo Rafael Azevedo.
 */

declare(strict_types=1);

namespace HraDigital\Datatypes\Exceptions\Datatypes;

use HraDigital\Datatypes\Exceptions\UnprocessableEntityException;
use Exception;
use function sprintf;

/**
 * Invalid String's Length Datatype Exception.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 *
 * @phpstan-consistent-constructor
 */
class InvalidStringLengthException extends UnprocessableEntityException
{
    protected $message = "Supplied field doesn't have required character length.";

    public static function withNameAndLength(string $name, int $length, ?Exception $inner = null): self
    {
        return new static(
            sprintf("Field '%s' doesn't have minimum required character length of %d.", $name, $length),
            $inner
        );
    }
}
