<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Traits\Entities\General;

use HraDigital\Datatypes\Datetime\Datetime;
use HraDigital\Datatypes\Scalar\VoString;

/**
 * Trait for a Record UpdatedAt attribute.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   Proprietary
 */
trait HasUpdatedAtTrait
{
    /** @var Datetime|null $updated_at - Timestamp representing the instant the record was last updated. */
    protected ?Datetime $updated_at = null;

    /**
     * Mutator method for setting the value into the Attribute
     *
     * @param  string|null $timestamp - Timestamp string representation of the value.
     * @return void
     */
    protected function castUpdatedAt(?string $timestamp): void
    {
        $this->updated_at = ($timestamp ? Datetime::fromString(VoString::create($timestamp)) : null);
    }

    /**
     * Returns a Datetime representation from the instant the record was last updated.
     *
     * @return Datetime|null
     */
    public function getUpdatedAt(): ?Datetime
    {
        return $this->updated_at;
    }
}
