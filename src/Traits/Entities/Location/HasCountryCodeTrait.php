<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Traits\Entities\Location;

use HraDigital\Datatypes\Scalar\VoString;

/**
 * Trait for an Entity's Country Code attribute.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   Proprietary
 */
trait HasCountryCodeTrait
{
    /** @var VoString $countryCode - Country Code */
    protected VoString $country_code;

    /**
     * Mutator method for setting the value into the Attribute.
     *
     * @param  string $countryCode - Country Code.
     * @return void
     */
    protected function castCountryCode(string $countryCode): void
    {
        $this->country_code = VoString::create($countryCode);
    }

    /**
     * Returns the Entity's Country Code.
     *
     * @return VoString
     */
    public function getCountryCode(): VoString
    {
        return $this->country_code;
    }
}
