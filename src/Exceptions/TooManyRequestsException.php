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
 * Too Many Requests Base Domain Exception.
 *
 * The 429 status code indicates that the user has sent too many requests
 * in a given amount of time ("rate limiting").
 *
 * The response representations SHOULD include details explaining the condition,
 * and MAY include a Retry-After header indicating how long to wait before making
 * a new request.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 */
class TooManyRequestsException extends AbstractBaseException
{
    protected $message = "Too many requests have been made to the system.";
    protected $code = 429;

    /**
     * Initializes Base Too Many Requests Exception.
     *
     * Message and code values will be collected from defined class attributes.
     * You will only need to define an optional Inner Exceptions.
     */
    public function __construct(?Exception $inner = null)
    {
        parent::__construct(null, $inner);
    }
}
