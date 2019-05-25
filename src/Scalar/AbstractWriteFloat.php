<?php
namespace Hradigital\Datatypes\Scalar;

/**
 * Abstract Write Float's Scalar Object class.
 *
 * Use this class is used as a base for all read-write float-like scalar datatypes.
 *
 * @package   Hradigital\Datatypes
 * @copyright Hugo Rafael Azevedo <github@hradigital.com>
 * @author    Hugo Rafael Azevedo <github@hradigital.com>
 * @license   MIT
 * @since     1.0.0
 */
abstract class AbstractWriteFloat extends AbstractReadFloat
{
    /**
     * Adds an external value to the instance's internal value.
     *
     * @param  float $value - Value to add to the instance.
     *
     * @since  1.0.0
     * @return float
     */
    protected function doAdd(float $value): float
    {
        return ($this->value + $value);
    }

    /**
     * Subtracts an external value from the instance's internal value.
     *
     * @param  float $value - Value to subtract from the instance.
     *
     * @since  1.0.0
     * @return float
     */
    protected function doSubtract(float $value): float
    {
        return ($this->value - $value);
    }

    /**
     * Multiply an external value to the instance's internal value.
     *
     * @param  float $value - Value to multiply to the instance.
     *
     * @since  1.0.0
     * @return float
     */
    protected function doMultiply(float $value): float
    {
        return ($this->value * $value);
    }

    /**
     * Divides the instance's internal value by an external value.
     *
     * @param  float $value - Value used to divide the instance.
     *
     * @since  1.0.0
     * @return float
     */
    protected function doDivide(float $value): float
    {
        return ($this->value / $value);
    }
}
