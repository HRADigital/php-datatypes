<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Scalar;

use HraDigital\Datatypes\Exceptions\Datatypes\NonEmptyStringException;
use HraDigital\Datatypes\Exceptions\Datatypes\ParameterOutOfRangeException;

/**
 * String's Scalar Value Object class.
 *
 * Instanciate this class, if you want to be able to manipulate the Instance's value always using
 * Value Objects as interface.
 *
 * Fluent interface (chaning) is supported by mutators, but a new instance will always be returned.
 * Original internal value will be immutable.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
class Str extends AbstractBaseString
{
    /**
     * Creates a new instance of Str based on a string value.
     *
     * @param  string $value - Instance's initial value.
     * @return Str
     */
    public static function create(string $value): Str
    {
        return new Str($value);
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
     * @param  Str $string - Another Str instance to compare to.
     * @return bool
     */
    public function equals(Str $string): bool
    {
        return ($this->value === $string);
    }

    /**
     * Checks if the instance contains the supplied $search value.
     *
     * Returns TRUE if found. FALSE otherwise.
     *
     * @param  Str $search - Non empty string to search for in the instance.
     *
     * @throws NonEmptyStringException - If supplied $search is empty.
     * @return bool
     */
    public function contains(Str $search): bool
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
     * @param  Str $search - String to search for in the instance.
     * @param  int     $start  - Search offset start. Defaults to ZERO.
     *
     * @throws NonEmptyStringException      - If $search value is an empty string.
     * @throws ParameterOutOfRangeException - If the $start is either too small, or too long.
     * @return int|null
     */
    public function indexOf(Str $search, int $start = 0): ?int
    {
        return parent::doIndexOf((string) $search, $start);
    }

    /**
     * Checks if the instance's value starts with the supplied string.
     *
     * @param  Str $search - Non empty string to search for in the instance.
     *
     * @throws NonEmptyStringException - If supplied $search is empty.
     * @return bool
     */
    public function startsWith(Str $search): bool
    {
        return parent::doStartsWith((string) $search);
    }

    /**
     * Checks if the instance's value ends with the supplied string.
     *
     * @param  Str $search - Non empty string to search for in the instance.
     *
     * @throws NonEmptyStringException - If supplied $search is empty.
     * @return bool
     */
    public function endsWith(Str $search): bool
    {
        return parent::doEndsWith((string) $search);
    }

    /**
     * Counts the number of substring occurrences in the instance's value.
     *
     * @param  Str  $search - Non empty string to search for in the instance.
     * @param  int      $start  - The sub-string's offset/start.
     * @param  int|null $length - Length value. Can be NULL, in which case, it won't be validated.
     *
     * @throws NonEmptyStringException      - If supplied $search is empty.
     * @throws ParameterOutOfRangeException - If the $start and/or $length is either too small, or too long.
     * @return int
     */
    public function count(Str $search, int $start = 0, ?int $length = null): int
    {
        return parent::doCount((string) $search, $start, $length);
    }

    /**
     * Trims instance's value on both ends.
     *
     * @return Str
     */
    public function trim(): Str
    {
        return Str::create(
            parent::doTrim()
        );
    }

    /**
     * Trims instance's value only on the left.
     *
     * @return Str
     */
    public function trimLeft(): Str
    {
        return Str::create(
            parent::doTrimLeft()
        );
    }

    /**
     * Trims instance's value only on the right.
     *
     * @return Str
     */
    public function trimRight(): Str
    {
        return Str::create(
            parent::doTrimRight()
        );
    }

    /**
     * Converts the instance's value to Uppercase, and returns a new instance of the object.
     *
     * @return Str
     */
    public function toUpper(): Str
    {
        return Str::create(
            parent::doToUpper()
        );
    }

    /**
     * Converts the instance's value first character to Uppercase, and returns a new instance
     * of the object.
     *
     * @return Str
     */
    public function toUpperFirst(): Str
    {
        return Str::create(
            parent::doToUpperFirst()
        );
    }

    /**
     * Converts the instance's value first character of each word to Upper Case, and returns a new instance
     * of the object.
     *
     * @param  Str|null $delimiters - The optional delimiters contains the word separator characters.
     *
     * @return Str
     */
    public function toUpperWords(?Str $delimiters = null): Str
    {
        return Str::create(
            parent::doToUpperWords($delimiters ?? " \t\r\n\f\v")
        );
    }

    /**
     * Converts the instance's value to Lowercase, and returns a new instance of the object.
     *
     * @return Str
     */
    public function toLower(): Str
    {
        return Str::create(
            parent::doToLower()
        );
    }

    /**
     * Converts the instance's value first character to Lowercase, and returns a new instance
     * of the object
     *
     * @return Str
     */
    public function toLowerFirst(): Str
    {
        return Str::create(
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
     * @param  Str|null $padding - The pad_string may be truncated if the required number of padding characters
     *                           can't be evenly divided by the $padding's length.
     *
     * @throws NonEmptyStringException      - If supplied $padding is empty.
     * @throws ParameterOutOfRangeException - If the $length is either too small, or too long.
     * @return Str
     */
    public function padLeft(int $length, ?Str $padding = null): Str
    {
        if ($padding === null) {
            $padding = Str::create(" ");
        }

        return Str::create(
            parent::doPadLeft($length, ((string) $padding ?? " "))
        );
    }

    /**
     * This method returns a new instance padded on the left, exactly to the specified padding length.
     *
     * If the optional argument $padding is not supplied, the input is padded with spaces, otherwise
     * it is padded with characters from $padding up to the limit.
     *
     * @param  int  $length  - Length of the padded value.
     * @param  Str|null $padding - The pad_string may be truncated if the required number of padding characters
     *                           can't be evenly divided by the $padding's length.
     *
     * @throws NonEmptyStringException      - If supplied $padding is empty.
     * @throws ParameterOutOfRangeException - If the $length is either too small, or too long.
     * @return Str
     */
    public function padLeftExtra(int $length, ?Str $padding = null): Str
    {
        if ($padding === null) {
            $padding = Str::create(" ");
        }

        return Str::create(
            parent::doPadLeftExtra($length, ((string) $padding ?? " "))
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
     * @param  Str|null $padding - The pad_string may be truncated if the required number of padding characters
     *                           can't be evenly divided by the $padding's length.
     *
     * @throws NonEmptyStringException      - If supplied $padding is empty.
     * @throws ParameterOutOfRangeException - If the $length is either too small, or too long.
     * @return Str
     */
    public function padRight(int $length, ?Str $padding = null): Str
    {
        if ($padding === null) {
            $padding = Str::create(" ");
        }

        return Str::create(
            parent::doPadRight($length, ((string) $padding ?? " "))
        );
    }

    /**
     * This method returns a new instance padded on the right, exactly to the specified padding length.
     *
     * If the optional argument $padding is not supplied, the input is padded with spaces, otherwise
     * it is padded with characters from $padding up to the limit.
     *
     * @param  int  $length  - Length of the padded value.
     * @param  Str|null $padding - The pad_string may be truncated if the required number of padding characters
     *                           can't be evenly divided by the $padding's length.
     *
     * @throws NonEmptyStringException      - If supplied $padding is empty.
     * @throws ParameterOutOfRangeException - If the $length is either too small, or too long.
     * @return Str
     */
    public function padRightExtra(int $length, ?Str $padding = null): Str
    {
        if ($padding === null) {
            $padding = Str::create(" ");
        }

        return Str::create(
            parent::doPadRightExtra($length, ((string) $padding ?? " "))
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
     * @return Str
     */
    public function subString(int $start, int $length = null): Str
    {
        return Str::create(
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
     * @return Str
     */
    public function subLeft(int $length): Str
    {
        return Str::create(
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
     * @return Str
     */
    public function subRight(int $length): Str
    {
        return Str::create(
            parent::doSubRight($length)
        );
    }

    /**
     * This method returns the reversed value of the instance.
     *
     * @return Str
     */
    public function reverse(): Str
    {
        return Str::create(
            parent::doReverse()
        );
    }

    /**
     * This method replaces a string's occurance by another, and returns a new instance with the new value.
     *
     * @param  Str $search  - The string to search for.
     * @param  Str $replace - The search's replacement.
     *
     * @throws NonEmptyStringException - If either $search or $replace are empty.
     * @return Str
     */
    public function replace(Str $search, Str $replace): Str
    {
        return Str::create(
            parent::doReplace((string) $search, (string) $replace)
        );
    }
}
