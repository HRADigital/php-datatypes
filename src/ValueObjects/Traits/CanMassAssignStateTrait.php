<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\ValueObjects\Traits;

use HraDigital\Datatypes\Exceptions\Datatypes\ParameterOutOfRangeException;
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
     * @throws ParameterOutOfRangeException - If supplied array is empty.
     * @return void
     */
    final public function setAttributes(array $fields): void
    {
        // Validates the supplied array is a non empty associative one.
        $count = \count($fields);
        if ($count === 0) {
            throw ParameterOutOfRangeException::withName('$fields');
        }

        // Process supplied fields.
        $mapped = $this->translateToMappedFields($fields);
        $this->processRules($mapped);

        $fields = [];
        foreach ($mapped as $field => $value) {
            if ($this->{$field} instanceof AbstractValueObject && \method_exists($this->{$field}, 'setAttributes')) {
                $this->{$field}->setAttributes($value);
            } elseif (\is_object($this->{$field}) && \method_exists($this->{$field}, '__toString')) {
                $fields[$field] = (string) $value;
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
