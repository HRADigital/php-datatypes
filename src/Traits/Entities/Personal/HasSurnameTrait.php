<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Traits\Entities\Personal;

use HraDigital\Datatypes\Exceptions\Datatypes\NonEmptyStringException;

/**
 * Gives Surname information capabilities to an Entity/Value Object.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
trait HasSurnameTrait
{
    /** @var string $surname - Instance's Surname. */
    protected string $surname = '';

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
        if (\strlen(\trim($surname)) === 0) {
            throw new NonEmptyStringException('$surname');
        }

        $this->surname = $surname;
    }

    /**
     * Returns the Instance's Surname.
     *
     * @return string
     */
    public function getSurname(): string
    {
        return $this->surname;
    }
}
