<?php
namespace Hradigital\Datatypes\Scalar;

/**
 * Read-only Boolean's Scalar Object class.
 *
 * Use this class if you want to write protect your float values.
 * This class only contains accessors, and no mutators.
 *
 * @package   Hradigital\Datatypes
 * @copyright Hugo Rafael Azevedo <github@hradigital.com>
 * @author    Hugo Rafael Azevedo <github@hradigital.com>
 * @license   MIT
 * @since     1.0.0
 */
class ReadonlyBoolean extends AbstractReadBoolean
{
    /**
     * Creates a new instance of <i>ReadonlyBoolean</i> based on a string value.
     *
     * @param  string $string - Boolean as a string value.
     *
     * @throws \InvalidArgumentException - If supplied argument is empty.
     *
     * @since  1.0.0
     * @return ReadonlyBoolean
     */
    public static function fromString(string $string): ReadonlyBoolean
    {
        // Valiates supplied parameter.
        if (\strlen(\trim($string)) === 0) {
            throw new \InvalidArgumentException("Supplied string must be a non empty string.");
        }

        return new ReadonlyBoolean(
            \in_array(\strtolower($string), ['1', 'true', 'yes'])
        );
    }

    /**
     * Creates a new instance of <i>ReadonlyBoolean</i> based on a string value.
     *
     * @param  int $number - Number as an integer value.
     *
     * @throws \InvalidArgumentException - If supplied argument is empty.
     *
     * @since  1.0.0
     * @return ReadonlyBoolean
     */
    public static function fromInteger(int $number): ReadonlyBoolean
    {
        return new ReadonlyBoolean($number > 0);
    }

    /**
     * Creates a new instance of <i>ReadonlyBoolean</i> based on a string value.
     *
     * @param  float $number - Number as a float value.
     *
     * @throws \InvalidArgumentException - If supplied argument is empty.
     *
     * @since  1.0.0
     * @return ReadonlyBoolean
     */
    public static function fromFloat(float $number): ReadonlyBoolean
    {
        return new ReadonlyBoolean($number > 0);
    }

    /**
     * Converts boolean's instance to an equivalent string instance.
     *
     * @since  1.0.0
     * @return ReadonlyString
     */
    public function toString(): ReadonlyString
    {
        return new ReadonlyString($this->value ? 'True' : 'False');
    }

    /**
     * Converts boolean's instance to an equivalent integer's instance.
     *
     * @since  1.0.0
     * @return ReadonlyInteger
     */
    public function toInteger(): ReadonlyInteger
    {
        return ReadonlyInteger::fromInteger($this->value ? 1 : 0);
    }
}
