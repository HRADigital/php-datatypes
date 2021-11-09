<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Traits\Entities\Location;

/**
 * Trait for an Entity's Latitude attribute.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   Proprietary
 */
trait HasLatitudeTrait
{
    /** @var float $latitude - Latitude */
    protected float $latitude = 0.0;

    /**
     * Mutator method for setting the value into the Attribute.
     *
     * @param  float $latitude - Initial Latitude.
     * @return void
     */
    protected function castLatitude(float $latitude): void
    {
        $this->latitude = $latitude;
    }

    /**
     * Returns the Entity's Latitude.
     *
     * @return float
     */
    public function getLatitude(): float
    {
        return $this->latitude;
    }
}
