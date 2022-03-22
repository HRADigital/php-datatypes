<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Attributes\Personal;

use HraDigital\Datatypes\Exceptions\Datatypes\NonEmptyStringException;
use HraDigital\Datatypes\Scalar\Str;

/**
 * Trait for an Entity's Country of Birth attribute.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
trait HasCountryOfBirthTrait
{
    /** @var Str $country_of_birth - Country of Birth */
    protected Str $country_of_birth;

    /**
     * Mutator method for setting the value into the Attribute.
     *
     * @param  string $country - Country of Birth.
     * @return void
     */
    protected function castCountryOfBirth(string $country): void
    {
        $countryValue = Str::create($country)->trim();

        if ($countryValue->getLength() === 0) {
            throw NonEmptyStringException::withName('$country_of_birth');
        }

        $this->country_of_birth = $countryValue;
    }

    /**
     * Returns the Entity's Country of Birth.
     *
     * @return Str
     */
    public function getCountryOfBirth(): Str
    {
        return $this->country_of_birth;
    }
}
