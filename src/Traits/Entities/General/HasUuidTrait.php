<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Traits\Entities\General;

/**
 * Trait for a Record's UUID (Universal Unique Identifier) attribute.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   Proprietary
 */
trait HasUuidTrait
{
    /** @var string $uuid - Universal Unique Identifier */
    protected string $uuid;

    /**
     * Mutator method for setting the value into the Attribute.
     *
     * @param  string $uuid - Universal Unique Identifier.
     * @return void
     */
    protected function castUuid(string $uuid): void
    {
        $this->uuid = $uuid;
    }

    /**
     * Returns the Universal Unique Identifier.
     *
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }
}
