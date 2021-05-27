<?php declare(strict_types=1);

namespace Hradigital\Datatypes\Traits\Entities\General;

use Hradigital\Datatypes\Datatypes\Datetime;

/**
 * Trait for a Record UpdatedAt attribute.
 *
 * @package   Hradigital\Datatypes
 * @copyright Hradigital\Datatypes
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
        $this->updated_at = ($timestamp ? Datetime::fromString($timestamp) : null);
    }

    /**
     * Returns a Datetime representation from the instant the record was last updated.
     *
     * @return Datetime|null
     */
    public function updatedAt(): ?Datetime
    {
        return $this->updated_at;
    }
}
