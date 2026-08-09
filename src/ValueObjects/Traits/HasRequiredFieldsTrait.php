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

use HraDigital\Datatypes\Exceptions\Entities\RequiredEntityValueMissingException;
use function array_key_exists;

/**
 * Gives Field Requirement capabilities to Value Object's
 *
 * If you extend directly AbstractValueObject, you'll already be inheriting this functionality.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 */
trait HasRequiredFieldsTrait
{
    /** @var array<int, string> $required - List of required native class attributes. */
    protected array $required = [];

    /**
     * Validates if supplied initial array of Fields, contains all the Required Value Object's fields.
     *
     * @param  array<string, mixed> $fields - List of initial Fields, to be loaded into the Value Object.
     *
     * @throws RequiredEntityValueMissingException - If any of the Required Fields is not present
     *                                               in the supplied Field array.
     */
    private function validateRequired(array $fields): void
    {
        // Checks that all required fields were supplied.
        foreach ($this->required as $required) {
            // First, we'll need to assess if the field already exists NATIVELY in the class.
            // If not, we'll need to assess it is mapped.
            if (! array_key_exists($required, $fields)) {
                throw new RequiredEntityValueMissingException(
                    "Required field '{$required}' was not supplied as a parameter."
                );
            }
        }
    }
}
