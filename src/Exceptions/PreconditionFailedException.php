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
 * Precondition Base Domain Exception.
 *
 * The precondition given in one or more of the request-header fields evaluated
 * to false when it was tested on the server.
 *
 * This response code allows the client to place preconditions on the current
 * resource meta-information (header field data) and thus prevent the requested
 * method from being applied to a resource other than the one intended.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 */
class PreconditionFailedException extends AbstractBaseException
{
    protected $message = "A given precondition evaluated to false on the system.";
    protected $code = 412;

    /**
     * Initializes Base Precondition Failed Exception.
     *
     * Message and code values will be collected from defined class attributes.
     * You will only need to define an optional Inner Exceptions.
     */
    public function __construct(?Exception $inner = null)
    {
        parent::__construct(null, $inner);
    }
}
