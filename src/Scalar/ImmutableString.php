<?php
namespace Hradigital\Datatypes\Scalar;

/**
 * Immutable String's Scalar Object class.
 *
 * Instanciate this class, if you want the initial instance's value to be preserved, for example, if
 * you're using it as a <i>Value Object</i>, in a DDD project.
 *
 * Method chaning is not supported by any mutators. A new instance will be returned instead.
 *
 * @package   Hradigital\Datatypes
 * @copyright Hugo Rafael Azevedo <github@hradigital.com>
 * @author    Hugo Rafael Azevedo <github@hradigital.com>
 * @license   MIT
 * @since     1.0.0
 */
class ImmutableString extends ReadonlyString
{
    /**
     * Clones this <i>ImmutableString</i> instance, into a <i>MutableString</i> one.
     *
     * @since  1.0.0
     * @return MutableString
     */
    public function toMutable(): MutableString
    {
        return new MutableString(
            $this->value
        );
    }

    /**
     * Trims instance's value, and returns a new instance of the object.
     *
     * @since  1.0.0
     * @return ImmutableString
     */
    public function trim(): ImmutableString
    {
        return new ImmutableString(
            \trim($this->value)
        );
    }

    /**
     * Left trims instance's value, and returns a new instance of the object.
     *
     * @since  1.0.0
     * @return ImmutableString
     */
    public function trimLeft(): ImmutableString
    {
        return new ImmutableString(
            \ltrim($this->value)
        );
    }

    /**
     * Right trims instance's value, and returns a new instance of the object.
     *
     * @since  1.0.0
     * @return ImmutableString
     */
    public function trimRight(): ImmutableString
    {
        return new ImmutableString(
            \rtrim($this->value)
        );
    }

    /**
     * Converts the instance's value to <b>Upper Case</b>, and returns a new instance of the object.
     *
     * @since  1.0.0
     * @return ImmutableString
     */
    public function toUpper(): ImmutableString
    {
        return new ImmutableString(
            \mb_strtoupper($this->value)
        );
    }

    /**
     * Converts the instance's value first character to <b>Upper Case</b>, and returns a new instance
     * of the object.
     *
     * @since  1.0.0
     * @return ImmutableString
     */
    public function toUpperFirst(): ImmutableString
    {
        return new ImmutableString(
            \ucfirst($this->value)
        );
    }

    /**
     * Converts the instance's value first character of each word to <b>Upper Case</b>, and returns a new instance
     * of the object.
     *
     * @param  string $delimiters - The optional delimiters contains the word separator characters.
     *
     * @since  1.0.0
     * @return ImmutableString
     */
    public function toUpperWords(string $delimiters = " \t\r\n\f\v"): ImmutableString
    {
        return new ImmutableString(
            \ucwords($this->value, $delimiters)
        );
    }

    /**
     * Converts the instance's value to <b>Lower Case</b>, and returns a new instance of the object.
     *
     * @since  1.0.0
     * @return ImmutableString
     */
    public function toLower(): ImmutableString
    {
        return new ImmutableString(
            \mb_strtolower($this->value)
        );
    }

    /**
     * Converts the instance's value first character to <b>Lower Case</b>, and returns a new instance
     * of the object
     *
     * @since  1.0.0
     * @return ImmutableString
     */
    public function toLowerFirst(): ImmutableString
    {
        return new ImmutableString(
            \lcfirst($this->value)
        );
    }

    /**
     * This method returns a new instance padded on the <b>left</b> to the specified padding length.
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
     * @return ImmutableString
     */
    public function padLeft(int $length, string $padString = " "): ImmutableString
    {
        // Validates supplied parameters.
        if ($length < 1) {
            throw new \InvalidArgumentException("Supplied Length must be a positive integer.");
        }
        if (\strlen($padString) === 0) {
            throw new \InvalidArgumentException("Supplied padding must be a non empty string.");
        }

        return new ImmutableString(
            \str_pad($this->value, ($this->length() + $length), $padString, STR_PAD_LEFT)
        );
    }

    /**
     * This method returns a new instance padded on the <b>right</b> to the specified padding length.
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
     * @return ImmutableString
     */
    public function padRight(int $length, string $padString = " "): ImmutableString
    {
        // Validates supplied parameters.
        if ($length < 1) {
            throw new \InvalidArgumentException("Supplied Length must be a positive integer.");
        }
        if (\strlen($padString) === 0) {
            throw new \InvalidArgumentException("Supplied padding must be a non empty string.");
        }

        return new ImmutableString(
            \str_pad($this->value, ($this->length() + $length), $padString, STR_PAD_RIGHT)
        );
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
     * @return ImmutableString
     */
    public function subString(int $start, int $length = null): ImmutableString
    {
        // Validates supplied $start and $length.
        $this->validateStartAndLength($start, $length);

        // Processes the substring.
        if ($length !== null) {
            $value = \substr($this->value, $start, $length);
        } else {
            $value = \substr($this->value, $start);
        }

        return new ImmutableString($value ?? '');
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
     * @return ImmutableString
     */
    public function subLeft(int $length): ImmutableString
    {
        // Validates parameter.
        if ($length < 1) {
            throw new \InvalidArgumentException("Supplied length must be a positive integer.");
        }

        return $this->subString(0, $length);
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
     * @return ImmutableString
     */
    public function subRight(int $length): ImmutableString
    {
        // Validates parameter.
        if ($length < 1) {
            throw new \InvalidArgumentException("Supplied length must be a positive integer.");
        }

        return $this->subString(0 - $length);
    }

    /**
     * This method returns a new instance with the reversed value of the original instance.
     *
     * @since  1.0.0
     * @return ImmutableString
     */
    public function reverse(): ImmutableString
    {
        return new ImmutableString(
            \strrev($this->value)
        );
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
     * @return ImmutableString
     */
    public function replace(string $search, string $replace): ImmutableString
    {
        // Validates supplied parameters.
        if (\strlen($search) === 0) {
            throw new \InvalidArgumentException("Supplied search must be a non empty string.");
        }

        return new ImmutableString(
            \str_replace($search, $replace, $this->value)
        );
    }
}
