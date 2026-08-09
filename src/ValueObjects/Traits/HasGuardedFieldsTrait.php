<?php

/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at https://mozilla.org/MPL/2.0/.
 *
 * Copyright (c) HRADigital - Hugo Rafael Azevedo.
 */

declare(strict_types=1);

namespace HraDigital\Datatypes\ValueObjects\Traits;

use function array_key_exists;

/**
 * Adds Guarded field's functionality to a Value Object.
 *
 * Allows Value Object's implementation to remove any field's from original
 * attribute's listing.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 */
trait HasGuardedFieldsTrait
{
    /** @var array<int, string> $guarded - List of fields that should not be serializable into JSON. */
    protected array $guarded = [];

    /**
     * Removes any guarded fields from supplied array of fields, and returns result.
     *
     * @param  array<string, mixed> $original - Original list of fields to be filtered off.
     * @return array<string, mixed>
     */
    protected function removeGuardedFields(array $original): array
    {
        // Removes any guarded attribute from $json array.
        foreach ($this->guarded as $guarded) {
            if (array_key_exists($guarded, $original)) {
                unset($original[$guarded]);
            }
        }

        return $original;
    }
}
