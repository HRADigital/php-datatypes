<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Traits\Entities\Personal;

use HraDigital\Datatypes\Exceptions\Datatypes\NonEmptyStringException;
use HraDigital\Datatypes\Scalar\Str;

/**
 * Gives Photo information capabilities to an Entity/Value Object.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
trait HasPhotoTrait
{
    /** @var Str|null $photo - Profile's Photo file */
    protected ?Str $photo = null;

    /**
     * Sets the Profile's Photo value of an Entity.
     *
     * @param  string|null $photo - Profile's Photo.
     *
     * @throws NonEmptyStringException - Supplied Profile's Photo must be a non empty string.
     * @return void
     */
    protected function castPhoto(?string $photo): void
    {
        // Validates supplied parameter.
        $photoValue = Str::create($photo)->trim();

        if ($photoValue->getLength() === 0) {
            throw new NonEmptyStringException('$photo');
        }

        $this->photo = $photoValue;
    }

    /**
     * Returns the Instance's Profile's Photo.
     *
     * @return Str|null
     */
    public function getPhoto(): ?Str
    {
        return $this->photo;
    }

    /**
     * If record has Profile's Photo.
     *
     * @return bool
     */
    public function hasPhoto(): bool
    {
        return ($this->photo !== null);
    }
}
