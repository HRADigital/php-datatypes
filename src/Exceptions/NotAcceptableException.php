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
 * Not Acceptable Base Domain Exception.
 *
 * The resource identified by the request is only capable of generating
 * response entities which have content characteristics not acceptable
 * according to the accept headers sent in the request.
 *
 * Use this Exception where it makes semanticle sense, even if not making
 * total technical sense.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 */
class NotAcceptableException extends AbstractBaseException
{
    protected $message = "The operation you're trying to perform, is not acceptable.";
    protected $code = 406;

    /**
     * Initializes Base Not Acceptable Exception.
     *
     * Message and code values will be collected from defined class attributes.
     * You will only need to define an optional Inner Exceptions.
     */
    public function __construct(?Exception $inner = null)
    {
        parent::__construct(null, $inner);
    }
}
