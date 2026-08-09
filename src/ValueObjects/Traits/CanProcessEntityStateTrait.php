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

use HraDigital\Datatypes\ValueObjects\AbstractValueObject;
use function array_keys;
use function array_search;
use function count;
use function is_object;
use function method_exists;

/**
 * Will handle state changes on an Entity.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 */
trait CanProcessEntityStateTrait
{
    /** @var array<string, mixed> $initialState - Initial Entity's state. */
    private array $initialState = [];

    /**
     * Event handler that will create a snapshot of object's current state.
     *
     * Needs to be registered in the Entity's Constructor, before calling parent Constructor.
     */
    protected function onLoadSnapshotState(): void
    {
        $this->initialState = $this->toArray();
    }

    /**
     * Validates if there are any Dirty class attributes.
     *
     * Returns TRUE if at least one attribute has changed, since the class
     * was initially loaded.
     */
    final public function isDirty(): bool
    {
        return (count($this->getDirty()) > 0);
    }

    /**
     * Returns a list of attributes that have changed value.
     *
     * If the Entity is not marked as dirty, this will return an empty array.
     *
     * @return array<string, mixed>
     */
    final public function getDirty(bool $withTimestamps = false): array
    {
        // Loops through all the class' attributes, and validates if any has changed.
        $dirty = [];
        foreach ($this->initialState as $field => $value) {

            $isNewOrRequired = (
                (method_exists($this, 'isNew') && $this->isNew()) ||
                array_search($field, $this->required)
            );

            if ($this->{$field} instanceof AbstractValueObject) {

                // A nested Value Object only reports state changes if it also tracks them.
                $nested = $this->{$field};
                if (! method_exists($nested, 'getDirty')) {
                    continue;
                }

                if ($isNewOrRequired || (method_exists($nested, 'isDirty') && $nested->isDirty())) {
                    $dirty[$field] = $nested->getDirty($withTimestamps);
                }

                continue;
            }

            if (is_object($this->{$field}) && method_exists($this->{$field}, '__toString')) {
                $hasChanged = ((string) $value) !== ((string) $this->{$field});
            } elseif (is_object($this->{$field})) {
                $hasChanged = $value !== ((array) $this->{$field});
            } else {
                $hasChanged = $value !== $this->{$field};
            }

            if ($hasChanged || $isNewOrRequired) {
                if (is_object($this->{$field}) && method_exists($this->{$field}, '__toString')) {
                    $dirty[$field] = (string) $this->{$field};
                } else {
                    $dirty[$field] = $this->{$field};
                }
            }
        }

        /// Removes timestamps in case they exist, and they were not requested.
        if (!$withTimestamps) {
            unset($dirty['created_at'], $dirty['updated_at'], $dirty['deleted_at']);
        }

        // Returns all dirty attributes.
        return $dirty;
    }

    /**
     * Returns a list of attributes, with their original values.
     *
     * When the Entity's attributes change, it becomes Dirty. This method will return the
     * list of attributes, with their original values prior to that change.
     *
     * @return array<string, mixed>
     */
    final public function getOriginal(): array
    {
        return $this->initialState;
    }

    /**
     * Resets the instance's state, cleaning up "Dirty" attributes, and reset tracking.
     */
    final public function resetState(): void
    {
        $fields = array_keys($this->initialState);

        foreach ($fields as $field) {
            if ($this->{$field} instanceof AbstractValueObject && method_exists($this->{$field}, 'resetState')) {
                $this->{$field}->resetState();
            }
        }

        $this->initialState = $this->toArray();
    }
}
