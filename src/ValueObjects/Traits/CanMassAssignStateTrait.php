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

use HraDigital\Datatypes\Exceptions\Datatypes\ParameterOutOfRangeException;
use HraDigital\Datatypes\ValueObjects\AbstractValueObject;
use function count;
use function is_object;
use function method_exists;

/**
 * Will handle mass state assignment on an Entity.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 */
trait CanMassAssignStateTrait
{
    // Mass assignment always ends with the onUpdate() events being triggered, so the handling
    // trait is composed in here. A class using both traits directly is still valid - PHP
    // flattens the same trait only once.
    use CanProcessOnUpdateEventsTrait;

    /**
     * Sets new values to a set of class attributes, all at once.
     *
     * @param  array<string, mixed> $fields - Associative array, where the keys are the class attribute's names.
     *
     * @throws ParameterOutOfRangeException - If supplied array is empty.
     */
    final public function setAttributes(array $fields): void
    {
        // Validates the supplied array is a non empty associative one.
        $count = count($fields);
        if ($count === 0) {
            throw ParameterOutOfRangeException::withName('$fields');
        }

        // Process supplied fields.
        $mapped = $this->translateToMappedFields($fields);
        $this->processRules($mapped);

        $fields = [];
        foreach ($mapped as $field => $value) {
            if ($this->{$field} instanceof AbstractValueObject && method_exists($this->{$field}, 'setAttributes')) {
                $this->{$field}->setAttributes($value);
            } elseif (is_object($this->{$field}) && method_exists($this->{$field}, '__toString')) {
                $fields[$field] = (string) $value;
            } else {
                $fields[$field] = $value;
            }
        }

        $this->castAttributes($fields);

        $this->triggerOnUpdate();
    }
}
