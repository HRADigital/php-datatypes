<?php
namespace Hradigital\Datatypes\Scalar;

/**
 * Mutable Float's Scalar Object class.
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
class MutableFloat extends AbstractWriteFloat
{
    /**
     * Creates a new instance of <i>MutableFloat</i> based on a string value.
     *
     * @param  string $number - Number as a string value.
     *
     * @throws \InvalidArgumentException - If supplied argument is empty.
     *
     * @since  1.0.0
     * @return MutableFloat
     */
    public static function fromString(string $number): MutableFloat
    {
        // Valiates supplied parameter.
        if (\strlen(\trim($number)) === 0) {
            throw new \InvalidArgumentException("Supplied string must be a non empty string.");
        }

        return new MutableFloat(
            \floatval($number)
        );
    }

    /**
     * Creates a new instance of <i>MutableFloat</i> based on a float value.
     *
     * @param  float $number - Number as a float value.
     *
     * @throws \InvalidArgumentException - If supplied argument is empty.
     *
     * @since  1.0.0
     * @return MutableInteger
     */
    public static function fromFloat(float $number): MutableFloat
    {
        return new MutableFloat($number);
    }

    /**
     * Returns instance to an Immutable Float instance.
     *
     * @since  1.0.0
     * @return ImmutableFloat
     */
    public function toImmutable(): ImmutableFloat
    {
        return ImmutableFloat::fromFloat($this->value);
    }

    /**
     * Adds an external value to the instance's internal value.
     *
     * @param AbstractReadFloat $value - Value to add to the instance.
     *
     * @since  1.0.0
     * @return MutableFloat
     */
    public function add(AbstractReadFloat $value): MutableFloat
    {
        $this->value = parent::doAdd($value->value());

        return $this;
    }

    /**
     * Subtracts an external value from the instance's internal value.
     *
     * @param AbstractReadFloat $value - Value to add to the instance.
     *
     * @since  1.0.0
     * @return MutableFloat
     */
    public function subtract(AbstractReadFloat $value): MutableFloat
    {
        $this->value = parent::doSubtract($value->value());

        return $this;
    }

    /**
     * Multiply an external value to the instance's internal value.
     *
     * @param AbstractReadFloat $value - Value to add to the instance.
     *
     * @since  1.0.0
     * @return MutableFloat
     */
    public function multiply(AbstractReadFloat $value): MutableFloat
    {
        $this->value = parent::doMultiply($value->value());

        return $this;
    }

    /**
     * Divides the instance's internal value by an external value.
     *
     * @param AbstractReadFloat $value - Value to add to the instance.
     *
     * @since  1.0.0
     * @return MutableFloat
     */
    public function divide(AbstractReadFloat $value): MutableFloat
    {
        $this->value = parent::doDivide($value->value());

        return $this;
    }

    /**
     * Formats the Float as a formatted string.
     *
     * @param  \NumberFormatter $formatter - Format that should be used in the returned string.
     *
     * @since  1.0.0
     * @return MutableString
     */
    public function format(\NumberFormatter $formatter): MutableString
    {
        return new MutableString(
            $formatter->format($this->value, \NumberFormatter::TYPE_DOUBLE)
        );
    }

    /**
     * Converts Float's instance to an equivalent string instance.
     *
     * @since  1.0.0
     * @return MutableString
     */
    public function toString(): MutableString
    {
        return new MutableString($this->__toString());
    }

    /**
     * Converts Float's instance to an equivalent integer instance.
     *
     * @since  1.0.0
     * @return MutableInteger
     */
    public function toInteger(): MutableInteger
    {
        return MutableInteger::fromString($this->__toString());
    }
    //public function toBoolean(): MutableBoolean;
}
