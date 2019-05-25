<?php
namespace Hradigital\Datatypes\Scalar;

/**
 * Read-only Integer's Scalar Object class.
 *
 * Use this class if you want to write protect your integer values.
 * This class only contains accessors, and no mutators.
 *
 * This class is also used as a base, for both the <i>MutableInteger</i> datatype, as well as for
 * <i>ImmutableInteger</i>.
 *
 * @package   Hradigital\Datatypes
 * @copyright Hugo Rafael Azevedo <github@hradigital.com>
 * @author    Hugo Rafael Azevedo <github@hradigital.com>
 * @license   MIT
 * @since     1.0.0
 */
class ReadonlyInteger extends AbstractReadInteger
{
    /**
     * Creates a new instance of <i>ReadonlyInteger</i> based on a string value.
     *
     * @param  string $number - Number as a string value.
     *
     * @throws \InvalidArgumentException - If supplied argument is empty.
     *
     * @since  1.0.0
     * @return ReadonlyInteger
     */
    public static function fromString(string $number): ReadonlyInteger
    {
        // Valiates supplied parameter.
        if (\strlen(\trim($number)) === 0) {
            throw new \InvalidArgumentException("Supplied string must be a non empty string.");
        }

        return new ReadonlyInteger(
            \intval($number)
        );
    }

    /**
     * Creates a new instance of <i>ReadonlyInteger</i> based on a string value.
     *
     * @param  int $number - Number as an integer value.
     *
     * @throws \InvalidArgumentException - If supplied argument is empty.
     *
     * @since  1.0.0
     * @return ReadonlyInteger
     */
    public static function fromInteger(int $number): ReadonlyInteger
    {
        return new ReadonlyInteger($number);
    }

    /**
     * Formats the Integer as a formatted string.
     *
     * @param  \NumberFormatter $formatter - Format that should be used in the returned string.
     *
     * @since  1.0.0
     * @return ReadonlyString
     */
    public function format(\NumberFormatter $formatter): ReadonlyString
    {
        return ReadonlyString::fromString(
            $formatter->format($this->value, \NumberFormatter::TYPE_INT64)
        );
    }

    /**
     * Converts integer's instance to an equivalent string instance.
     *
     * @since  1.0.0
     * @return ReadonlyString
     */
    public function toString(): ReadonlyString
    {
        return ReadonlyString::fromString($this->__toString());
    }

    /**
     * Converts integer's instance to an equivalent float's instance.
     *
     * @since  1.0.0
     * @return ReadonlyFloat
     */
    public function toFloat(): ReadonlyFloat
    {
        return ReadonlyFloat::fromInteger($this->value);
    }

    /**
     * Converts integer's instance to an equivalent boolean instance.
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
