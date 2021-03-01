<?php declare(strict_types=1);

namespace Hradigital\Datatypes\Scalar;

/**
 * Abstract Write String's Scalar Object class.
 *
 * The purpose of this class is to center writing operations for both ImmutableString and
 * MutableString objects, as both perform the same operations, but return different outcomes.
 *
 * This class will perform every writing operation, for internal use only.
 *
 * @package   Hradigital\Datatypes
 * @license   MIT
 */
abstract class AbstractWriteString extends AbstractReadString
{
    /**
     * Trims instance's value, and returns a new instance of the object.
     *
     * @return string
     */
    protected function doTrim(): string
    {
        return \trim($this->value);
    }

    /**
     * Left trims instance's value, and returns a new instance of the object.
     *
     * @return string
     */
    protected function doTrimLeft(): string
    {
        return \ltrim($this->value);
    }

    /**
     * Right trims instance's value, and returns a new instance of the object.
     *
     * @return string
     */
    protected function doTrimRight(): string
    {
        return \rtrim($this->value);
    }

    /**
     * Converts the instance's value to Upper Case, and returns a new instance of the object.
     *
     * @return string
     */
    protected function doToUpper(): string
    {
        return \mb_strtoupper($this->value);
    }

    /**
     * Converts the instance's value first character to Upper Case, and returns a new instance
     * of the object.
     *
     * @return string
     */
    protected function doToUpperFirst(): string
    {
        return \ucfirst($this->value);
    }

    /**
     * Converts the instance's value first character of each word to Upper Case, and returns a new instance
     * of the object.
     *
     * @param  string $delimiters - The optional delimiters contains the word separator characters.
     *
     * @return string
     */
    protected function doToUpperWords(string $delimiters = " \t\r\n\f\v"): string
    {
        return \ucwords($this->value, $delimiters);
    }

    /**
     * Converts the instance's value to Lower Case, and returns a new instance of the object.
     *
     * @return string
     */
    protected function doToLower(): string
    {
        return \mb_strtolower($this->value);
    }

