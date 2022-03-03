<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Traits\Entities\Location;

use HraDigital\Datatypes\Exceptions\Datatypes\NonEmptyStringException;
use HraDigital\Datatypes\Scalar\Str;

/**
 * Trait for an Entity's Parish attribute.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
trait HasParishTrait
{
    /** @var Str|null $parish - Parish */
    protected ?Str $parish;

    /**
     * Mutator method for setting the value into the Attribute.
     *
     * @param  string|null $parish - Parish.
     *
     * @throws NonEmptyStringException - If supplied value is not a non empty string.
     * @return void
     */
    protected function castParish(?string $parish): void
    {
        $parishValue = $parish ? Str::create($parish)->trim() : null;

        if ($parishValue !== null && $parishValue->getLength() === 0) {
            throw NonEmptyStringException::withName('$parish');
        }

        $this->parish = $parishValue;
    }

    /**
     * Returns the Entity's Parish.
     *
     * @return Str|null
     */
    public function getParish(): ?Str
    {
        return $this->parish;
    }
}
