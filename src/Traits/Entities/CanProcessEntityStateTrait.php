<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Traits\Entities;

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
     * eg:. This can be used as an handler for onLoad or onUpdate handlers.
     *
     * Needs to be registered in the Entity's Constructor, before calling parent Constructor.
     *
     * @return void
     */
    private function onEventSnapshotState(): void
    {
        $this->initialState = $this->getAttributes();
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
     * @return array
     */
    final public function getDirty(): array
    {
        // Loops through all the class' attributes, and validates if any has changed.
        $dirty = [];
        foreach ($this->getAttributes() as $field => $value) {

            // Is the current value different from the initial one?
            // Is the Entity NEW, and the field a required one?
            // If so, add it to the $dirty return array.
            if (
                $value !== $this->initialState[$field] ||
                ($this->isNew() && \array_search($field, $this->required) !== false)
            ) {
                $dirty[$field] = $value;
            }
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
        $this->loadAttributes($mapped);

        if (\method_exists($this, 'triggerOnUpdate')) {
            $this->{'triggerOnUpdate'}();
        }
    }
}
