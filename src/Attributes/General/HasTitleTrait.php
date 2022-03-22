<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Attributes\General;

use HraDigital\Datatypes\Exceptions\Datatypes\NonEmptyStringException;
use HraDigital\Datatypes\Scalar\Str;

/**
 * Gives Title information capabilities to an Entity/Value Object.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
trait HasTitleTrait
{
    /** @var Str $title - Instance's Title. */
    protected Str $title;

    /**
     * Casting method for Title.
     *
     * @param string $title - New value to be set on Attribute.
     *
     * @throws NonEmptyStringException - Supplied Title must be a non empty string.
     * @return void
     */
    protected function castTitle(string $title): void
    {
        // Validates supplied parameter.
        $titleValue = Str::create($title)->trim();
        if ($titleValue->getLength() === 0) {
            throw NonEmptyStringException::withName('$title');
        }

        $this->title = $titleValue;
    }

    /**
     * Returns the Instance's Title.
     *
     * @return Str
     */
    public function getTitle(): Str
    {
        return $this->title;
    }
}
