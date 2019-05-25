<?php
namespace Hradigital\Datatypes\Scalar;

/**
 * Abstract Write Integer's Scalar Object class.
 *
 * Use this class is used as a base for all read-write integer-like scalar datatypes.
 *
 * @package   Hradigital\Datatypes
 * @copyright Hugo Rafael Azevedo <github@hradigital.com>
 * @author    Hugo Rafael Azevedo <github@hradigital.com>
 * @license   MIT
 * @since     1.0.0
 */
abstract class AbstractWriteInteger extends AbstractReadInteger
{
    /**
     * Adds an external value to the instance's internal value.
     *
     * @param  int $value - Value to add to the instance.
     *
     * @since  1.0.0
     * @return int
     */
    protected function doAdd(int $value): int
    {
        return ($this->value + $value);
    }

    /**
     * Subtracts an external value from the instance's internal value.
     *
     * @param  int $value - Value to subtract from the instance.
     *
     * @since  1.0.0
     * @return int
     */
    protected function doSubtract(int $value): int
    {
        return ($this->value - $value);
    }

    /**
     * Multiply an external value to the instance's internal value.
     *
     * @param  int $value - Value to multiply to the instance.
     *
     * @since  1.0.0
     * @return int
     */
    protected function doMultiply(int $value): int
    {
        return ($this->value * $value);
    }

    /**
     * Divides the instance's internal value by an external value.
     *
     * @param  int $value - Value used to divide the instance.
     *
     * @since  1.0.0
     * @return int
     */
    protected function doDivide(int $value): int
    {
        return \intval($this->value / $value);
    }

    /**
     * Converts float's instance to an equivalent boolean instance.
     *
     * A <i>ReadonlyBoolean</i> will be returned, as Booleans don't require Immutable and Mutable
     * distinctions.
     *
     * @since  1.0.0
     * @return ReadonlyBoolean
     */
    public function toBoolean(): ReadonlyBoolean
    {
        return ReadonlyBoolean::fromInteger($this->value);
    }
}
