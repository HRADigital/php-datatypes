<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Traits\Entities\General;

use HraDigital\Datatypes\Exceptions\Datatypes\NonEmptyStringException;

/**
 * Gives Alias information capabilities to an Entity/Value Object.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
trait HasAliasTrait
{
    /** @var string $alias - Instances's Alias. */
    protected string $alias = '';

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
        $alias = \strtolower(\trim($alias));
        $alias = \str_replace(' ', '_', $alias);

        // Validates if alias is filled.
        if (\strlen($alias) === 0) {
            throw new NonEmptyStringException('$alias');
        }

        // We'll set the alias value on the attribute, but use the sanitizeAlias() method
        // to sanitize its value.
        $this->alias = $alias;
    }

    /**
     * Returns the Entity's alias.
     *
     * @return string
     */
    public function getAlias(): string
    {
        return $this->alias;
    }
}