    /**
     * Converts the instance's value first character to Lower Case, and returns a new instance
     * of the object
     *
     * @return string
     */
    protected function doToLowerFirst(): string
    {
        return \lcfirst($this->value);
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
     * @param  int    $length  - Length of the padded value.
     * @param  string $padding - The pad_string may be truncated if the required number of padding characters
     *                             can't be evenly divided by the $padString's length.
     *
     * @throws \InvalidArgumentException - If any of the parameters is invalid.
     * @return string
     */
    protected function doPadLeft(int $length, string $padding = " "): string
    {
        // Validates supplied parameters.
        if ($length < 1) {
            throw new \InvalidArgumentException("Supplied Length must be a positive integer.");
        }
        if (\strlen($padding) === 0) {
            throw new \InvalidArgumentException("Supplied padding must be a non empty string.");
        }

        return \str_pad($this->value, $length, $padding, STR_PAD_LEFT);
    }

    /**
     * This method returns a new instance padded on the LEFT, exactly to the specified padding length.
     *
     * If the optional argument $padding is not supplied, the input is padded with spaces, otherwise
     * it is padded with characters from $padding up to the limit.
     *
     * @param  int    $length  - Length of the padded value.
     * @param  string $padding - The pad_string may be truncated if the required number of padding characters
     *                           can't be evenly divided by the $padding's length.
     *
     * @throws \InvalidArgumentException - If any of the parameters is invalid.
     * @return string
     */
    protected function doPadLeftExtra(int $length, string $padding = " "): string
    {
        // Validates supplied parameters.
        if ($length < 1) {
            throw new \InvalidArgumentException("Supplied Length must be a positive integer.");
        }
        if (\strlen($padding) === 0) {
            throw new \InvalidArgumentException("Supplied padding must be a non empty string.");
        }

        return \str_pad($this->value, ($this->length() + $length), $padding, STR_PAD_LEFT);
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
     * @param  int    $length  - Length of the padded value.
     * @param  string $padding - The pad_string may be truncated if the required number of padding characters
     *                           can't be evenly divided by the $padding's length.
     *
     * @throws \InvalidArgumentException - If any of the parameters is invalid.
     * @return string
     */
    protected function doPadRight(int $length, string $padding = " "): string
    {
        // Validates supplied parameters.
        if ($length < 1) {
            throw new \InvalidArgumentException("Supplied Length must be a positive integer.");
        }
        if (\strlen($padding) === 0) {
            throw new \InvalidArgumentException("Supplied padding must be a non empty string.");
        }

        return \str_pad($this->value, $length, $padding, STR_PAD_RIGHT);
    }

    /**
     * This method returns a new instance padded on the RIGHT, exactly to the specified padding length.
     *
     * If the optional argument $padding is not supplied, the input is padded with spaces, otherwise
     * it is padded with characters from $padding up to the limit.
     *
     * @param  int    $length  - Length of the padded value.
     * @param  string $padding - The pad_string may be truncated if the required number of padding characters
     *                           can't be evenly divided by the $padding's length.
     *
     * @throws \InvalidArgumentException - If any of the parameters is invalid.
     * @return string
     */
    protected function doPadRightExtra(int $length, string $padding = " "): string
    {
        // Validates supplied parameters.
        if ($length < 1) {
            throw new \InvalidArgumentException("Supplied Length must be a positive integer.");
        }
        if (\strlen($padding) === 0) {
            throw new \InvalidArgumentException("Supplied padding must be a non empty string.");
        }

        return \str_pad($this->value, ($this->length() + $length), $padding, STR_PAD_RIGHT);
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
     *
     * @param  int $start  - Start of the sub-string. Can be negative.
     * @param  int $length - Length of the sub-string. Can be negative.
     *
     * @throws \OutOfRangeException - If the $start and/or $length is either too small, or too long.
     * @return string
     */
    protected function doSubString(int $start, int $length = null): string
    {
        // Validates supplied $start and $length.
        $this->validateStartAndLength($start, $length);

        // Processes the substring.
        if ($length !== null) {
            $value = \substr($this->value, $start, $length);
        } else {
            $value = \substr($this->value, $start);
        }

        return ($value ?? '');
    }

    /**
     * This method returns a new instance with a portion of the original instance's value, starting at the beginning
     * of the value, with the number of characters specified in the $length parameter.
     *
     * Same rules as ImmutableString::subString() are applied.
     *
     * @param  int $length - Length of the sub-string. Must be positive.
     *
     * @throws \InvalidArgumentException - If supplied Length is not a positive integer.
     * @return string
     */
    protected function doSubLeft(int $length): string
    {
        // Validates parameter.
        if ($length < 1) {
            throw new \InvalidArgumentException("Supplied length must be a positive integer.");
        }

        return $this->doSubString(0, $length);
    }

    /**
     * This method returns a new instance with a portion of the original instance's value, couting from the end
     * of the value, with the number of characters specified in the $length parameter.
     *
     * Same rules as ImmutableString::subString() are applied.
     *
     * @param  int $length - Length of the sub-string. Must be positive.
     *
     * @throws \InvalidArgumentException - If supplied Length is not a positive integer.
     * @return string
     */
    protected function doSubRight(int $length): string
    {
        // Validates parameter.
        if ($length < 1) {
            throw new \InvalidArgumentException("Supplied length must be a positive integer.");
        }

        return $this->doSubString(0 - $length);
    }

    /**
     * This method returns a new instance with the reversed value of the original instance.
     *
     * @return string
     */
    protected function doReverse(): string
    {
        return \strrev($this->value);
    }

    /**
     * This method replaces a string's occurance by another, and returns a new instance with the new value.
     *
     * @param  string $search  - The string to search for.
     * @param  string $replace - The search's replacement.
     *
     * @throws \InvalidArgumentException - If $search is empty, or count is a not a positive integer.
     * @return string
     */
    protected function doReplace(string $search, string $replace): string
    {
        // Validates supplied parameters.
        if (\strlen($search) === 0) {
            throw new \InvalidArgumentException("Supplied search must be a non empty string.");
        }

        return \str_replace($search, $replace, $this->value);
    }
}
