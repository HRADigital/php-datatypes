<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Traits\Entities\Location;

/**
 * Trait for an Entity's Address attribute.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   Proprietary
 */
trait HasAddressTrait
{
    /** @var string $address - Address */
    protected string $address = '';

    /**
     * Mutator method for setting the value into the Attribute.
     *
     * @param  string $address - Address.
     * @return void
     */
    protected function castAddress(string $address): void
    {
        $this->address = \trim($address);
    }

    /**
     * Returns the Entity's Address.
     *
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }
}
