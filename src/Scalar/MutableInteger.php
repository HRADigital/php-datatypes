<?php
namespace Hradigital\Datatypes\Scalar;

/**
 * Mutable Integer's Scalar Object class.
 *
 * Instanciate this class, if you want, or don't care, if the internal instance's value
 * mutates during the instance's life.
 *
 * Any mutator call, will transform the instances internal value. Initial value will no longer be available.
 *
 * All mutator/setter methods in this class, support chaning.
 *
 * @package   Hradigital\Datatypes
 * @copyright Hugo Rafael Azevedo <github@hradigital.com>
 * @author    Hugo Rafael Azevedo <github@hradigital.com>
 * @license   MIT
 * @since     1.0.0
 */
class MutableInteger extends AbstractWriteInteger
{
    /**
     * Creates a new instance of <i>MutableInteger</i> based on a string value.
     *
     * @param  string $number - Number as a string value.
     *
     * @throws \InvalidArgumentException - If supplied argument is empty.
     *
     * @since  1.0.0
     * @return MutableInteger
     */
    public static function fromString(string $number): MutableInteger
    {
        // Valiates supplied parameter.
        if (\strlen(\trim($number)) === 0) {
            throw new \InvalidArgumentException("Supplied string must be a non empty string.");
        }

        return new MutableInteger(
            ((int) $number)
        );
    }

    /**
     * Creates a new instance of <i>MutableInteger</i> based on an integer value.
     *
     * @param  int $number - Number as an integer value.
     *
     * @throws \InvalidArgumentException - If supplied argument is empty.
     *
     * @since  1.0.0
     * @return MutableInteger
     */
    public static function fromInteger(int $number): MutableInteger
    {
        return new MutableInteger($number);
    }

    /**
     * Adds an external value to the instance's internal value.
     *
     * @param AbstractReadInteger $value - Value to add to the instance.
     *
     * @since  1.0.0
     * @return MutableInteger
     */
    public function add(AbstractReadInteger $value): MutableInteger
    {
        $this->value = parent::doAdd($value->value());

        return $this;
    }

    /**
     * Subtracts an external value from the instance's internal value.
     *
     * @param AbstractReadInteger $value - Value to add to the instance.
     *
     * @since  1.0.0
     * @return MutableInteger
     */
    public function subtract(AbstractReadInteger $value): MutableInteger
    {
        $this->value = parent::doSubtract($value->value());

        return $this;
    }

    /**
     * Multiply an external value to the instance's internal value.
     *
     * @param AbstractReadInteger $value - Value to add to the instance.
     *
     * @since  1.0.0
     * @return MutableInteger
     */
    public function multiply(AbstractReadInteger $value): MutableInteger
    {
        $this->value = parent::doMultiply($value->value());

        return $this;
    }

    /**
     * Divides the instance's internal value by an external value.
     *
     * @param AbstractReadInteger $value - Value to add to the instance.
     *
     * @since  1.0.0
     * @return MutableInteger
     */
    public function divide(AbstractReadInteger $value): MutableInteger
    {
        $this->value = parent::doDivide($value->value());

        return $this;
    }

    /**
     * Formats the Integer as a formatted string.
     *
     * @param  \NumberFormatter $formatter - Format that should be used in the returned string.
     *
     * @since  1.0.0
     * @return MutableString
     */
    public function format(\NumberFormatter $formatter): MutableString
    {
        return MutableString::fromString(
            $formatter->format($this->value, \NumberFormatter::TYPE_INT64)
        );
    }

    /**
     * Converts integer's instance to an equivalent string instance.
     *
     * @since  1.0.0
     * @return MutableString
     */
    public function toString(): MutableString
    {
        return MutableString::fromString($this->__toString());
    }

    /**
     * Converts the integer's instance to an Immutable Integer.
     *
     * @since  1.0.0
     * @return ImmutableInteger
     */
    public function toImmutable(): ImmutableInteger
    {
        return ImmutableInteger::fromInteger($this->value);
    }

    /**
     * Converts integer's instance to an equivalent float instance.
     *
     * @since  1.0.0
     * @return MutableFloat
     */
    public function toFloat(): MutableFloat
    {
        return MutableFloat::fromString($this->__toString());
    }
}
