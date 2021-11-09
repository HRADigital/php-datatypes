<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Traits\Entities\Personal;

use HraDigital\Datatypes\Exceptions\Datatypes\NonEmptyStringException;
use HraDigital\Datatypes\Scalar\Str;

/**
 * Gives Surname information capabilities to an Entity/Value Object.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
trait HasSurnameTrait
{
    /** @var Str $surname - Instance's Surname. */
    protected Str $surname;

    /**
     * Setter method for Surname.
     *
     * @param string $surname - New value to be set on Attribute.
     *
     * @throws NonEmptyStringException - Supplied Surname must be a non empty string.
     * @return void
     */
    protected function castSurname(string $surname): void
    {
        // Validates supplied parameter.
        $surnameValue = Str::create($surname)->trim();

        if ($surnameValue->getLength() === 0) {
            throw new NonEmptyStringException('$surname');
        }

        $this->surname = $surnameValue;
    }

    /**
     * Returns the Instance's Surname.
     *
     * @return Str
     */
    public function getSurname(): Str
    {
        return $this->surname;
    }
}
