<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Traits\Entities\Location;

use HraDigital\Datatypes\Exceptions\Datatypes\NonEmptyStringException;
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
    /** @var Str|null $city - City */
    protected ?Str $city;

    /**
     * Mutator method for setting the value into the Attribute.
     *
     * @param  string|null $city - City.
     *
     * @throws NonEmptyStringException - If supplied value is not a non empty string.
     * @return void
     */
    protected function castCity(?string $city): void
    {
        $cityValue = $city ? Str::create($city)->trim() : null;

        if ($cityValue !== null && $cityValue->getLength() === 0) {
            throw NonEmptyStringException::withName('$city');
        }

        $this->city = $cityValue;
    }

    /**
     * Returns the Entity's City.
     *
     * @return Str|null
     */
    public function getCity(): ?Str
    {
        return $this->city;
    }
}
