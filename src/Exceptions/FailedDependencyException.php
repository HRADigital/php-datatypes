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
 * Failed Dependency Base Domain Exception.
 *
 * The 424 (Failed Dependency) status code means that the method could not be
 * performed on the resource because the requested action depended on another
 * action and that action failed.
 *
 * For example, if a command in a PROPPATCH method fails, then, at minimum,
 * the rest of the commands will also fail with 424 (Failed Dependency).
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 */
class FailedDependencyException extends AbstractBaseException
{
    protected $message = "The action failed due to failure of a previous action.";
    protected $code = 424;

    /**
     * Initializes Base Conflist Exception.
     *
     * Message and code values will be collected from defined class attributes.
     * You will only need to define an optional Inner Exceptions.
     */
    public function __construct(?Exception $inner = null)
    {
        parent::__construct(null, $inner);
    }
}
