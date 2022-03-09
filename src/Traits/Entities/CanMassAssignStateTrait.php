<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Traits\Entities;

use HraDigital\Datatypes\ValueObjects\AbstractValueObject;

/**
 * Will handle mass state assignment on an Entity.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
trait CanMassAssignStateTrait
{
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

        $fields = [];
        foreach ($mapped as $field => $value) {
            if ($this->{$field} instanceof AbstractValueObject && \method_exists($this->{$field}, 'setAttributes')) {
                $this->{$field}->setAttributes($value);
            } else {
                $fields[$field] = $value;
            }
        }

        $this->castAttributes($fields);

        if (\method_exists($this, 'triggerOnUpdate')) {
            $this->{'triggerOnUpdate'}();
        }
    }
}
