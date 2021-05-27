<?php declare(strict_types=1);

namespace Hradigital\Datatypes\Traits\Entities\Location;

/**
 * Trait for an Entity's City attribute.
 *
 * @package   Hradigital\Datatypes
 * @copyright Hradigital\Datatypes
 * @license   Proprietary
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
    public function city(): string
    {
        return $this->city;
    }
}
