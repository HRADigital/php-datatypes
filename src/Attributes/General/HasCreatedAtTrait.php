<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Attributes\General;

use HraDigital\Datatypes\Datetime\Datetime;

/**
 * Trait for a Record CreatedAt attribute.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
trait HasCreatedAtTrait
{
    /** @var Datetime|null $created_at - Timestamp representing the instant the record was created. */
    protected ?Datetime $created_at = null;

    /**
     * Mutator method for setting the value into the Attribute
     *
     * @param  string $timestamp - Timestamp string representation of the value.
     * @return void
     */
    protected function castCreatedAt(string $timestamp): void
    {
        $this->created_at = Datetime::fromString($timestamp);
    }

    /**
     * Returns a Datetime representation from the instant the record was last updated.
     *
     * @return Datetime
     */
    public function getCreatedAt(): Datetime
    {
        return $this->created_at;
    }
}
