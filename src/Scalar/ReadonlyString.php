<?php
namespace Hradigital\Datatypes\Scalar;

/**
 * Read-only String's Scalar Object class.
 *
 * Use this class if you want to write protect your string values.
 * This class only contains accessors, and no mutators.
 *
 * This class is also used as a base, for both the <i>MutableString</i> datatype, as well as for
 * <i>ImmutableString</i>.
 *
 * @package   Hradigital\Datatypes
 * @copyright Hugo Rafael Azevedo <github@hradigital.com>
 * @author    Hugo Rafael Azevedo <github@hradigital.com>
 * @license   MIT
 * @since     1.0.0
 */
class ReadonlyString extends AbstractReadString
{
    /**
     * Creates a new instance of <i>ReadonlyString</i> based on a string value.
     *
     * @param  string $value - Instance's initial value.
     *
     * @since  1.0.0
     * @return ReadonlyString
     */
    public static function fromString(string $value): ReadonlyString
    {
        return new ReadonlyString($value);
    }
}
