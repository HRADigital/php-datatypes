<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Traits\Entities\Personal;

use HraDigital\Datatypes\Datetime\Datetime;

/**
 * Trait for an Entity's DateOfBirth attribute.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
trait HasDateOfBirthTrait
{
    /** @var Datetime|null $dob - Timestamp representing a Date of Birth. */
    protected ?Datetime $dob = null;

    /**
     * Mutator method for setting the value into the Attribute
     *
     * @param  string $dob - Timestamp representing a Date of Birth
     * @return void
     */
    protected function castDob(string $dob): void
    {
        $this->dob = Datetime::fromString($dob);
    }

    /**
     * Returns a Datetime representation for the Entity's Date of Birth.
     *
     * @return Datetime|null
     */
    public function getDateOfBirth(): ?Datetime
    {
        return $this->dob;
    }
}
