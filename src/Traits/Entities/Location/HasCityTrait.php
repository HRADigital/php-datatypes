<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Traits\Entities\Location;

/**
 * Trait for an Entity's City attribute.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
trait HasCityTrait
{
    /** @var string $city - City */
    protected string $city = '';

    /**
     * Mutator method for setting the value into the Attribute.
     *
     * @param  string $city - City.
     * @return void
     */
    protected function castCity(string $city): void
    {
        $this->city = \trim($city);
    }

    /**
     * Returns the Entity's City.
     *
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }
}
