<?php
namespace Hradigital\Datatypes\Scalar;

/**
 * Read-only Float's Scalar Object class.
 *
 * Use this class if you want to write protect your float values.
 * This class only contains accessors, and no mutators.
 *
 * This class is also used as a base, for both the <i>MutableFloat</i> datatype, as well as for
 * <i>ImmutableFloat</i>.
 *
 * @package   Hradigital\Datatypes
 * @copyright Hugo Rafael Azevedo <github@hradigital.com>
 * @author    Hugo Rafael Azevedo <github@hradigital.com>
 * @license   MIT
 * @since     1.0.0
 */
class ReadonlyFloat extends AbstractReadFloat
{
    /**
     * Creates a new instance of <i>ReadonlyFloat</i> based on a string value.
     *
     * @param  string $number - Number as a string value.
     *
     * @throws \InvalidArgumentException - If supplied argument is empty.
     *
     * @since  1.0.0
     * @return ReadonlyFloat
     */
    public static function fromString(string $number): ReadonlyFloat
    {
        // Valiates supplied parameter.
        if (\strlen(\trim($number)) === 0) {
            throw new \InvalidArgumentException("Supplied string must be a non empty string.");
        }

        return new ReadonlyFloat(
            \floatval($number)
        );
    }

    /**
     * Creates a new instance of <i>ReadonlyFloat</i> based on a string value.
     *
     * @param  int $number - Number as an integer value.
     *
     * @throws \InvalidArgumentException - If supplied argument is empty.
     *
     * @since  1.0.0
     * @return ReadonlyFloat
     */
    public static function fromInteger(int $number): ReadonlyFloat
    {
        return new ReadonlyFloat(
            \floatval($number)
        );
    }

    /**
     * Creates a new instance of <i>ReadonlyFloat</i> based on a string value.
     *
     * @param  float $number - Number as a float value.
     *
     * @throws \InvalidArgumentException - If supplied argument is empty.
     *
     * @since  1.0.0
     * @return ReadonlyFloat
     */
    public static function fromFloat(float $number): ReadonlyFloat
    {
        return new ReadonlyFloat($number);
    }

    /**
     * Formats the Float number as a formatted string.
     *
     * @param  \NumberFormatter $formatter - Format that should be used in the returned string.
     *
     * @since  1.0.0
     * @return ReadonlyString
     */
    public function format(\NumberFormatter $formatter): ReadonlyString
    {
        return new ReadonlyString(
            $formatter->format($this->value, \NumberFormatter::TYPE_DOUBLE)
        );
    }

    /**
     * Converts float's instance to an equivalent string instance.
     *
     * @since  1.0.0
     * @return ReadonlyString
     */
    public function toString(): ReadonlyString
    {
        return new ReadonlyString($this->__toString());
    }

    /**
     * Converts float's instance to an equivalent integer's instance.
     *
     * @since  1.0.0
     * @return ReadonlyInteger
     */
    public function toInteger(): ReadonlyInteger
    {
        return ReadonlyInteger::fromString($this->__toString());
    }

    //public function toBoolean(): ReandonlyBoolean;
}
