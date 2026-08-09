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
 * Expectation Failed Base Domain Exception.
 *
 * The expectation given in an Expect request-header field could not be met
 * by this server, or, if the server is a proxy, the server has unambiguous
 * evidence that the request could not be met by the next-hop server.
 *
 * Use this Exception where it makes semanticle sense, even if not making
 * total technical sense.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 */
class ExpectationFailedException extends AbstractBaseException
{
    protected $message = "The operation failed due to a previous Expectation not being met.";
    protected $code = 417;

    /**
     * Initializes Base Expectation Failed Exception.
     *
     * Message and code values will be collected from defined class attributes.
     * You will only need to define an optional Inner Exceptions.
     */
    public function __construct(?Exception $inner = null)
    {
        parent::__construct(null, $inner);
    }
}
