<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Traits\Entities\General;

use HraDigital\Datatypes\Exceptions\Datatypes\NonEmptyStringException;

/**
 * Gives Name information capabilities to an Entity/Value Object.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   Proprietary
 */
trait HasNameTrait
{
    /** @var string $name - Instance's Name. */
    protected string $name = '';

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
        if (\strlen(\trim($name)) === 0) {
            throw new NonEmptyStringException('$name');
        }

        $this->name = $name;
    }

    /**
     * Returns the Instance's name.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}
