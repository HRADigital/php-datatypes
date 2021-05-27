<?php declare(strict_types=1);

namespace Hradigital\Datatypes\Traits\Entities\General;

use Hradigital\Datatypes\Datatypes\Datetime;

/**
 * Trait for a Record CreatedAt attribute.
 *
 * @package   Hradigital\Datatypes
 * @copyright Hradigital\Datatypes
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
        $this->created_at = Datetime::fromString($timestamp);
    }

    /**
     * Returns a Datetime representation from the instant the record was last updated.
     *
     * @return Datetime
     */
    public function createdAt(): Datetime
    {
        return $this->created_at;
    }
}
