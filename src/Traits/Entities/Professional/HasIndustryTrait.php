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
trait HasIndustryTrait
{
    /** @var Str|null $industry - Profile's Professional Industry */
    protected ?Str $industry = null;

    /**
     * Sets the Profile's Professional Industry value of an Entity.
     *
     * @param  string|null $industry - Professional Industry.
     *
     * @throws NonEmptyStringException - Supplied Profile's Professional Industry must be a non empty string.
     * @return void
     */
    protected function castIndustry(?string $industry): void
    {
        // Validates supplied parameter.
        $industryValue = $industry ? Str::create($industry)->trim() : null;

        if ($industryValue !== null && $industryValue->getLength() === 0) {
            throw new NonEmptyStringException('$occupation');
        }

        $this->industry = $industryValue;
    }

    /**
     * Returns the Instance's Profile's Industry.
     *
     * @return Str|null
     */
    public function getIndustry(): ?Str
    {
        return $this->industry;
    }
}
