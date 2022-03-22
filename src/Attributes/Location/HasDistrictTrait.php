<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Attributes\Location;

use HraDigital\Datatypes\Exceptions\Datatypes\NonEmptyStringException;
use HraDigital\Datatypes\Scalar\Str;

/**
 * Trait for an Entity's District attribute.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
trait HasDistrictTrait
{
    /** @var Str|null $district - District */
    protected ?Str $district;

    /**
     * Mutator method for setting the value into the Attribute.
     *
     * @param  string|null $district - District.
     *
     * @throws NonEmptyStringException - If supplied value is not a non empty string.
     * @return void
     */
    protected function castDistrict(?string $district): void
    {
        $districtValue = $district ? Str::create($district)->trim() : null;

        if ($districtValue !== null && $districtValue->getLength() === 0) {
            throw NonEmptyStringException::withName('$district');
        }

        $this->district = $districtValue;
    }

    /**
     * Returns the Entity's District.
     *
     * @return Str|null
     */
    public function getDistrict(): ?Str
    {
        return $this->district;
    }
}
