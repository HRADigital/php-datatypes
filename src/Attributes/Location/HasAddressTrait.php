<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Attributes\Location;

use HraDigital\Datatypes\Scalar\Str;

/**
 * Trait for an Entity's Address attribute.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
trait HasAddressTrait
{
    /** @var Str $address - Address */
    protected Str $address;

    /**
     * Mutator method for setting the value into the Attribute.
     *
     * @param  string $address - Address.
     * @return void
     */
    protected function castAddress(string $address): void
    {
        $this->address = Str::create($address)->trim();
    }

    /**
     * Returns the Entity's Address.
     *
     * @return Str
     */
    public function getAddress(): Str
    {
        return $this->address;
    }
}
