<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Traits\Entities\Location;

use HraDigital\Datatypes\Scalar\Str;

/**
 * Trait for an Entity's Street attribute.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
trait HasStreetTrait
{
    /** @var Str $street - Street */
    protected Str $street = Str::create('');

    /**
     * Mutator method for setting the value into the Attribute.
     *
     * @param  string $street - Street.
     * @return void
     */
    protected function castStreet(string $street): void
    {
        $this->street = Str::create($street)->trim();
    }

    /**
     * Returns the Entity's Street.
     *
     * @return Str
     */
    public function getStreet(): Str
    {
        return $this->street;
    }
}
