<?php

/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at https://mozilla.org/MPL/2.0/.
 *
 * Copyright (c) HRADigital - Hugo Rafael Azevedo.
 */

declare(strict_types=1);

namespace HraDigital\Datatypes\Attributes\General;

use HraDigital\Datatypes\Scalar\Str;

/**
 * Gives Password capabilities to an Entity/Value Object.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 */
trait HasPasswordTrait
{
    /** @var Str|null $password - Record's password value. */
    protected ?Str $password = null;

    /**
     * Sets the password value of an Entity/Value Object.
     */
    protected function castPassword(string $password): void
    {
        $this->password = ($password ? Str::create($password) : null);
    }

    /**
     * Returns record's Password value.
     */
    public function getPassword(): ?Str
    {
        return $this->password;
    }
}
