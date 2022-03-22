<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Attributes\Location;

use HraDigital\Datatypes\Scalar\Str;

/**
 * Trait for an Entity's Street Aditional attribute.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
trait HasStreetAdditionalTrait
{
    /** @var Str $street_additional - Street Additional */
    protected Str $street_additional;

    /**
     * Mutator method for setting the value into the Attribute.
     *
     * @param  string $street - Street Additional.
     * @return void
     */
    protected function castStreetAdditional(string $street): void
    {
        $this->street_additional = Str::create($street)->trim();
    }

    /**
     * Returns the Entity's Street Additional.
     *
     * @return Str
     */
    public function getStreetAdditional(): Str
    {
        return $this->street_additional;
    }
}
