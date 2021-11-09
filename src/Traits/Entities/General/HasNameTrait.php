<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Traits\Entities\General;

use HraDigital\Datatypes\Exceptions\Datatypes\NonEmptyStringException;
use HraDigital\Datatypes\Scalar\Str;

/**
 * Gives Name information capabilities to an Entity/Value Object.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
trait HasNameTrait
{
    /** @var Str $name - Instance's Name. */
    protected Str $name = Str::create('');

    /**
     * Setter method for name.
     *
     * @param string $name - New value to be set on Attribute.
     *
     * @throws NonEmptyStringException - Supplied Name must be a non empty string.
     * @return void
     */
    protected function castName(string $name): void
    {
        // Validates supplied parameter.
        $nameValue = Str::create($name)->trim();
        if ($nameValue->getLength() === 0) {
            throw new NonEmptyStringException('$name');
        }

        $this->name = $name;
    }

    /**
     * Returns the Instance's name.
     *
     * @return Str
     */
    public function getName(): Str
    {
        return $this->name;
    }
}
