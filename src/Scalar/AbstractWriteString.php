<?php
namespace Hradigital\Datatypes\Scalar;

/**
 * Abstract Write String's Scalar Object class.
 *
 * The purpose of this class is to center writing operations for both <i>ImmutableString</i> and
 * <I>MutableString</i> objects, as both perform the same operations, but return different outcomes.
 *
 * This class will perform every writing operation, <b>for internal use only</b>.
 *
 * @package   Hradigital\Datatypes
 * @copyright Hugo Rafael Azevedo <github@hradigital.com>
 * @author    Hugo Rafael Azevedo <github@hradigital.com>
 * @license   MIT
 * @since     1.0.0
 */
abstract class AbstractWriteString extends AbstractReadString
{
    /**
     * Trims instance's value, and returns a new instance of the object.
     *
     * @since  1.0.0
     * @return string
     */
    protected function doTrim(): string
    {
        return \trim($this->value);
    }

    /**
     * Left trims instance's value, and returns a new instance of the object.
     *
     * @since  1.0.0
     * @return string
     */
    protected function doTrimLeft(): string
    {
        return \ltrim($this->value);
    }

    /**
     * Right trims instance's value, and returns a new instance of the object.
     *
     * @since  1.0.0
     * @return string
     */
    protected function doTrimRight(): string
    {
        return \rtrim($this->value);
    }

    /**
     * Converts the instance's value to <b>Upper Case</b>, and returns a new instance of the object.
     *
     * @since  1.0.0
     * @return string
     */
    protected function doToUpper(): string
    {
        return \mb_strtoupper($this->value);
    }

    /**
     * Converts the instance's value first character to <b>Upper Case</b>, and returns a new instance
     * of the object.
     *
     * @since  1.0.0
     * @return string
     */
    protected function doToUpperFirst(): string
    {
        return \ucfirst($this->value);
    }

    /**
     * Converts the instance's value first character of each word to <b>Upper Case</b>, and returns a new instance
     * of the object.
     *
     * @param  string $delimiters - The optional delimiters contains the word separator characters.
     *
     * @since  1.0.0
     * @return string
     */
    protected function doToUpperWords(string $delimiters = " \t\r\n\f\v"): string
    {
        return \ucwords($this->value, $delimiters);
    }

    /**
     * Converts the instance's value to <b>Lower Case</b>, and returns a new instance of the object.
     *
     * @since  1.0.0
     * @return string
     */
    protected function doToLower(): string
    {
        return \mb_strtolower($this->value);
    }

    /**
     * Converts the instance's value first character to <b>Lower Case</b>, and returns a new instance
     * of the object
     *
     * @since  1.0.0
     * @return string
     */
    protected function doToLowerFirst(): string
    {
        return \lcfirst($this->value);
    }

    /**
     * This method returns a new instance padded on the <b>left</b> to the specified padding length minus
     * the length of the instance's value.
     *
     * Eg:. if the padding length is 12, and the instance's value is only 10 characters long, the value will
     * only be padded by the value of 2.
     *
     * If the optional argument <i>$padString</i> is not supplied, the input is padded with spaces, otherwise
     * it is padded with characters from <i>$padString</i> up to the limit.
     *
     * @param  int    $length    - Length of the padded value.
     * @param  string $padString - The pad_string may be truncated if the required number of padding characters
     *                             can't be evenly divided by the <i>$padString</i>'s length.
     *
     * @throws \InvalidArgumentException - If any of the parameters is invalid.
     *
     * @since  1.0.0
     * @return string
     */
    protected function doPadLeft(int $length, string $padString = " "): string
    {
        // Validates supplied parameters.
        if ($length < 1) {
            throw new \InvalidArgumentException("Supplied Length must be a positive integer.");
        }
        if (\strlen($padString) === 0) {
            throw new \InvalidArgumentException("Supplied padding must be a non empty string.");
        }

        return \str_pad($this->value, $length, $padString, STR_PAD_LEFT);
    }

    /**
     * This method returns a new instance padded on the <b>left</b>, <b>exactly to the specified padding length</b>.
     *
     * If the optional argument <i>$padString</i> is not supplied, the input is padded with spaces, otherwise
     * it is padded with characters from <i>$padString</i> up to the limit.
     *
     * @param  int    $length    - Length of the padded value.
     * @param  string $padString - The pad_string may be truncated if the required number of padding characters
     *                             can't be evenly divided by the <i>$padString</i>'s length.
     *
     * @throws \InvalidArgumentException - If any of the parameters is invalid.
     *
     * @since  1.0.0
     * @return string
     */
    protected function doPadLeftExtra(int $length, string $padString = " "): string
    {
        // Validates supplied parameters.
        if ($length < 1) {
            throw new \InvalidArgumentException("Supplied Length must be a positive integer.");
        }
        if (\strlen($padString) === 0) {
            throw new \InvalidArgumentException("Supplied padding must be a non empty string.");
        }

        return \str_pad($this->value, ($this->length() + $length), $padString, STR_PAD_LEFT);
    }

