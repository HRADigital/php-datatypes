<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Attributes\Location;

/**
 * Trait for an Entity's Longitude attribute.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
trait HasLongitudeTrait
{
    /** @var float $longitude - Longitude */
    protected float $longitude = 0.0;

    /**
     * Mutator method for setting the value into the Attribute.
     *
     * @param  float $longitude - Initial Longitude.
     * @return void
     */
    protected function castLongitude(float $longitude): void
    {
        $this->longitude = $longitude;
    }

    /**
     * Returns the Entity's Longitude.
     *
     * @return float
     */
    public function getLongitude(): float
    {
        return $this->longitude;
    }
}
