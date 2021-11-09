<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Traits\Entities\General;

use HraDigital\Datatypes\Datetime\Datetime;

/**
 * Trait for an Entity DeletedAt attribute.
 *
 * Only use this Trait in in Entities/Value Objects that have Soft Delete capabilities.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   Proprietary
 */
trait HasDeletedAtTrait
{
    /** @var Datetime|null $deleted_at - Timestamp representing the instant the record was marked as deleted. */
    protected ?Datetime $deleted_at = null;

    /**
     * Mutator method for setting the value into the Attribute
     *
     * @param  string|null $timestamp - Timestamp string representation of the value.
     * @return void
     */
    protected function castDeletedAt(?string $timestamp): void
    {
        $this->deleted_at = ($timestamp ? Datetime::fromString(VoString::create($timestamp)) : null);
    }

    /**
     * Returns a Datetime representation from the instant the record was marked as deleted.
     *
     * @return Datetime|null
     */
    public function getDeletedAt(): ?Datetime
    {
        return $this->deleted_at;
    }

    /**
     * Returns TRUE if the record is marked as deleted in the system.
     *
     * @return boolean
     */
    public function isDeleted(): bool
    {
        return ($this->deleted_at !== null);
    }
}
