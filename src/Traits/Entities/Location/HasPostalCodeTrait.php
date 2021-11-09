<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Traits\Entities\Location;

use HraDigital\Datatypes\Scalar\Str;

/**
 * Trait for an Entity's Postal Code attribute.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
trait HasPostalCodeTrait
{
    /** @var Str $postal_code - Postal Code */
    protected Str $postal_code;

    /**
     * Mutator method for setting the value into the Attribute.
     *
     * @param  string $postalCode - Postal Code.
     * @return void
     */
    protected function castPostalCode(string $postalCode): void
    {
        $this->postal_code = Str::create($postalCode)->trim();
    }

    /**
     * Returns the Entity's Postal Code.
     *
     * @return Str
     */
    public function getPostalCode(): Str
    {
        return $this->postal_code;
    }
}
