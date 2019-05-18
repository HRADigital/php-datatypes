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
class ImmutableInteger extends AbstractWriteInteger
{
    /**
     * Creates a new instance of <i>ImmutableInteger</i> based on a string value.
     *
     * @param  string $number - Number as a string value.
     *
     * @throws \InvalidArgumentException - If supplied argument is empty.
     *
     * @since  1.0.0
     * @return ImmutableInteger
     */
    public static function fromString(string $number): ImmutableInteger
    {
        // Valiates supplied parameter.
        if (\strlen(\trim($number)) === 0) {
            throw new \InvalidArgumentException("Supplied string must be a non empty string.");
        }

        return new ImmutableInteger(
            \intval($number)
        );
    }

    /**
     * Creates a new instance of <i>ImmutableInteger</i> based on an integer value.
     *
     * @param  int $number - Number as an integer value.
     *
     * @throws \InvalidArgumentException - If supplied argument is empty.
     *
     * @since  1.0.0
     * @return ImmutableInteger
     */
    public static function fromInteger(int $number): ImmutableInteger
    {
        return new ImmutableInteger($number);
    }

    /**
     * Converts instance to a Mutable Integer instance.
     *
     * @since  1.0.0
     * @return MutableInteger
     */
    public function toMutable(): MutableInteger
    {
        return new MutableInteger($this->value);
    }

    /**
     * Adds an external value to the instance's internal value.
     *
     * @param AbstractReadInteger $value - Value to add to the instance.
     *
     * @since  1.0.0
     * @return ImmutableInteger
     */
    public function add(AbstractReadInteger $value): ImmutableInteger
    {
        return new ImmutableInteger(
            parent::doAdd($value->value())
        );
    }

    /**
     * Subtracts an external value from the instance's internal value.
     *
     * @param AbstractReadInteger $value - Value to subtract from the instance.
     *
     * @since  1.0.0
     * @return ImmutableInteger
     */
    public function subtract(AbstractReadInteger $value): ImmutableInteger
    {
        return new ImmutableInteger(
            parent::doSubtract($value->value())
        );
    }

    /**
     * Multiply an external value to the instance's internal value.
     *
     * @param AbstractReadInteger $value - Value to multiply with the instance.
     *
     * @since  1.0.0
     * @return ImmutableInteger
     */
    public function multiply(AbstractReadInteger $value): ImmutableInteger
    {
        return new ImmutableInteger(
            parent::doMultiply($value->value())
        );
    }

    /**
     * Divides the instance's internal value by an external value.
     *
     * @param AbstractReadInteger $value - Value to divide with the instance.
     *
     * @since  1.0.0
     * @return ImmutableInteger
     */
    public function divide(AbstractReadInteger $value): ImmutableInteger
    {
        return new ImmutableInteger(
            parent::doDivide($value->value())
        );
    }

    /**
     * Formats the Integer as a formatted string.
     *
     * @param  \NumberFormatter $formatter - Format that should be used in the returned string.
     *
     * @since  1.0.0
     * @return ImmutableString
     */
    public function format(\NumberFormatter $formatter): ImmutableString
    {
        return new ImmutableString(
            $formatter->format($this->value, \NumberFormatter::TYPE_INT64)
        );
    }

    /**
     * Converts integer's instance to an equivalent string instance.
     *
     * @since  1.0.0
     * @return ImmutableString
     */
    public function toString(): ImmutableString
    {
        return new ImmutableString($this->__toString());
    }

    /**
     * Converts integer's instance to an equivalent float instance.
     *
     * @since  1.0.0
     * @return ImmutableFloat
     */
    public function toFloat(): ImmutableFloat
    {
        return ImmutableFloat::fromString($this->__toString());
    }
    //public function toBoolean(): ImmutableBoolean;
}
