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
 * Unsupported Media Type Base Domain Exception.
 *
 * The 415 (Unsupported Media Type) status code indicates that the request could not be
 * processed because of an unsupported MediaType in the request.
 *
 * The request entity has a media type which the server or resource does not support.
 * For example, the client uploads an image as image/svg+xml, but the server requires
 * that images use a different format.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 *
 * @phpstan-consistent-constructor
 */
class UnsupportedMediaTypeException extends AbstractBaseException
{
    protected $message = "The supplied MediaType is not supported by the system.";
    protected $code = 415;

    /**
     * Initializes Base Unsupported Media Type Exception.
     *
     * Code value will be collected from defined class attribute.
     */
    public static function withName(string $name, ?Exception $inner = null): self
    {
        return new static(
            sprintf("MediaType '%s' is not supported by the system.", $name),
            $inner
        );
    }
}
