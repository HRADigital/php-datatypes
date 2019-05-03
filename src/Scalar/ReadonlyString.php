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
class ReadonlyString
{
    /**
     * @var string $value - Internal string value for the instance.
     */
    protected $value = '';

    /**
     * Initializes a new instance of a <i>String</i>.
     *
     * @param  string $value - Initial string value.
     *
     * @since  1.0.0
     * @return void
     */
    public function __construct(string $value)
    {
        $this->value = $value;
    }

    /**
     * Use this method to copy a child instance to a <i>ReadonlyString</i> instance, or just to clone a
     * <i>ReadonlyString</i>.
     *
     * @since  1.0.0
     * @return ReadonlyString
     */
    public function toReadonly(): ReadonlyString
    {
        return new ReadonlyString(
            $this->value
        );
    }

    /**
     * Magic method that will print out the native string representation of the instance.
     *
     * @since  1.0.0
     * @return string
     */
    public function __toString(): string
    {
        return $this->value;
    }

    /**
     * Compares the values of 2 separate instances.
     *
     * Returns <i>TRUE</i> if the 2 instance's values match. <i>FALSE</i> otherwise.
     *
     * @param  ReadOnlyString $string - Another String instance to compare to.
     *
     * @since  1.0.0
     * @return bool
     */
    public function equals(ReadOnlyString $string): bool
    {
        return ($this->__toString() === $string->__toString());
    }

    /**
     * Returns the instance's value character length.
     *
     * @since  1.0.0
     * @return int
     */
    public function length(): int
    {
        return \strlen($this->value);
    }

    /**
     * Searches and returns the index in the instance, of the <b>$search</b> string.
     *
     * If a <b>$start</b> is specified, search will start this number of characters counted from
     * the beginning of the string. If <b>$start</b> is negative, the search will start this number
     * of characters counted from the end of the string.
     *
     * If the <b>$search</b> is not found inthe instance's value, <b>NULL</b> is returned.
     *
     * @param  string $search - String to search for in the instance.
     * @param  int    $start  - Search offset start. Defaults to <b>NULL</b>.
     *
     * @throws \InvalidArgumentException - If <i>$search</i> value is an empty string.
     * @throws \OutOfRangeException      - If the <i>$start</i> is either too small, or too long.
     *
     * @since  1.0.0
     * @return int|NULL
     */
    public function indexOf(string $search, int $start = null): ?int
    {
        // Validates supplied parameters.
        if (\strlen($search) === 0) {
            throw new \InvalidArgumentException("Supplied search must be a non empty string.");
        }
        if ($start) {
            $this->validateStartAndLength($start, null);
        }

        // Collects the string position.
        $index = \strpos($this->value, $search, $start);

        // If false is returned, no index was found, and therefore NULL is returned.
        if ($index === false) {
            return null;
        }

        return $index;
    }

    /**
     * Checks if the instance contains the supplied <i>$search</i> value.
     *
     * Returns <i>TRUE</i> if found. <i>FALSE</i> otherwise.
     *
     * @param  string $search - Non empty string to search for in the instance.
     *
     * @throws \InvalidArgumentException - If supplied <i>$search</i> is empty.
     *
     * @since  1.0.0
     * @return bool
     */
    public function contains(string $search): bool
    {
        // Validates supplied parameter.
        if (\strlen($search) === 0) {
            throw new \InvalidArgumentException("Supplied search must be a non empty string.");
        }

        return ($this->indexOf($search) !== null);
    }

    /**
     * Checks if the instance's value <b>starts</b> with the supplied string.
     *
     * @param  string $search - Non empty string to search for in the instance.
     *
     * @throws \InvalidArgumentException - If supplied <i>$search</i> is empty.
     *
     * @since  1.0.0
     * @return bool
     */
    public function startsWith(string $search): bool
    {
        // Validates supplied parameter.
        if (\strlen($search) === 0) {
            throw new \InvalidArgumentException("Supplied search must be a non empty string.");
        }

        return ($this->indexOf($search) === 0);
    }

    /**
     * Checks if the instance's value <b>ends</b> with the supplied string.
     *
     * @param  string $search - Non empty string to search for in the instance.
     *
     * @throws \InvalidArgumentException - If supplied <i>$search</i> is empty.
     *
     * @since  1.0.0
     * @return bool
     */
    public function endsWith(string $search): bool
    {
        // Validates supplied parameter.
        if (\strlen($search) === 0) {
            throw new \InvalidArgumentException("Supplied search must be a non empty string.");
        }

        return (\substr($this->value, (0 - \strlen($search))) === $search);
    }

    /**
     * Counts the number of substring occurrences in the instance's value.
     *
     * @param  string   $search - Non empty string to search for in the instance.
     * @param  int      $start  - The sub-string's offset/start.
     * @param  int|NULL $length - Length value. Can be <i>NULL</i>, in which case, it won't be validated.
     *
     * @throws \InvalidArgumentException - If supplied <i>$search</i> is empty.
     * @throws \OutOfRangeException      - If the <i>$start</i> and/or <i>$length</i> is either too small, or too long.
     *
     * @since  1.0.0
     * @return int
     */
    public function count(string $search, int $start = 0, int $length = null): int
    {
        // Validates supplied $search parameter.
        if (\strlen($search) === 0) {
            throw new \InvalidArgumentException("Supplied search must be a non empty string.");
        }

        // Validates supplied $start and $length.
        $this->validateStartAndLength($start, $length);

        // Checks if $length was defined.
        if ($length) {
            return \substr_count($this->value, $search, $start, $length);
        }

        return \substr_count($this->value, $search, $start);
    }

    /**
     * Validates a character <i>$length</i>, based on the instance value's length, and supplied <i>$start</i>.
     *
     * @param  int      $start  - The sub-string's offset/start.
     * @param  int|NULL $length - Length value. Can be <i>NULL</i>, in which case, it won't be validated.
     *
     * @throws \OutOfRangeException - If the <i>$start</i> and/or <i>$length</i> is either too small, or too long.
     *
     * @since  1.0.0
     * @return void
     */
    protected function validateStartAndLength(int $start, ?int $length): void
    {
        // Calculates the absolute values for validations.
        $absStart  = \intval(\abs($start));
        $absLength = \intval(\abs($length));

        // Validates the starting value.
        if ($absStart > $this->length()) {
            throw new \OutOfRangeException(
                "The Start's absolute value must be less than the total number of characters in the string."
            );
        }

        // If supplied $length is NULL, no further validations are required.
        if ($length === null) {
            return;
        }

        // Checks if the supplied $length, doesn't exceed the available number of characters.
        if (($start >= 0 && ($this->length() - $start < $absLength)) ||
            ($start < 0 && $absLength > $absStart)) {

            throw new \OutOfRangeException(
                "The Length's absolute value cannot be higher than the number of available characters."
            );
        }
    }
}
