<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Traits\Entities\Professional;

use HraDigital\Datatypes\Exceptions\Datatypes\NonEmptyStringException;
use HraDigital\Datatypes\Scalar\Str;

/**
 * Gives Professional Occupation information capabilities to an Entity/Value Object.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
trait HasOccupationTrait
{
    /** @var Str|null $occupation - Profile's Professional Occupation */
    protected ?Str $occupation = null;

    /**
     * Sets the Profile's Professional Occupation value of an Entity.
     *
     * @param  string|null $occupation - Professional Occupation.
     *
     * @throws NonEmptyStringException - Supplied Profile's Professional Occupation must be a non empty string.
     * @return void
     */
    protected function castOccupation(?string $occupation): void
    {
        // Validates supplied parameter.
        $occupationValue = $occupation ? Str::create($occupation)->trim() : null;

        if ($occupationValue !== null && $occupationValue->getLength() === 0) {
            throw NonEmptyStringException::withName('$occupation');
        }

        $this->occupation = $occupationValue;
    }

    /**
     * Returns the Instance's Profile's Occupation.
     *
     * @return Str|null
     */
    public function getOccupation(): ?Str
    {
        return $this->occupation;
    }

    /**
     * If record has Profile's Occupation.
     *
     * @return bool
     */
    public function hasOccupation(): bool
    {
        return ($this->occupation !== null);
    }
}
