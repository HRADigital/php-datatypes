<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Attributes\Location;

use HraDigital\Datatypes\Scalar\Str;

/**
 * Trait for an Entity's Street Number attribute.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
trait HasStreetNumberTrait
{
    /** @var Str $street_adicional - Street Number */
    protected Str $street_no;

    /**
     * Mutator method for setting the value into the Attribute.
     *
     * @param  string $number - Street Number.
     * @return void
     */
    protected function castStreetNo(string $number): void
    {
        $this->street_no = Str::create($number)->trim();
    }

    /**
     * Returns the Entity's Street Number.
     *
     * @return Str
     */
    public function getStreetNumber(): Str
    {
        return $this->street_no;
    }
}
