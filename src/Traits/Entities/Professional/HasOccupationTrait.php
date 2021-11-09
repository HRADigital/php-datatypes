<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Traits\Entities\Professional;

use HraDigital\Datatypes\Exceptions\Datatypes\NonEmptyStringException;

/**
 * Gives Professional Occupation information capabilities to an Entity/Value Object.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
trait HasOccupationTrait
{
    /** @var string|null $occupation - Profile's Professional Occupation */
    protected ?string $occupation = null;

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
        if ($occupation !== null && \strlen(\trim($occupation)) === 0) {
            throw new NonEmptyStringException('$occupation');
        }

        $this->occupation = $occupation;
    }

    /**
     * Returns the Instance's Profile's Occupation.
     *
     * @return string|null
     */
    public function getOccupation(): ?string
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
