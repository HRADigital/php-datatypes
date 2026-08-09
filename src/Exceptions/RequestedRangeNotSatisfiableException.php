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
 * Requested Range is Not Satisfiable Domain Exception.
 *
 * None of the ranges in the request's Range header field1 overlap the
 * current extent of the selected resource or that the set of ranges
 * requested has been rejected due to invalid ranges or an excessive
 * request of small or overlapping ranges.
 *
 * Use this Exception where it makes semanticle sense, even if not making
 * total technical sense.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 */
class RequestedRangeNotSatisfiableException extends AbstractBaseException
{
    protected $message = "The requested range for the operation you're trying to perform, is not satisfiable.";
    protected $code = 416;

    /**
     * Initializes Base Requested Range is Not Satisfiable Exception.
     *
     * Message and code values will be collected from defined class attributes.
     * You will only need to define an optional Inner Exceptions.
     */
    public function __construct(?Exception $inner = null)
    {
        parent::__construct(null, $inner);
    }
}
