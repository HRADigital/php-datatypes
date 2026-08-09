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
use function array_keys;
use function array_search;
use function get_object_vars;

/**
 * Gives Field Mapping capabilities to Value Object's
 *
 * If you extend directly AbstractValueObject, you'll already be inheriting this functionality.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 */
trait HasMappedFieldsTrait
{
    /**
     * @var array<string, string> $maps - Set your overrides as keys, and the attribute they're supposed
     *                                    to map as values.
     */
    protected array $maps = [];

     /**
     * Converts an array with mapped attributes, to an array containing only existing attributes, and returns it.
     *
     * @param  array<string, mixed> $fields - Initial array of mapped Fields.
     * @return array<string, mixed>
     */
    final protected function translateToMappedFields(array $fields): array
    {
        // Loops through the supplied list of fields, and converts any mapped Field name.
        $attributes = array_keys(
            get_object_vars($this)
        );
        $sanitized = [];
        foreach ($fields as $field => $value) {

            /**
             * The priority is to check if the field was loaded with the native name.
             * If that's the case, we'll just set the value.
             *
             * Otherwise, we'll check if the field is mapped to another.
             * In that case, we'll load the value into the mapped field.
             *
             * The default behavior, is just to keep the field=>value pair as initially
             * supplied.
             * Although the behavior is the same as in the initial condition, we are
             * assigning in the else block, so that we keep the priorities in order.
             */
            if (array_search($field, $attributes) !== false) {
                $sanitized[$field] = $value;
            } elseif (array_key_exists($field, $this->maps)) {
                $sanitized[$this->maps[$field]] = $value;
            } else {
                $sanitized[$field] = $value;
            }
        }

        return $sanitized;
    }
}
