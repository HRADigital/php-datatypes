<?php

/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at https://mozilla.org/MPL/2.0/.
 *
 * Copyright (c) HRADigital - Hugo Rafael Azevedo.
 */

declare(strict_types=1);

namespace HraDigital\Datatypes\Exceptions;

use Exception;
use function sprintf;

/**
 * Record Gone Base Domain Exception.
 *
 * The requested resource existed once in the system, but is no longer available.
 * Subsequent requests by the client are permissible.
 *
 * Used when the requested resource is gone already.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 *
 * @phpstan-consistent-constructor
 */
class GoneException extends AbstractBaseException
{
    protected $message = "The resource you are looking for, is no longer available in the system.";
    protected $code = 410;

    /**
     * Initializes Base Record Gone Exception.
     *
     * Code value will be collected from defined class attribute.
     */
    public static function withId(int $id, ?Exception $inner = null): self
    {
        return new static(
            sprintf("The resource with the ID %d no longer exists in the system.", $id),
            $inner
        );
    }
}
