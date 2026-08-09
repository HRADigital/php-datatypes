<?php

/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at https://mozilla.org/MPL/2.0/.
 *
 * Copyright (c) HRADigital - Hugo Rafael Azevedo.
 */

declare(strict_types=1);

namespace HraDigital\Datatypes\Exceptions\Collections;

use HraDigital\Datatypes\Exceptions\UnprocessableEntityException;
use Exception;
use function sprintf;

/**
 * Duplicated Entry Collection Exception.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 *
 * @phpstan-consistent-constructor
 */
class DuplicatedEntryException extends UnprocessableEntityException
{
    protected $message = "Provided entry was already added to Collection.";

    public static function withId(int $id, ?Exception $inner = null): self
    {
        return new static(
            sprintf("Provided entry with ID '%d' was already added to Collection.", $id),
            $inner
        );
    }
}
