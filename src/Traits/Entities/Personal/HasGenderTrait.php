<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Traits\Entities\Personal;

use HraDigital\Datatypes\Exceptions\Entities\UnexpectedEntityValueException;
use HraDigital\Datatypes\Scalar\Str;

/**
 * Trait for an Entity's Gender attribute.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
trait HasGenderTrait
{
    /** @var Str $gender - Gender */
    protected Str $gender;

    /**
     * Mutator method for setting the value into the Attribute.
     *
     * @param  string $gender - Gender.
     * @return void
     */
    protected function castGender(string $gender): void
    {
        // Sanitizes and checks supplied value.
        $genderValue = Str::create($gender)->toLower()->toUpperFirst();

        if (!(
            $genderValue->equals(Str::create('Male')) ||
            $genderValue->equals(Str::create('Female')) ||
            $genderValue->equals(Str::create('Other'))
        )) {
            throw new UnexpectedEntityValueException('$gender');
        }

        $this->gender = $genderValue;
    }

    /**
     * Returns the Entity's Gender.
     *
     * @return Str
     */
    public function getGender(): Str
    {
        return $this->gender;
    }
}
