<?php declare(strict_types=1);

namespace Hradigital\Datatypes\Scalar;

/**
 * String's Scalar Native/Primitive Object class.
 *
 * Instanciate this class, if you want the initial instance's value to be preserved.
 *
 * Fluent interface (chaning) is supported by mutators, but a new instance will be returned.
 * Original internal value will be immutable.
 *
 * @package   Hradigital\Datatypes
 * @copyright Hradigital\Datatypes
 * @license   MIT
 */
class NString extends AbstractBaseString
{
    /**
     * Creates a new instance of NString based on a string value.
     *
     * @param  string $value - Instance's initial value.
     * @return NString
     */
    public static function create(string $value): NString
    {
        return new NString($value);
    }

    /**
     * Returns a VoString object, containing this instance's value.
     *
     * @return VoString
     */
    public function toVoString(): VoString
    {
        return VoString::create($this->value);
    }

    /**
     * Compares the values of 2 separate strings.
     *
     * Returns TRUE if the 2 values match. FALSE otherwise.
     *
     * @param  string $string - Another string instance to compare to.
     * @return bool
     */
    public function equals(string $string): bool
    {
        return parent::doEquals($string);
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
        return parent::doEquals($search);
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
     * @return int|null
     */
    public function indexOf(string $search, int $start = 0): ?int
    {
        return parent::doIndexOf($search, $start);
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
        return parent::doStartsWith($search);
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
        return parent::doEndsWith($search);
    }

    /**
     * Counts the number of substring occurrences in the instance's value.
     *
     * @param  string   $search - Non empty string to search for in the instance.
     * @param  int      $start  - The sub-string's offset/start.
     * @param  int|null $length - Length value. Can be NULL, in which case, it won't be validated.
     *
     * @throws \InvalidArgumentException - If supplied $search is empty.
     * @throws \OutOfRangeException      - If the $start and/or $length is either too small, or too long.
     * @return int
     */
    public function count(string $search, int $start = 0, ?int $length = null): int
    {
        return parent::doCount($search, $start, $length);
    }

    /**
     * Trims instance's value on both ends.
     *
     * @return NString
     */
    public function trim(): NString
    {
        return NString::create(
            parent::doTrim()
        );
    }

    /**
     * Trims instance's value only on the left.
     *
     * @return NString
     */
    public function trimLeft(): NString
    {
        return NString::create(
            parent::doTrimLeft()
        );
    }

    /**
     * Trims instance's value only on the right.
     *
     * @return NString
     */
    public function trimRight(): NString
    {
        return NString::create(
            parent::doTrimRight()
        );
    }

    /**
     * Converts the instance's value to Uppecase.
     *
     * @return NString
     */
    public function toUpper(): NString
    {
        return NString::create(
            parent::doToUpper()
        );
    }

    /**
     * Converts the instance's value first character to Uppercase, and returns a new instance
     * of the object.
     *
     * @return NString
     */
    public function toUpperFirst(): NString
    {
        return NString::create(
            parent::doToUpperFirst()
        );
    }

    /**
     * Converts the instance's value first character of each word to Upper Case, and returns a new instance
     * of the object.
     *
     * @param  string $delimiters - The optional delimiters contains the word separator characters.
     *
     * @return NString
     */
    public function toUpperWords(string $delimiters = " \t\r\n\f\v"): NString
    {
        return NString::create(
            parent::doToUpperWords($delimiters)
        );
    }

    /**
     * Converts the instance's value to Lowercase, and returns a new instance of the object.
     *
     * @return NString
     */
    public function toLower(): NString
    {
        return NString::create(
            parent::doToLower()
        );
    }

    /**
     * Converts the instance's value first character to Lowercase, and returns a new instance
     * of the object
     *
     * @return NString
     */
    public function toLowerFirst(): NString
    {
        return NString::create(
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
     * @param  int     $length  - Length of the padded value.
     * @param  string  $padding - The pad_string may be truncated if the required number of padding characters
     *                           can't be evenly divided by the $padding's length.
     *
     * @throws \InvalidArgumentException - If any of the parameters is invalid.
     * @return NString
     */
    public function padLeft(int $length, string $padding = " "): NString
    {
        return NString::create(
            parent::doPadLeft($length, $padding)
        );
    }

    /**
     * This method returns a new instance padded on the left, exactly to the specified padding length.
     *
     * If the optional argument $padding is not supplied, the input is padded with spaces, otherwise
     * it is padded with characters from $padding up to the limit.
     *
     * @param  int     $length  - Length of the padded value.
     * @param  string  $padding - The pad_string may be truncated if the required number of padding characters
     *                           can't be evenly divided by the $padding's length.
     *
     * @throws \InvalidArgumentException - If any of the parameters is invalid.
     * @return NString
     */
    public function padLeftExtra(int $length, string $padding = " "): NString
    {
        return NString::create(
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
     * @param  int     $length  - Length of the padded value.
     * @param  string  $padding - The pad_string may be truncated if the required number of padding characters
     *                           can't be evenly divided by the $padding's length.
     *
     * @throws \InvalidArgumentException - If any of the parameters is invalid.
     * @return NString
     */
    public function padRight(int $length, string $padding = " "): NString
    {
        return NString::create(
            parent::doPadRight($length, $padding)
        );
    }

    /**
     * This method returns a new instance padded on the right, exactly to the specified padding length.
     *
     * If the optional argument $padding is not supplied, the input is padded with spaces, otherwise
     * it is padded with characters from $padding up to the limit.
     *
     * @param  int     $length  - Length of the padded value.
     * @param  string  $padding - The pad_string may be truncated if the required number of padding characters
     *                           can't be evenly divided by the $padding's length.
     *
     * @throws \InvalidArgumentException - If any of the parameters is invalid.
     * @return NString
     */
    public function padRightExtra(int $length, string $padding = " "): NString
    {
        return NString::create(
            parent::doPadRightExtra($length, $padding)
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
     * @return NString
     */
    public function subString(int $start, int $length = null): NString
    {
        return NString::create(
            parent::doSubString($start, $length)
        );
    }

    /**
     * This method returns a new instance with a portion of the original instance's value, starting at the beginning
     * of the value, with the number of characters specified in the $length parameter.
     *
     * @param  int $length - Length of the sub-string. Must be positive.
     *
     * @throws \InvalidArgumentException - If supplied Length is not a positive integer.
     * @return NString
     */
    public function subLeft(int $length): NString
    {
        return NString::create(
            parent::doSubLeft($length)
        );
    }

    /**
     * This method returns a new instance with a portion of the original instance's value, couting from the end
     * of the value, with the number of characters specified in the $length parameter.
     *
     * @param  int $length - Length of the sub-string. Must be positive.
     *
     * @throws \InvalidArgumentException - If supplied Length is not a positive integer.
     * @return NString
     */
    public function subRight(int $length): NString
    {
        return NString::create(
            parent::doSubRight($length)
        );
    }

    /**
     * This method returns the reversed value of the instance.
     *
     * @return NString
     */
    public function reverse(): NString
    {
        return NString::create(
            parent::doReverse()
        );
    }

    /**
     * This method replaces a string's occurance by another, and returns a new instance with the new value.
     *
     * @param  string  $search  - The string to search for.
     * @param  string  $replace - The search's replacement.
     *
     * @throws \InvalidArgumentException - If $search is empty, or count is a not a positive integer.
     * @return NString
     */
    public function replace(string $search, string $replace): NString
    {
        return NString::create(
            parent::doReplace($search, $replace)
        );
    }
}
