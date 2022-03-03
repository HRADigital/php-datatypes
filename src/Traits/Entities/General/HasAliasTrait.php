<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Traits\Entities\General;

use HraDigital\Datatypes\Exceptions\Datatypes\NonEmptyStringException;
use HraDigital\Datatypes\Scalar\Str;

/**
 * Gives Alias information capabilities to an Entity/Value Object.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
trait HasAliasTrait
{
    /** @var Str $alias - Instances's Alias. */
    protected Str $alias;

    /**
     * Setter method for alias.
     *
     * @param string $alias - New value to be set on Attribute.
     *
     * @throws NonEmptyStringException - Supplied Alias must be a non empty string.
     * @return void
     */
    protected function castAlias(string $alias): void
    {
        // Sanitizes supplied parameter.
        $aliasValue = Str::create($alias)->trim()->toLower()->replace(' ', '_');

        // Validates if alias is filled.
        if ($aliasValue->getLength() === 0) {
            throw NonEmptyStringException::withName('$alias');
        }

        // We'll set the alias value on the attribute, but use the sanitizeAlias() method
        // to sanitize its value.
        $this->alias = $aliasValue;
    }

    /**
     * Returns the Entity's alias.
     *
     * @return Str
     */
    public function getAlias(): Str
    {
        return $this->alias;
    }
}
