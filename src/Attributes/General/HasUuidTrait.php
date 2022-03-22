<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Attributes\General;

use HraDigital\Datatypes\Scalar\Str;

/**
 * Trait for a Record's UUID (Universal Unique Identifier) attribute.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
trait HasUuidTrait
{
    /** @var Str $uuid - Universal Unique Identifier */
    protected Str $uuid;

    /**
     * Mutator method for setting the value into the Attribute.
     *
     * @param  string $uuid - Universal Unique Identifier.
     * @return void
     */
    protected function castUuid(string $uuid): void
    {
        $this->uuid = Str::create($uuid);
    }

    /**
     * Returns the Universal Unique Identifier.
     *
     * @return Str
     */
    public function getUuid(): Str
    {
        return $this->uuid;
    }
}
