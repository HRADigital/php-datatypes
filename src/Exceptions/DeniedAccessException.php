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

/**
 * Denied Access Base Domain Exception.
 *
 * The requested resource could not be found but may be available again in the
 * future. Subsequent requests by the client are permissible.
 *
 * Used specifically for use when authentication is required and has failed or
 * has not yet been provided.
 *
 * Semantically means "unauthorised", the user does not have valid authentication
 * credentials for the target resource.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 */
class DeniedAccessException extends AbstractBaseException
{
    protected $message = "You don't have access to the resource you are looking for.";
    protected $code = 401;

    /**
     * Initializes Base Denied Access Exception.
     *
     * Message and code values will be collected from defined class attributes.
     * You will only need to define an optional Inner Exceptions.
     */
    public function __construct(?Exception $inner = null)
    {
        parent::__construct(null, $inner);
    }
}
