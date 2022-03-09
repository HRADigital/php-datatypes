<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Traits\Entities;

use HraDigital\Datatypes\ValueObjects\AbstractValueObject;

/**
 * Will handle state changes on an Entity.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
trait CanProcessEntityStateTrait
{
    /** @var array $initialState - Initial Entity's state. */
    private array $initialState = [];

    /**
     * Event handler that will create a snapshot of object's current state.
     *
     * Needs to be registered in the Entity's Constructor, before calling parent Constructor.
     *
     * @return void
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
     *
     * @return bool
     */
    final public function isDirty(): bool
    {
        return (\count($this->getDirty()) > 0);
    }

    /**
     * Returns a list of attributes that have changed value.
     *
     * If the Entity is not marked as dirty, this will return an empty array.
     *
     * @param  bool $withTimestamps - In case dirty attributes include timestamps. Defaults to FALSE.
     * @return array
     */
    final public function getDirty(bool $withTimestamps = false): array
    {
        // Loops through all the class' attributes, and validates if any has changed.
        $dirty = [];
        foreach ($this->initialState as $field => $value) {

            $isNewOrRequired = (
                (\method_exists($this, 'isNew') && $this->isNew()) ||
                \array_search($field, $this->required)
            );

            if ($this->{$field} instanceof AbstractValueObject) {

                if ($isNewOrRequired || (\method_exists($this->{$field}, 'isDirty') && $this->{$field}->isDirty())) {
                    $dirty[$field] = $this->{$field}->getDirty($withTimestamps);
                }

                continue;
            }

            if (\method_exists($this->{$field}, '__toString')) {
                $hasChanged = ((string) $value) !== ((string) $this->{$field});
            } else {
                $hasChanged = $value !== $this->{$field};
            }

            if ($hasChanged || $isNewOrRequired) {
                $dirty[$field] = $this->{$field};
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
     * @return array
     */
    final public function getOriginal(): array
    {
        return $this->initialState;
    }

    /**
     * Resets the instance's state, cleaning up "Dirty" attributes, and reset tracking.
     *
     * @return void
     */
    final public function resetState(): void
    {
        $this->initialState = $this->toArray();
    }

    /**
     * Sets new values to a set of class attributes, all at once.
     *
     * @param  array $fields - Associative array, where the keys are the class attribute's names.
     *
     * @throws \UnderflowException       - If supplied array is empty.
     * @throws \UnexpectedValueException - If supplied array is not a string-key only associative array.
     * @throws \InvalidArgumentException - If supplied attribute's names are not non empty strings.
     * @throws \BadMethodCallException   - If any setter method doesn't exist for a chosen attribute.
     *
     * @return void
     */
    final public function setAttributes(array $fields): void
    {
        // Validates the supplied array is a non empty associative one.
        $count = \count($fields);
        if ($count === 0) {
            throw new \UnderflowException('Supplied parameter should be a non empty Array.');
        }

        // Validates that all the indexes are of String type.
        if (\count(\array_filter(\array_keys($fields), 'is_string')) !== $count) {
            throw new \UnexpectedValueException('Supplied parameter should have been an Associative Array.');
        }

        // Process supplied fields.
        $mapped = $this->translateToMappedFields($fields);
        $this->processRules($mapped);
        $this->castAttributes($mapped);

        if (\method_exists($this, 'triggerOnUpdate')) {
            $this->{'triggerOnUpdate'}();
        }
    }
}
