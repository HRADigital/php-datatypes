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
 * Invalid E-mail Datatype Exception.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 *
 * @phpstan-consistent-constructor
 */
class InvalidEmailException extends UnprocessableEntityException
{
    protected $message = "Provided e-mail field does not seam to be a valid e-mail address.";

    public static function withName(string $name, ?Exception $inner = null): self
    {
        return new static(
            sprintf("Provided e-mail '%s' does not seam to be a valid e-mail address.", $name),
            $inner
        );
    }
}
