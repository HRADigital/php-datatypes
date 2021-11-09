<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Traits\Entities\Location;

use HraDigital\Datatypes\Scalar\Str;

/**
 * Trait for an Entity's City attribute.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
trait HasCityTrait
{
    /** @var Str $city - City */
    protected Str $city = Str::create('');

    /**
     * Mutator method for setting the value into the Attribute.
     *
     * @param  string $city - City.
     * @return void
     */
    protected function castCity(string $city): void
    {
        $this->city = Str::create($city)->trim();
    }

    /**
     * Returns the Entity's City.
     *
     * @return Str
     */
    public function getCity(): Str
    {
        return $this->city;
    }
}
