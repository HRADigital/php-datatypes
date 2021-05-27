<?php declare(strict_types=1);

namespace Hradigital\Datatypes\Scalar;

/**
 * Immutable String's Scalar Object class.
 *
 * Instanciate this class, if you want the initial instance's value to be preserved.
 *
 * Fluent interface (chaning) is not supported by any mutators.
 * A new instance will be returned instead.
 *
 * @package   Hradigital\Datatypes
 * @license   MIT
 */
class IString extends AbstractBaseString
{
    /**
     * Creates a new instance of IString based on a string value.
     *
     * @param  string $value - Instance's initial value.
     * @return IString
     */
    public static function create(string $value): IString
    {
        return new IString($value);
    }

    /**
     * Trims instance's value, and returns a new instance of the object.
     *
     * @return IString
     */
    public function trim(): IString
    {
        return new IString(
            parent::doTrim($this->value)
        );
    }

    /**
     * Left trims instance's value, and returns a new instance of the object.
     *
     * @return IString
     */
    public function trimLeft(): IString
    {
        return new IString(
            parent::doTrimLeft($this->value)
        );
    }

    /**
     * Right trims instance's value, and returns a new instance of the object.
     *
     * @return IString
     */
    public function trimRight(): IString
    {
        return new IString(
            parent::doTrimRight($this->value)
        );
    }

    /**
     * Converts the instance's value to Upper Case, and returns a new instance of the object.
     *
     * @return IString
     */
    public function toUpper(): IString
    {
        return new IString(
            parent::doToUpper($this->value)
        );
    }

    /**
     * Converts the instance's value first character to Upper Case, and returns a new instance
     * of the object.
     *
     * @return IString
     */
    public function toUpperFirst(): IString
    {
        return new IString(
            parent::doToUpperFirst($this->value)
        );
    }

    /**
     * Converts the instance's value first character of each word to Upper Case, and returns a new instance
     * of the object.
     *
     * @param  string $delimiters - The optional delimiters contains the word separator characters.
     *
     * @return IString
     */
    public function toUpperWords(string $delimiters = " \t\r\n\f\v"): IString
    {
        return new IString(
            parent::doToUpperWords($this->value, $delimiters)
        );
    }

    /**
     * Converts the instance's value to Lower Case, and returns a new instance of the object.
     *
     * @return IString
     */
    public function toLower(): IString
    {
        return new IString(
            parent::doToLower($this->value)
        );
    }

    /**
     * Converts the instance's value first character to Lower Case, and returns a new instance
     * of the object
     *
     * @return IString
     */
    public function toLowerFirst(): IString
    {
        return new IString(
            parent::doToLowerFirst($this->value)
        );
    }

    /**
     * This method returns a new instance padded on the left to the specified padding length minus
     * the length of the instance's value.
     *
     * Eg:. if the padding length is 12, and the instance's value is only 10 characters long, the value will
     * only be padded by the value of 2.
     *
     * If the optional argument $padding is not supplied, the input is padded with spaces, otherwise
     * it is padded with characters from $padding up to the limit.
     *
     * @throws \InvalidArgumentException - If any of the parameters is invalid.
     * @return IString
     */
    public function padLeft(int $length, string $padding = " "): IString
    {
        return new IString(
            parent::doPadLeft($this->value, $length, $padding)
        );
    }

    /**
     * This method returns a new instance padded on the left, exactly to the specified padding length.
     *
     * If the optional argument $padding is not supplied, the input is padded with spaces, otherwise
     * it is padded with characters from $padding up to the limit.
     *
     * @param  int    $length  - Length of the padded value.
     * @param  string $padding - The pad_string may be truncated if the required number of padding characters
     *                           can't be evenly divided by the $padding's length.
     *
     * @throws \InvalidArgumentException - If any of the parameters is invalid.
     * @return IString
     */
    public function padLeftExtra(int $length, string $padding = " "): IString
    {
        return new IString(
            parent::doPadLeftExtra($this->value, $length, $padding)
        );
    }

    /**
     * This method returns a new instance padded on the right to the specified padding length minus
     * the length of the instance's value.
     *
     * Eg:. if the padding length is 12, and the instance's value is only 10 characters long, the value will
     * only be padded by the value of 2.
     *
     * If the optional argument $padding is not supplied, the input is padded with spaces, otherwise
     * it is padded with characters from $padding up to the limit.
     *
     * @param  int    $length  - Length of the padded value.
     * @param  string $padding - The pad_string may be truncated if the required number of padding characters
     *                           can't be evenly divided by the $padding's length.
     *
     * @throws \InvalidArgumentException - If any of the parameters is invalid.
     * @return IString
     */
    public function padRight(int $length, string $padding = " "): IString
    {
        return new IString(
            parent::doPadRight($this->value, $length, $padding)
        );
    }

    /**
     * This method returns a new instance padded on the right, exactly to the specified padding length.
     *
     * If the optional argument $padding is not supplied, the input is padded with spaces, otherwise
     * it is padded with characters from $padding up to the limit.
     *
     * @param  int    $length  - Length of the padded value.
     * @param  string $padding - The pad_string may be truncated if the required number of padding characters
     *                           can't be evenly divided by the $padding's length.
     *
     * @throws \InvalidArgumentException - If any of the parameters is invalid.
     * @return IString
     */
    public function padRightExtra(int $length, string $padding = " "): IString
    {
        return new IString(
            parent::doPadRightExtra($this->value, $length, $padding)
        );
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
     * @param  int $start  - Start of the sub-string. Can be negative.
     * @param  int $length - Length of the sub-string. Can be negative.
     *
     * @throws \OutOfRangeException - If the $start and/or $length is either too small, or too long.
     * @return IString
     */
    public function subString(int $start, int $length = null): IString
    {
        return new IString(
            parent::doSubString($this->value, $start, $length)
        );
    }

    /**
     * This method returns a new instance with a portion of the original instance's value, starting at the beginning
     * of the value, with the number of characters specified in the $length parameter.
     *
     * Same rules as IString::subString() are applied.
     *
     * @param  int $length - Length of the sub-string. Must be positive.
     *
     * @throws \InvalidArgumentException - If supplied Length is not a positive integer.
     * @return IString
     */
    public function subLeft(int $length): IString
    {
        return new IString(
            parent::doSubLeft($this->value, $length)
        );
    }

    /**
     * This method returns a new instance with a portion of the original instance's value, couting from the end
     * of the value, with the number of characters specified in the $length parameter.
     *
     * Same rules as IString::subString() are applied.
     *
     * @param  int $length - Length of the sub-string. Must be positive.
     *
     * @throws \InvalidArgumentException - If supplied Length is not a positive integer.
     * @return IString
     */
    public function subRight(int $length): IString
    {
        return new IString(
            parent::doSubRight($this->value, $length)
        );
    }

    /**
     * This method returns a new instance with the reversed value of the original instance.
     *
     * @return IString
     */
    public function reverse(): IString
    {
        return new IString(
            parent::doReverse($this->value)
        );
    }

    /**
     * This method replaces a string's occurance by another, and returns a new instance with the new value.
     *
     * @param  string $search  - The string to search for.
     * @param  string $replace - The search's replacement.
     *
     * @throws \InvalidArgumentException - If $search is empty, or count is a not a positive integer.
     * @return IString
     */
    public function replace(string $search, string $replace): IString
    {
        return new IString(
            parent::doReplace($this->value, $search, $replace)
        );
    }
}
