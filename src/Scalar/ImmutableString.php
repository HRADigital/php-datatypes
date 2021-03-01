<?php declare(strict_types=1);

namespace Hradigital\Datatypes\Scalar;

/**
 * Immutable String's Scalar Object class.
 *
 * Instanciate this class, if you want the initial instance's value to be preserved, for example, if
 * you're using it as a Value Object, in a DDD project.
 *
 * Method chaning is not supported by any mutators. A new instance will be returned instead.
 *
 * @package   Hradigital\Datatypes
 * @license   MIT
 */
class ImmutableString extends AbstractWriteString
{
    /**
     * Creates a new instance of ImmutableString based on a string value.
     *
     * @param  string $value - Instance's initial value.
     * @return ImmutableString
     */
    public static function fromString(string $value): ImmutableString
    {
        return new ImmutableString($value);
    }

    /**
     * Clones this ImmutableString instance, into a MutableString one.
     *
     * @return MutableString
     */
    public function toMutable(): MutableString
    {
        return MutableString::fromString(
            $this->value
        );
    }

    /**
     * Trims instance's value, and returns a new instance of the object.
     *
     * @return ImmutableString
     */
    public function trim(): ImmutableString
    {
        return new ImmutableString(
            parent::doTrim()
        );
    }

    /**
     * Left trims instance's value, and returns a new instance of the object.
     *
     * @return ImmutableString
     */
    public function trimLeft(): ImmutableString
    {
        return new ImmutableString(
            parent::doTrimLeft()
        );
    }

    /**
     * Right trims instance's value, and returns a new instance of the object.
     *
     * @return ImmutableString
     */
    public function trimRight(): ImmutableString
    {
        return new ImmutableString(
            parent::doTrimRight()
        );
    }

    /**
     * Converts the instance's value to Upper Case, and returns a new instance of the object.
     *
     * @return ImmutableString
     */
    public function toUpper(): ImmutableString
    {
        return new ImmutableString(
            parent::doToUpper()
        );
    }

    /**
     * Converts the instance's value first character to Upper Case, and returns a new instance
     * of the object.
     *
     * @return ImmutableString
     */
    public function toUpperFirst(): ImmutableString
    {
        return new ImmutableString(
            parent::doToUpperFirst()
        );
    }

    /**
     * Converts the instance's value first character of each word to Upper Case, and returns a new instance
     * of the object.
     *
     * @param  string $delimiters - The optional delimiters contains the word separator characters.
     *
     * @return ImmutableString
     */
    public function toUpperWords(string $delimiters = " \t\r\n\f\v"): ImmutableString
    {
        return new ImmutableString(
            parent::doToUpperWords($delimiters)
        );
    }

    /**
     * Converts the instance's value to Lower Case, and returns a new instance of the object.
     *
     * @return ImmutableString
     */
    public function toLower(): ImmutableString
    {
        return new ImmutableString(
            parent::doToLower()
        );
    }

    /**
     * Converts the instance's value first character to Lower Case, and returns a new instance
     * of the object
     *
     * @return ImmutableString
     */
    public function toLowerFirst(): ImmutableString
    {
        return new ImmutableString(
            parent::doToLowerFirst()
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
     * @return ImmutableString
     */
    public function padLeft(int $length, string $padding = " "): ImmutableString
    {
        return new ImmutableString(
            parent::doPadLeft($length, $padding)
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
     * @return ImmutableString
     */
    public function padLeftExtra(int $length, string $padding = " "): ImmutableString
    {
        return new ImmutableString(
            parent::doPadLeftExtra($length, $padding)
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
     * @return ImmutableString
     */
    public function padRight(int $length, string $padding = " "): ImmutableString
    {
        return new ImmutableString(
            parent::doPadRight($length, $padding)
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
     * @return ImmutableString
     */
    public function padRightExtra(int $length, string $padding = " "): ImmutableString
    {
        return new ImmutableString(
            parent::doPadRightExtra($length, $padding)
        );
    }

    /**
     * This method returns a new instance with a portion of the original instance's value, specified by the
     * $start and $length parameters.
     *
     * $start parameter:
     * -If $start is non-negative, the returned an instance will start at the $start'th position in
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
     * @return ImmutableString
     */
    public function subString(int $start, int $length = null): ImmutableString
    {
        return new ImmutableString(
            parent::doSubString($start, $length)
        );
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
     * @return ImmutableString
     */
    public function subLeft(int $length): ImmutableString
    {
        return new ImmutableString(
            parent::doSubLeft($length)
        );
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
     * @return ImmutableString
     */
    public function subRight(int $length): ImmutableString
    {
        return new ImmutableString(
            parent::doSubRight($length)
        );
    }

    /**
     * This method returns a new instance with the reversed value of the original instance.
     *
     * @return ImmutableString
     */
    public function reverse(): ImmutableString
    {
        return new ImmutableString(
            parent::doReverse()
        );
    }

    /**
     * This method replaces a string's occurance by another, and returns a new instance with the new value.
     *
     * @param  string $search  - The string to search for.
     * @param  string $replace - The search's replacement.
     *
     * @throws \InvalidArgumentException - If $search is empty, or count is a not a positive integer.
     * @return ImmutableString
     */
    public function replace(string $search, string $replace): ImmutableString
    {
        return new ImmutableString(
            parent::doReplace($search, $replace)
        );
    }
}
