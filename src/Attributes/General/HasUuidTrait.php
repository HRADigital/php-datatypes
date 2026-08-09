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
 * Trait for a Record's UUID (Universal Unique Identifier) attribute.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 */
trait HasUuidTrait
{
    /** @var Str $uuid - Universal Unique Identifier */
    protected Str $uuid;

    /**
     * Mutator method for setting the value into the Attribute.
     */
    protected function castUuid(string $uuid): void
    {
        $this->uuid = Str::create($uuid);
    }

    /**
     * Returns the Universal Unique Identifier.
     */
    public function getUuid(): Str
    {
        return $this->uuid;
    }
}
