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
    /** @var Str $sex - Gender */
    protected Str $sex = Str::create('Male');

    /**
     * Mutator method for setting the value into the Attribute.
     *
     * @param  string $sex - Gender.
     * @return void
     */
    protected function castSex(string $sex): void
    {
        // Sanitizes and checks supplied value.
        $sexValue = Str::create($sex)->toLower()->toUpperFirst();

        if (!$sexValue->equals(Str::create('Male')) && !$sexValue->equals(Str::create('Female'))) {
            throw new UnexpectedEntityValueException('$sex');
        }

        $this->sex = $sex;
    }

    /**
     * Returns the Entity's Gender.
     *
     * @return Str
     */
    public function getGender(): Str
    {
        return $this->sex;
    }
}
