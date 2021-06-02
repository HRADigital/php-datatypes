<?php declare(strict_types=1);

namespace Hradigital\Datatypes\Scalar;

use Hradigital\Datatypes\Exceptions\Datatypes\NonEmptyStringException;
use Hradigital\Datatypes\Exceptions\Datatypes\ParameterOutOfRangeException;

/**
 * String's Scalar Value Object class.
 *
 * Instanciate this class, if you want to be able to manipulate the Instance's value always using
 * Value Objects as interface.
 *
 * Fluent interface (chaning) is supported by mutators, but a new instance will always be returned.
 * Original internal value will be immutable.
 *
 * @package   Hradigital\Datatypes
 * @copyright Hradigital\Datatypes
 * @license   MIT
 */
class VoString extends AbstractBaseString
{
    /**
     * Creates a new instance of VoString based on a string value.
     *
     * @param  string $value - Instance's initial value.
     * @return VoString
     */
    public static function create(string $value): VoString
    {
        return new VoString($value);
    }

    /**
     * Returns a NString object, containing this instance's value.
     *
     * @return NString
     */
    public function toNString(): NString
    {
        return NString::create($this->value);
    }

    /**
     * Compares the values of 2 separate instances.
     *
     * Returns TRUE if the 2 instance's values match. FALSE otherwise.
     *
     * @param  VoString $string - Another VoString instance to compare to.
     * @return bool
     */
    public function equals(VoString $string): bool
    {
        return parent::doEquals((string) $string);
    }

