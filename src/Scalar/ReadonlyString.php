<?php declare(strict_types=1);

namespace Hradigital\Datatypes\Scalar;

/**
 * Read-only String's Scalar Object class.
 *
 * Use this class if you want to write protect your string values.
 * This class only contains accessors, and no mutators.
 *
 * This class is also used as a base, for both the MutableString datatype, as well as for
 * ImmutableString.
 *
 * @package   Hradigital\Datatypes
 * @license   MIT
 */
class ReadonlyString extends AbstractReadString
{
    /**
     * Creates a new instance of ReadonlyString based on a string value.
     *
     * @param  string $value - Instance's initial value.
     *
     * @return ReadonlyString
     */
    public static function fromString(string $value): ReadonlyString
    {
        return new ReadonlyString($value);
    }
}
