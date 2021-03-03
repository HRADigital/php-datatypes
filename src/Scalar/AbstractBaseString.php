<?php declare(strict_types=1);

namespace Hradigital\Datatypes\Scalar;

/**
 * Abstract Base String's Scalar Object class.
 *
 * This class is used as a base, for both MutableString datatype as well as for ImmutableString.
 *
 * @package   Hradigital\Datatypes
 * @license   MIT
 */
abstract class AbstractBaseString
{
    /** @var string $value - Internal string value for the instance. */
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
     * @param  AbstractBaseString $string - Another String instance to compare to.
     *
     * @return bool
     */
    public function equals(AbstractBaseString $string): bool
    {
        return ($this->__toString() === $string->__toString());
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
     * @param  int    $start  - Search offset start. Defaults to ZERO.
     *
     * @throws \InvalidArgumentException - If $search value is an empty string.
     * @throws \OutOfRangeException      - If the $start is either too small, or too long.
     * @return int|NULL
     */
    public function indexOf(string $search, int $start = 0): ?int
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
    public function count(string $search, int $start = 0, ?int $length = null): int
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
     * @param  int       $start  - The sub-string's offset/start.
     * @param  int|null  $length - Length value. Can be NULL, in which case, it won't be validated.
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

    /**
     * Trims instance's value, and returns a new instance of the object.
     *
     * @param  string  $value - String value to perform the operation on.
     *
     * @return string
     */
    protected function doTrim(string $value): string
    {
        return \trim($value);
    }

    /**
     * Left trims instance's value, and returns a new instance of the object.
     *
     * @param  string  $value - String value to perform the operation on.
     *
     * @return string
     */
    protected function doTrimLeft(string $value): string
    {
        return \ltrim($value);
    }

    /**
     * Right trims instance's value, and returns a new instance of the object.
     *
     * @param  string  $value - String value to perform the operation on.
     *
     * @return string
     */
    protected function doTrimRight(string $value): string
    {
        return \rtrim($value);
    }

    /**
     * Converts the instance's value to Upper Case, and returns a new instance of the object.
     *
     * @param  string  $value - String value to perform the operation on.
     *
     * @return string
     */
    protected function doToUpper(string $value): string
    {
        return \mb_strtoupper($value);
    }

    /**
     * Converts the instance's value first character to Upper Case, and returns a new instance
     * of the object.
     *
     * @param  string  $value - String value to perform the operation on.
     *
     * @return string
     */
    protected function doToUpperFirst(string $value): string
    {
        return \ucfirst($value);
    }

    /**
     * Converts the instance's value first character of each word to Upper Case, and returns a new instance
     * of the object.
     *
     * @param  string  $value - String value to perform the operation on.
     * @param  string  $delimiters - The optional delimiters contains the word separator characters.
     *
     * @return string
     */
    protected function doToUpperWords(string $value, string $delimiters = " \t\r\n\f\v"): string
    {
        return \ucwords($value, $delimiters);
    }

    /**
     * Converts the instance's value to Lower Case, and returns a new instance of the object.
     *
     * @param  string  $value - String value to perform the operation on.
     *
     * @return string
     */
    protected function doToLower(string $value): string
    {
        return \mb_strtolower($value);
    }

    /**
     * Converts the instance's value first character to Lower Case, and returns a new instance
     * of the object
     *
     * @param  string  $value - String value to perform the operation on.
     *
     * @return string
     */
    protected function doToLowerFirst(string $value): string
    {
        return \lcfirst($value);
    }

    /**
     * This method returns a new instance padded on the LEFT to the specified padding length minus
     * the length of the instance's value.
     *
     * Eg:. if the padding length is 12, and the instance's value is only 10 characters long, the value will
     * only be padded by the value of 2.
     *
     * If the optional argument $padString is not supplied, the input is padded with spaces, otherwise
     * it is padded with characters from $padString up to the limit.
     *
     * @param  string  $value   - String value to perform the operation on.
     * @param  int     $length  - Length of the padded value.
     * @param  string  $padding - The pad_string may be truncated if the required number of padding characters
     *                            can't be evenly divided by the $padString's length.
     *
     * @throws \InvalidArgumentException - If any of the parameters is invalid.
     * @return string
     */
    protected function doPadLeft(string $value, int $length, string $padding = " "): string
    {
        // Validates supplied parameters.
        if ($length < 1) {
            throw new \InvalidArgumentException("Supplied Length must be a positive integer.");
        }
        if (\strlen($padding) === 0) {
            throw new \InvalidArgumentException("Supplied padding must be a non empty string.");
        }

        return \str_pad($value, $length, $padding, STR_PAD_LEFT);
    }

    /**
     * This method returns a new instance padded on the LEFT, exactly to the specified padding length.
     *
     * If the optional argument $padding is not supplied, the input is padded with spaces, otherwise
     * it is padded with characters from $padding up to the limit.
     *
     * @param  string  $value   - String value to perform the operation on.
     * @param  int     $length  - Length of the padded value.
     * @param  string  $padding - The pad_string may be truncated if the required number of padding characters
     *                            can't be evenly divided by the $padding's length.
     *
     * @throws \InvalidArgumentException - If any of the parameters is invalid.
     * @return string
     */
    protected function doPadLeftExtra(string $value, int $length, string $padding = " "): string
    {
        // Validates supplied parameters.
        if ($length < 1) {
            throw new \InvalidArgumentException("Supplied Length must be a positive integer.");
        }
        if (\strlen($padding) === 0) {
            throw new \InvalidArgumentException("Supplied padding must be a non empty string.");
        }

        return \str_pad($value, (\strlen($value) + $length), $padding, STR_PAD_LEFT);
    }

    /**
     * This method returns a new instance padded on the RIGHT to the specified padding length minus
     * the length of the instance's value.
     *
     * Eg:. if the padding length is 12, and the instance's value is only 10 characters long, the value will
     * only be padded by the value of 2.
     *
     * If the optional argument $padString is not supplied, the input is padded with spaces, otherwise
     * it is padded with characters from $padding up to the limit.
     *
     * @param  string  $value   - String value to perform the operation on.
     * @param  int     $length  - Length of the padded value.
     * @param  string  $padding - The pad_string may be truncated if the required number of padding characters
     *                            can't be evenly divided by the $padding's length.
     *
     * @throws \InvalidArgumentException - If any of the parameters is invalid.
     * @return string
     */
    protected function doPadRight(string $value, int $length, string $padding = " "): string
    {
        // Validates supplied parameters.
        if ($length < 1) {
            throw new \InvalidArgumentException("Supplied Length must be a positive integer.");
        }
        if (\strlen($padding) === 0) {
            throw new \InvalidArgumentException("Supplied padding must be a non empty string.");
        }

        return \str_pad($value, $length, $padding, STR_PAD_RIGHT);
    }

    /**
     * This method returns a new instance padded on the RIGHT, exactly to the specified padding length.
     *
     * If the optional argument $padding is not supplied, the input is padded with spaces, otherwise
     * it is padded with characters from $padding up to the limit.
     *
     * @param  string  $value   - String value to perform the operation on.
     * @param  int     $length  - Length of the padded value.
     * @param  string  $padding - The pad_string may be truncated if the required number of padding characters
     *                            can't be evenly divided by the $padding's length.
     *
     * @throws \InvalidArgumentException - If any of the parameters is invalid.
     * @return string
     */
    protected function doPadRightExtra(string $value, int $length, string $padding = " "): string
    {
        // Validates supplied parameters.
        if ($length < 1) {
            throw new \InvalidArgumentException("Supplied Length must be a positive integer.");
        }
        if (\strlen($padding) === 0) {
            throw new \InvalidArgumentException("Supplied padding must be a non empty string.");
        }

        return \str_pad($value, (\strlen($value) + $length), $padding, STR_PAD_RIGHT);
    }

    /**
     * This method returns a new instance with a portion of the original instance's value, specified by the
     * $start and $length parameters.
     *
     * $start parameter:
     * - If $start is non-negative, the returned an instance will start at the $start'th position in
     * string, counting from zero. For instance, in the string 'abcdef', the character at position 0 is 'a', the
     * character at position 2 is 'c', and so forth.
     * - If $start is negative, the returned string will start at the $start'th character from the end
     * of string.
     * - If the absolute value of $start is higher than the instance's length, an
     * exception is thrown.
     *
     *
     * $length parameter:
     * - If $length is given and is positive, the string returned will contain at most length characters
     * beginning from $start (depending on the length of string).
     * - If $length is given and is negative, then that many characters will be omitted from the end of string
     * (after the start position has been calculated when a start is negative).
     * - If $length exceeds the remaining number of characters, after the $start calculation, an
     * Exception will be raised.
     *
     * @param  string  $value  - String value to perform the operation on.
     * @param  int     $start  - Start of the sub-string. Can be negative.
     * @param  int     $length - Length of the sub-string. Can be negative.
     *
     * @throws \OutOfRangeException - If the $start and/or $length is either too small, or too long.
     * @return string
     */
    protected function doSubString(string $value, int $start, int $length = null): string
    {
        // Validates supplied $start and $length.
        $this->validateStartAndLength($start, $length);

        // Processes the substring.
        if ($length !== null) {
            $value = \substr($value, $start, $length);
        } else {
            $value = \substr($value, $start);
        }

        return ($value ?? '');
    }

    /**
     * This method returns a new instance with a portion of the original instance's value, starting at the beginning
     * of the value, with the number of characters specified in the $length parameter.
     *
     * Same rules as ImmutableString::subString() are applied.
     *
     * @param  string  $value  - String value to perform the operation on.
     * @param  int     $length - Length of the sub-string. Must be positive.
     *
     * @throws \InvalidArgumentException - If supplied Length is not a positive integer.
     * @return string
     */
    protected function doSubLeft(string $value, int $length): string
    {
        // Validates parameter.
        if ($length < 1) {
            throw new \InvalidArgumentException("Supplied length must be a positive integer.");
        }

        return $this->doSubString($value, 0, $length);
    }

    /**
     * This method returns a new instance with a portion of the original instance's value, couting from the end
     * of the value, with the number of characters specified in the $length parameter.
     *
     * Same rules as ImmutableString::subString() are applied.
     *
     * @param  string  $value  - String value to perform the operation on.
     * @param  int     $length - Length of the sub-string. Must be positive.
     *
     * @throws \InvalidArgumentException - If supplied Length is not a positive integer.
     * @return string
     */
    protected function doSubRight($value, int $length): string
    {
        // Validates parameter.
        if ($length < 1) {
            throw new \InvalidArgumentException("Supplied length must be a positive integer.");
        }

        return $this->doSubString($value, 0 - $length);
    }

    /**
     * This method returns a new instance with the reversed value of the original instance.
     *
     * @param  string  $value  - String value to perform the operation on.
     *
     * @return string
     */
    protected function doReverse(string $value): string
    {
        return \strrev($value);
    }

    /**
     * This method replaces a string's occurance by another, and returns a new instance with the new value.
     *
     * @param  string  $value   - String value to perform the operation on.
     * @param  string  $search  - The string to search for.
     * @param  string  $replace - The search's replacement.
     *
     * @throws \InvalidArgumentException - If $search is empty, or count is a not a positive integer.
     * @return string
     */
    protected function doReplace(string $value, string $search, string $replace): string
    {
        // Validates supplied parameters.
        if (\strlen($search) === 0) {
            throw new \InvalidArgumentException("Supplied search must be a non empty string.");
        }

        return \str_replace($search, $replace, $value);
    }
}