    /**
     * Checks if the instance contains the supplied $search value.
     *
     * Returns TRUE if found. FALSE otherwise.
     *
     * @param  VoString $search - Non empty string to search for in the instance.
     *
     * @throws NonEmptyStringException - If supplied $search is empty.
     * @return bool
     */
    public function contains(VoString $search): bool
    {
        return parent::doContains((string) $search);
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
     * @param  VoString $search - String to search for in the instance.
     * @param  int     $start  - Search offset start. Defaults to ZERO.
     *
     * @throws NonEmptyStringException      - If $search value is an empty string.
     * @throws ParameterOutOfRangeException - If the $start is either too small, or too long.
     * @return int|null
     */
    public function indexOf(VoString $search, int $start = 0): ?int
    {
        return parent::doIndexOf((string) $search, $start);
    }

    /**
     * Checks if the instance's value starts with the supplied string.
     *
     * @param  VoString $search - Non empty string to search for in the instance.
     *
     * @throws NonEmptyStringException - If supplied $search is empty.
     * @return bool
     */
    public function startsWith(VoString $search): bool
    {
        return parent::doStartsWith((string) $search);
    }

    /**
     * Checks if the instance's value ends with the supplied string.
     *
     * @param  VoString $search - Non empty string to search for in the instance.
     *
     * @throws NonEmptyStringException - If supplied $search is empty.
     * @return bool
     */
    public function endsWith(VoString $search): bool
    {
        return parent::doEndsWith((string) $search);
    }

    /**
     * Counts the number of substring occurrences in the instance's value.
     *
     * @param  VoString  $search - Non empty string to search for in the instance.
     * @param  int      $start  - The sub-string's offset/start.
     * @param  int|null $length - Length value. Can be NULL, in which case, it won't be validated.
     *
     * @throws NonEmptyStringException      - If supplied $search is empty.
     * @throws ParameterOutOfRangeException - If the $start and/or $length is either too small, or too long.
     * @return int
     */
    public function count(VoString $search, int $start = 0, ?int $length = null): int
    {
        return parent::doCount((string) $search, $start, $length);
    }

    /**
     * Trims instance's value on both ends.
     *
     * @return VoString
     */
    public function trim(): VoString
    {
        return VoString::create(
            parent::doTrim()
        );
    }

    /**
     * Trims instance's value only on the left.
     *
     * @return VoString
     */
    public function trimLeft(): VoString
    {
        return VoString::create(
            parent::doTrimLeft()
        );
    }

    /**
     * Trims instance's value only on the right.
     *
     * @return VoString
     */
    public function trimRight(): VoString
    {
        return VoString::create(
            parent::doTrimRight()
        );
    }

    /**
     * Converts the instance's value to Uppercase, and returns a new instance of the object.
     *
     * @return VoString
     */
    public function toUpper(): VoString
    {
        return VoString::create(
            parent::doToUpper()
        );
    }

    /**
     * Converts the instance's value first character to Uppercase, and returns a new instance
     * of the object.
     *
     * @return VoString
     */
    public function toUpperFirst(): VoString
    {
        return VoString::create(
            parent::doToUpperFirst()
        );
    }

    /**
     * Converts the instance's value first character of each word to Upper Case, and returns a new instance
     * of the object.
     *
     * @param  VoString|null $delimiters - The optional delimiters contains the word separator characters.
     *
     * @return VoString
     */
    public function toUpperWords(?VoString $delimiters = null): VoString
    {
        return VoString::create(
            parent::doToUpperWords($delimiters ?? " \t\r\n\f\v")
        );
    }

    /**
     * Converts the instance's value to Lowercase, and returns a new instance of the object.
     *
     * @return VoString
     */
    public function toLower(): VoString
    {
        return VoString::create(
            parent::doToLower()
        );
    }

    /**
     * Converts the instance's value first character to Lowercase, and returns a new instance
     * of the object
     *
     * @return VoString
     */
    public function toLowerFirst(): VoString
    {
        return VoString::create(
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
     * @param  int  $length  - Length of the padded value.
     * @param  VoString|null $padding - The pad_string may be truncated if the required number of padding characters
     *                           can't be evenly divided by the $padding's length.
     *
     * @throws NonEmptyStringException      - If supplied $padding is empty.
     * @throws ParameterOutOfRangeException - If the $length is either too small, or too long.
     * @return VoString
     */
    public function padLeft(int $length, ?VoString $padding = null): VoString
    {
        return VoString::create(
            parent::doPadLeft($length, ((string) $padding ?: " "))
        );
    }

    /**
     * This method returns a new instance padded on the left, exactly to the specified padding length.
     *
     * If the optional argument $padding is not supplied, the input is padded with spaces, otherwise
     * it is padded with characters from $padding up to the limit.
     *
     * @param  int  $length  - Length of the padded value.
     * @param  VoString|null $padding - The pad_string may be truncated if the required number of padding characters
     *                           can't be evenly divided by the $padding's length.
     *
     * @throws NonEmptyStringException      - If supplied $padding is empty.
     * @throws ParameterOutOfRangeException - If the $length is either too small, or too long.
     * @return VoString
     */
    public function padLeftExtra(int $length, ?VoString $padding = null): VoString
    {
        return VoString::create(
            parent::doPadLeftExtra($length, ((string) $padding ?: " "))
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
     * @param  int  $length  - Length of the padded value.
     * @param  VoString|null $padding - The pad_string may be truncated if the required number of padding characters
     *                           can't be evenly divided by the $padding's length.
     *
     * @throws NonEmptyStringException      - If supplied $padding is empty.
     * @throws ParameterOutOfRangeException - If the $length is either too small, or too long.
     * @return VoString
     */
    public function padRight(int $length, ?VoString $padding = null): VoString
    {
        return VoString::create(
            parent::doPadRight($length, ((string) $padding ?: " "))
        );
    }

    /**
     * This method returns a new instance padded on the right, exactly to the specified padding length.
     *
     * If the optional argument $padding is not supplied, the input is padded with spaces, otherwise
     * it is padded with characters from $padding up to the limit.
     *
     * @param  int  $length  - Length of the padded value.
     * @param  VoString|null $padding - The pad_string may be truncated if the required number of padding characters
     *                           can't be evenly divided by the $padding's length.
     *
     * @throws NonEmptyStringException      - If supplied $padding is empty.
     * @throws ParameterOutOfRangeException - If the $length is either too small, or too long.
     * @return VoString
     */
    public function padRightExtra(int $length, ?VoString $padding = null): VoString
    {
        return VoString::create(
            parent::doPadRightExtra($length, ((string) $padding ?: " "))
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
     * @throws ParameterOutOfRangeException - If the $start and/or $length is either too small, or too long.
     * @return VoString
     */
    public function subString(int $start, int $length = null): VoString
    {
        return VoString::create(
            parent::doSubString($start, $length)
        );
    }

    /**
     * This method returns a new instance with a portion of the original instance's value, starting at the beginning
     * of the value, with the number of characters specified in the $length parameter.
     *
     * @param  int $length - Length of the sub-string. Must be positive.
     *
     * @throws ParameterOutOfRangeException - If supplied Length is not a positive integer.
     * @return VoString
     */
    public function subLeft(int $length): VoString
    {
        return VoString::create(
            parent::doSubLeft($length)
        );
    }

    /**
     * This method returns a new instance with a portion of the original instance's value, couting from the end
     * of the value, with the number of characters specified in the $length parameter.
     *
     * @param  int $length - Length of the sub-string. Must be positive.
     *
     * @throws ParameterOutOfRangeException - If supplied Length is not a positive integer.
     * @return VoString
     */
    public function subRight(int $length): VoString
    {
        return VoString::create(
            parent::doSubRight($length)
        );
    }

    /**
     * This method returns the reversed value of the instance.
     *
     * @return VoString
     */
    public function reverse(): VoString
    {
        return VoString::create(
            parent::doReverse()
        );
    }

    /**
     * This method replaces a string's occurance by another, and returns a new instance with the new value.
     *
     * @param  VoString $search  - The string to search for.
     * @param  VoString $replace - The search's replacement.
     *
     * @throws NonEmptyStringException - If either $search or $replace are empty.
     * @return VoString
     */
    public function replace(VoString $search, VoString $replace): VoString
    {
        return VoString::create(
            parent::doReplace((string) $search, (string) $replace)
        );
    }
}
