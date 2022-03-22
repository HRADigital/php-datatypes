<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Attributes\Location;

use HraDigital\Datatypes\Scalar\Str;

/**
 * Trait for an Entity's Country attribute.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
trait HasCountryTrait
{
    /** @var Str $country - Country */
    protected Str $country;

    /**
     * Mutator method for setting the value into the Attribute.
     *
     * @param  string $country - Country.
     * @return void
     */
    protected function castCountry(string $country): void
    {
        $this->country = Str::create($country)->trim();
    }

    /**
     * Returns the Entity's Country.
     *
     * @return Str
     */
    public function getCountry(): Str
    {
        return $this->country;
    }
}
