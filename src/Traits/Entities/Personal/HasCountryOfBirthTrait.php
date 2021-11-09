<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Traits\Entities\Personal;

use HraDigital\Datatypes\Exceptions\Entities\UnexpectedEntityValueException;

/**
 * Trait for an Entity's Country of Birth attribute.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   Proprietary
 */
trait HasCountryOfBirthTrait
{
    /** @var string $country_of_birth - Country of Birth */
    protected string $country_of_birth = '';

    /**
     * Mutator method for setting the value into the Attribute.
     *
     * @param  string $country - Country of Birth.
     * @return void
     */
    protected function castCountryOfBirth(string $country): void
    {
        if (\strlen(\trim($country)) === 0) {
            throw new UnexpectedEntityValueException('Supplied Country of Birth must be a non empty string.');
        }

        $this->country_of_birth = \trim($country);
    }

    /**
     * Returns the Entity's Country of Birth.
     *
     * @return string
     */
    public function getCountryOfBirth(): string
    {
        return $this->country_of_birth;
    }
}
