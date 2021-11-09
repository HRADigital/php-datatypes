<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Traits\ValueObjects;

use HraDigital\Datatypes\Collections\Linear\EntityCollection;
use HraDigital\Datatypes\ValueObjects\AbstractValueObject;

/**
 * Adds conversion of list of Fields into their primitive representation.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   Proprietary
 */
trait HasConversionToPrimitiveValuesTrait
{
    /**
     * Converts all values into primitives, and retiurns the processed array.
     *
     * @param  array $fields - List of Fields to be converted.
     * @return array
     */
    private function convertIntoPrimitiveValues(array $fields): array
    {
        // Loops through all the supplied Fields, and converts their values into primitives.
        $converted = [];
        foreach ($fields as $field => $value) {

            // Returns the string representation of the object, or tries to convert array or object to JSON.
            // If is not an Object not an Array, returns the actual value of the Field.
            if ($value instanceof AbstractValueObject || $value instanceof EntityCollection) {
                $converted[$field] = $value->jsonSerialize();
            } elseif (\is_object($value) && \method_exists($value, '__toString')) {
                $converted[$field] = (string) $value;
            } elseif (\is_array($value) || \is_object($value)) {
                $converted[$field] = \json_encode($value);
            } else {
                $converted[$field] = $value;
            }
        }

        return $converted;
    }
}
