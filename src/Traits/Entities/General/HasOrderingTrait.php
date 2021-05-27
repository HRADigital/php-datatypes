<?php declare(strict_types=1);

namespace Hradigital\Datatypes\Traits\Entities\General;

use Hradigital\Datatypes\Exceptions\Datatypes\NonNegativeNumberException;

/**
 * Gives record Ordering capabilities to an Entity/Value Object.
 *
 * @package   Hradigital\Datatypes
 * @copyright Hradigital\Datatypes
 * @license   Proprietary
 */
trait HasOrderingTrait
{
    /** @var int $ordering - The ordering of this record, in a parent container. */
    protected int $ordering = 0;

    /**
     * Setter method for the record's order.
     *
     * @param  int $order - New value to be set on Attribute.
     *
     * @throws NonNegativeNumberException - Supplied Order must be a non negative integer.
     * @return void
     */
    protected function castOrdering(int $order): void
    {
        // Validates supplied parameter.
        if ($order < 0) {
            throw new NonNegativeNumberException("Supplied Order must be a non negative integer.");
        }

        // Sets the value in the class.
        $this->ordering = $order;
    }

    /**
     * The ordering of this record, in a parent container's context.
     *
     * @return int
     */
    public function ordering(): int
    {
        return $this->ordering;
    }
}