    /**
     * This method returns a new instance padded on the <b>right</b> to the specified padding length minus
     * the length of the instance's value.
     *
     * Eg:. if the padding length is 12, and the instance's value is only 10 characters long, the value will
     * only be padded by the value of 2.
     *
     * If the optional argument <i>$padString</i> is not supplied, the input is padded with spaces, otherwise
     * it is padded with characters from <i>$padString</i> up to the limit.
     *
     * @param  int    $length    - Length of the padded value.
     * @param  string $padString - The pad_string may be truncated if the required number of padding characters
     *                             can't be evenly divided by the <i>$padString</i>'s length.
     *
     * @throws \InvalidArgumentException - If any of the parameters is invalid.
     *
     * @since  1.0.0
     * @return string
     */
    protected function doPadRight(int $length, string $padString = " "): string
    {
        // Validates supplied parameters.
        if ($length < 1) {
            throw new \InvalidArgumentException("Supplied Length must be a positive integer.");
        }
        if (\strlen($padString) === 0) {
            throw new \InvalidArgumentException("Supplied padding must be a non empty string.");
        }

        return \str_pad($this->value, $length, $padString, STR_PAD_RIGHT);
    }

    /**
     * This method returns a new instance padded on the <b>right</b>, <b>exactly to the specified padding length</b>.
     *
     * If the optional argument <i>$padString</i> is not supplied, the input is padded with spaces, otherwise
     * it is padded with characters from <i>$padString</i> up to the limit.
     *
     * @param  int    $length    - Length of the padded value.
     * @param  string $padString - The pad_string may be truncated if the required number of padding characters
     *                             can't be evenly divided by the <i>$padString</i>'s length.
     *
     * @throws \InvalidArgumentException - If any of the parameters is invalid.
     *
     * @since  1.0.0
     * @return string
     */
    protected function doPadRightExtra(int $length, string $padString = " "): string
    {
        // Validates supplied parameters.
        if ($length < 1) {
            throw new \InvalidArgumentException("Supplied Length must be a positive integer.");
        }
        if (\strlen($padString) === 0) {
            throw new \InvalidArgumentException("Supplied padding must be a non empty string.");
        }

        return \str_pad($this->value, ($this->length() + $length), $padString, STR_PAD_RIGHT);
    }

    /**
     * This method returns a new instance with a portion of the original instance's value, specified by the
     * <i>$start</i> and <i>$length</i> parameters.
     *
     * <b>$start</b> parameter:
     * <ul>
     * <li>If <i>$start</i> is non-negative, the returned an instance will start at the <i>$start</i>'th position in
     * string, counting from zero. For instance, in the string 'abcdef', the character at position 0 is 'a', the
     * character at position 2 is 'c', and so forth.</li>
     * <li>If <i>$start</i> is negative, the returned string will start at the <i>$start</i>'th character from the end
     * of string.</li>
     * <li>If the <b>absolute value</b> of <i>$start</i> is <b>higher</b> than the instance's <b>length</b>, an
     * <b>exception is thrown</b>.</li>
     * </ul>
     *
     * <b>$length</b> parameter:
     * <ul>
     * <li>If <i>$length</i> is given and is positive, the string returned will contain at most length characters
     * beginning from <i>$start</i> (depending on the length of string).</li>
     * <li>If <i>$length</i> is given and is negative, then that many characters will be omitted from the end of string
     * (after the start position has been calculated when a start is negative).</li>
     * <li>If <i>$length</i> <b>exceeds the remaining number of characters</b>, after the <i>$start</i> calculation, an
     * <b>Exception will be raised</b>.</li>
     * </ul>
     *
     * @param  int $start  - Start of the sub-string. Can be negative.
     * @param  int $length - Length of the sub-string. Can be negative.
     *
     * @throws \OutOfRangeException - If the <i>$start</i> and/or <i>$length</i> is either too small, or too long.
     *
     * @since  1.0.0
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
     * of the value, with the number of characters specified in the <i>$length</i> parameter.
     *
     * Same rules as <i>ImmutableString::subString()</i> are applied.
     *
     * @param  int $length - Length of the sub-string. Must be positive.
     *
     * @throws \InvalidArgumentException - If supplied Length is not a positive integer.
     *
     * @since  1.0.0
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
     * of the value, with the number of characters specified in the <i>$length</i> parameter.
     *
     * Same rules as <i>ImmutableString::subString()</i> are applied.
     *
     * @param  int $length - Length of the sub-string. Must be positive.
     *
     * @throws \InvalidArgumentException - If supplied Length is not a positive integer.
     *
     * @since  1.0.0
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
     * @since  1.0.0
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
     *
     * @since  1.0.0
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
