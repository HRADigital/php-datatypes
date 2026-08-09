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
 * Forbidden Base Domain Exception.
 *
 * The requested resource could not be found but may be available again in the
 * future. Subsequent requests by the client are permissible.
 *
 * The request contained valid data and was understood by the server, but the server
 * is refusing action. This may be due to the user not having the necessary permissions
 * for a resource or needing an account of some sort, or attempting a prohibited action.
 *
 * The request should not be repeated.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 */
class ForbiddenException extends AbstractBaseException
{
    protected $message = "You were forbidden to access the resource you were looking for.";
    protected $code = 403;

    /**
     * Initializes Base Forbidden Exception.
     *
     * Message and code values will be collected from defined class attributes.
     * You will only need to define an optional Inner Exceptions.
     */
    public function __construct(?Exception $inner = null)
    {
        parent::__construct(null, $inner);
    }
}
