<?php declare(strict_types=1);

namespace Hradigital\Datatypes\Scalar;

/**
 * Abstract String's Scalar Object class.
 *
 * Use this class if you want to write protect your string values.
 * This class only contains accessors, and no mutators.
 *
 * This class is also used as a base, for both ReadOnlyString, MutableString datatype,
 * as well as for ImmutableString.
 *
 * @package   Hradigital\Datatypes
 * @license   MIT
 */
abstract class AbstractReadString
{
    /**
     * @var string $value - Internal string value for the instance.
     */
    protected string $value = '';

    /**
     * Initializes a new instance of a String.
     *
     * @param  string $value - Initial string value.
     * @return void
     */
    protected function __construct(string $value)
    {
        $this->value = $value;
    }

    /**
     * Use this method to copy a child instance to a ReadonlyString instance, or just to clone a
     * ReadonlyString.
     *
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
     * @return string
     */
    public function __toString(): string
    {
        return $this->value;
    }

    /**
     * Compares the values of 2 separate instances.
     *
     * Returns TRUE if the 2 instance's values match. FALSE otherwise.
     *
     * @param  ReadOnlyString $string - Another String instance to compare to.
     *
     * @return bool
     */
    public function equals(ReadOnlyString $string): bool
    {
        return ($this->__toString() === $string->__toString());
    }

    /**
     * Returns the instance's value character length.
     *
     * @return int
     */
    public function length(): int
    {
        return \strlen($this->value);
    }

    /**
     * Searches and returns the index in the instance, of the $search string.
     *
     * If a $start is specified, search will start this number of characters counted from
     * the beginning of the string. If $start is negative, the search will start this number
     * of characters counted from the end of the string.
     *
     * If the $search is not found inthe instance's value, NULL is returned.
     *
     * @param  string $search - String to search for in the instance.
     * @param  int    $start  - Search offset start. Defaults to NULL.
     *
     * @throws \InvalidArgumentException - If $search value is an empty string.
     * @throws \OutOfRangeException      - If the $start is either too small, or too long.
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
     * Checks if the instance contains the supplied $search value.
     *
     * Returns TRUE if found. FALSE otherwise.
     *
     * @param  string $search - Non empty string to search for in the instance.
     *
     * @throws \InvalidArgumentException - If supplied $search is empty.
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
     * Checks if the instance's value starts with the supplied string.
     *
     * @param  string $search - Non empty string to search for in the instance.
     *
     * @throws \InvalidArgumentException - If supplied $search is empty.
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
     * Checks if the instance's value ends with the supplied string.
     *
     * @param  string $search - Non empty string to search for in the instance.
     *
     * @throws \InvalidArgumentException - If supplied $search is empty.
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
     * @param  int|NULL $length - Length value. Can be NULL, in which case, it won't be validated.
     *
     * @throws \InvalidArgumentException - If supplied $search is empty.
     * @throws \OutOfRangeException      - If the $start and/or $length is either too small, or too long.
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
     * Validates a character $length, based on the instance value's length, and supplied $start.
     *
     * @param  int      $start  - The sub-string's offset/start.
     * @param  int|NULL $length - Length value. Can be NULL, in which case, it won't be validated.
     *
     * @throws \OutOfRangeException - If the $start and/or $length is either too small, or too long.
     * @return void
     */
    protected function validateStartAndLength(int $start, ?int $length): void
    {
        // Calculates the absolute values for validations.
        $absStart  = (int) \abs($start);
        $absLength = (int) \abs($length);

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
