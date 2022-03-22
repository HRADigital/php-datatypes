<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Attributes\Personal;

use HraDigital\Datatypes\Exceptions\Datatypes\NonEmptyStringException;
use HraDigital\Datatypes\Scalar\Str;

/**
 * Trait for an Entity's Nationality attribute.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
trait HasNationalityTrait
{
    /** @var Str $nationality - Nationality */
    protected ?Str $nationality = null;

    /**
     * Mutator method for setting the value into the Attribute.
     *
     * @param  string $nationality - Nationality.
     * @return void
     */
    protected function castNationality(?string $nationality): void
    {
        $nationalityValue = $nationality ? Str::create($nationality)->trim() : null;

        if ($nationalityValue !== null && $nationalityValue->getLength() === 0) {
            throw NonEmptyStringException::withName('$nationality');
        }

        $this->nationality = $nationalityValue;
    }

    /**
     * Returns the Entity's Nationality.
     *
     * @return Str|null
     */
    public function getNationality(): ?Str
    {
        return $this->nationality;
    }
}
