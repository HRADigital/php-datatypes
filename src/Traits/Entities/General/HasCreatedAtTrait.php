<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Traits\Entities\General;

use HraDigital\Datatypes\Datetime\Datetime;
use HraDigital\Datatypes\Scalar\VoString;

/**
 * Trait for a Record CreatedAt attribute.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   Proprietary
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
        $this->created_at = Datetime::fromString(VoString::create($timestamp));
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
