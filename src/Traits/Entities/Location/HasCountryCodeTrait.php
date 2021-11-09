<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Traits\Entities\Location;

use HraDigital\Datatypes\Scalar\Str;

/**
 * Trait for an Entity's Country Code attribute.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
trait HasCountryCodeTrait
{
    /** @var Str $countryCode - Country Code */
    protected Str $country_code;

    /**
     * Mutator method for setting the value into the Attribute.
     *
     * @param  string $countryCode - Country Code.
     * @return void
     */
    protected function castCountryCode(string $countryCode): void
    {
        $this->country_code = Str::create($countryCode);
    }

    /**
     * Returns the Entity's Country Code.
     *
     * @return Str
     */
    public function getCountryCode(): Str
    {
        return $this->country_code;
    }
}
