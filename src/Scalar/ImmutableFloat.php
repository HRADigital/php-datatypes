<?php
namespace Hradigital\Datatypes\Scalar;

/**
 * Immutable Integer's Scalar Object class.
 *
 * Instanciate this class, if you want the initial instance's value to be preserved, for example, if
 * you're using it as a <i>Value Object</i>, in a DDD project.
 *
 * Method chaning is not supported by any mutators. A new instance will be returned instead.
 *
 * @package   Hradigital\Datatypes
 * @copyright Hugo Rafael Azevedo <github@hradigital.com>
 * @author    Hugo Rafael Azevedo <github@hradigital.com>
 * @license   MIT
 * @since     1.0.0
 */
class ImmutableFloat extends AbstractWriteFloat
{
    /**
     * Creates a new instance of <i>ImmutableFloat</i> based on a string value.
     *
     * @param  string $number - Number as a string value.
     *
     * @throws \InvalidArgumentException - If supplied argument is empty.
     *
     * @since  1.0.0
     * @return ImmutableFloat
     */
    public static function fromString(string $number): ImmutableFloat
    {
        // Valiates supplied parameter.
        if (\strlen(\trim($number)) === 0) {
            throw new \InvalidArgumentException("Supplied string must be a non empty string.");
        }

        return new ImmutableFloat(
            \floatval($number)
        );
    }

    /**
     * Creates a new instance of <i>ImmutableFloat</i> based on a float value.
     *
     * @param  float $number - Number as a float value.
     *
     * @throws \InvalidArgumentException - If supplied argument is empty.
     *
     * @since  1.0.0
     * @return ImmutableFloat
     */
    public static function fromFloat(float $number): ImmutableFloat
    {
        return new ImmutableFloat($number);
    }

    /**
     * Returns instance to a Mutable Float instance.
     *
     * @since  1.0.0
     * @return MutableFloat
     */
    public function toMutable(): MutableFloat
    {
        return MutableFloat::fromFloat($this->value);
    }

    /**
     * Adds an external value to the instance's internal value.
     *
     * @param AbstractReadFloat $value - Value to add to the instance.
     *
     * @since  1.0.0
     * @return ImmutableFloat
     */
    public function add(AbstractReadFloat $value): ImmutableFloat
    {
        return new ImmutableFloat(
            parent::doAdd($value->value())
        );
    }

    /**
     * Subtracts an external value from the instance's internal value.
     *
     * @param AbstractReadFloat $value - Value to subtract from the instance.
     *
     * @since  1.0.0
     * @return ImmutableFloat
     */
    public function subtract(AbstractReadFloat $value): ImmutableFloat
    {
        return new ImmutableFloat(
            parent::doSubtract($value->value())
        );
    }

    /**
     * Multiply an external value to the instance's internal value.
     *
     * @param AbstractReadFloat $value - Value to multiply with the instance.
     *
     * @since  1.0.0
     * @return ImmutableFloat
     */
    public function multiply(AbstractReadFloat $value): ImmutableFloat
    {
        return new ImmutableFloat(
            parent::doMultiply($value->value())
        );
    }

    /**
     * Divides the instance's internal value by an external value.
     *
     * @param AbstractReadFloat $value - Value to divide the instance with.
     *
     * @since  1.0.0
     * @return ImmutableFloat
     */
    public function divide(AbstractReadFloat $value): ImmutableFloat
    {
        return new ImmutableFloat(
            parent::doDivide($value->value())
        );
    }

    /**
     * Formats the Float as a formatted string.
     *
     * @param  \NumberFormatter $formatter - Format that should be used in the returned string.
     *
     * @since  1.0.0
     * @return ImmutableString
     */
    public function format(\NumberFormatter $formatter): ImmutableString
    {
        return ImmutableString::fromString(
            $formatter->format($this->value, \NumberFormatter::TYPE_DOUBLE)
        );
    }

    /**
     * Converts float's instance to an equivalent string instance.
     *
     * @since  1.0.0
     * @return ImmutableString
     */
    public function toString(): ImmutableString
    {
        return ImmutableString::fromString($this->__toString());
    }

    /**
     * Converts float's instance to an equivalent integer instance.
     *
     * @since  1.0.0
     * @return ImmutableInteger
     */
    public function toInteger(): ImmutableInteger
    {
        return ImmutableInteger::fromString($this->__toString());
    }
}
