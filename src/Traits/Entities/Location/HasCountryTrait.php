<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Traits\Entities\Location;

/**
 * Trait for an Entity's Country attribute.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   Proprietary
 */
trait HasCountryTrait
{
    /** @var string $country - Country */
    protected string $country = '';

    /**
     * Mutator method for setting the value into the Attribute.
     *
     * @param  string $country - Country.
     * @return void
     */
    protected function castCountry(string $country): void
    {
        $this->country = \trim($country);
    }

    /**
     * Returns the Entity's Country.
     *
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }
}
