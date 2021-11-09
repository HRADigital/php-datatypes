<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Traits\Entities\Location;

/**
 * Trait for an Entity's Street attribute.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   Proprietary
 */
trait HasStreetTrait
{
    /** @var string $street - Street */
    protected string $street = '';

    /**
     * Mutator method for setting the value into the Attribute.
     *
     * @param  string $street - Street.
     * @return void
     */
    protected function castStreet(string $street): void
    {
        $this->street = \trim($street);
    }

    /**
     * Returns the Entity's Street.
     *
     * @return string
     */
    public function getStreet(): string
    {
        return $this->street;
    }
}
