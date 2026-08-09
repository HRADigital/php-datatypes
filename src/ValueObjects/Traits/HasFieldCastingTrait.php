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

use function array_search;
use function get_class_methods;
use function str_replace;
use function strlen;
use function strpos;
use function ucwords;

/**
 * Gives Field Casting capabilities to Value Object's
 *
 * If you extend directly AbstractValueObject, you'll already be inheriting this functionality.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 */
trait HasFieldCastingTrait
{
    /** @var string $CASTPREFIX - Sets the Casting Mutator method's prefix. */
    private static string $CASTPREFIX = 'cast';

     /**
      * @var array<int, string> $castList - Instance's record initial mutators, used to set a given
      *                                     value into an Attribute.
      */
    private array $castList = [];

    /**
     * Loads a list of already mapped Field values into the Value Object's state.
     *
     * @param  array<string, mixed> $fields - List of mapped Fields to be loaded.
     */
    protected function castAttributes(array $fields): void
    {
        // Loops through all the supplied Field's list.
        foreach ($fields as $field => $value) {
            // Builds up the Mutator's name.
            $mutator = $this->createMutatorName(self::$CASTPREFIX, $field);

            // Checks if the mutator exists in the instance, and if so, loads the value into it.
            if (array_search($mutator, $this->castList) !== false) {
                $this->{$mutator}($value);
            }
        }
    }

    /**
     * Creates and returns a mutator's method name, based on the supplied Prefix and Field's name.
     */
    final protected function createMutatorName(string $prefix, string $field): string
    {
        return ($prefix . str_replace('_', '', ucwords($field, '_')));
    }

    /**
     * Loads a list of casting mutator methods, available within the Instance for processing.
     */
    private function registerAttributeCastingList(): void
    {
        // Loops through all the class' methods, and loads the necessary ones in
        // the corresponding containers.
        foreach (get_class_methods($this) as $method) {
            // Loads casting mutators.
            if (strpos($method, self::$CASTPREFIX) === 0 && strlen($method) > strlen(self::$CASTPREFIX)) {
                $this->castList[] = $method;
            }
        }
    }
}
