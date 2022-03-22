<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Traits\ValueObjects;

/**
 * Adds Guarded field's functionality to a Value Object.
 *
 * Allows Value Object's implementation to remove any field's from original
 * attribute's listing.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
trait HasGuardedFieldsTrait
{
    /** @var array $guarded - List of fields that should not be serializable into JSON. */
    protected array $guarded = [];

    /**
     * Removes any guarded fields from supplied array of fields, and returns result.
     *
     * @param  array $original - Original list of fields to be filtered off.
     * @return array
     */
    protected function removeGuardedFields(array $original): array
    {
        // Removes any guarded attribute from $json array.
        foreach ($this->guarded as $guarded) {
            if (\array_key_exists($guarded, $original)) {
                unset($original[$guarded]);
            }
        }

        return $original;
    }
}
