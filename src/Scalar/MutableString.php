<?php declare(strict_types=1);

namespace Hradigital\Datatypes\Scalar;

/**
 * Mutable String's Scalar Object class.
 *
 * Instanciate this class, if you want, or don't care, if the internal instance's value
 * mutates during the instance's life.
 *
 * Any mutator call, will transform the instances internal value. Initial value will no longer be available.
 * All mutator/setter methods in this class, have a fluent interface (method chaning).
 *
 * @package   Hradigital\Datatypes
 * @license   MIT
 */
class MutableString extends AbstractBaseString
{
    /**
     * Creates a new instance of MutableString based on a string value.
     *
     * @param  string $value - Instance's initial value.
     * @return MutableString
     */
    public static function fromString(string $value): MutableString
    {
        return new MutableString($value);
    }

    /**
     * Clones this MutableString instance, into a ImmutableString one.
     *
     * @return ImmutableString
     */
    public function toImmutable(): ImmutableString
    {
        return ImmutableString::fromString(
            $this->value
        );
    }

    /**
     * Trims the instance's value.
     *
     * This method supports chaning.
     *
     * @return MutableString
     */
    public function trim(): MutableString
    {
        $this->value = parent::doTrim($this->value);

        return $this;
    }

    /**
     * Left trims the instance's value.
     *
     * This method supports chaning.
     *
     * @return MutableString
     */
    public function trimLeft(): MutableString
    {
        $this->value = parent::doTrimLeft($this->value);

        return $this;
    }

    /**
     * Right trims the instance's value.
     *
     * This method supports chaning.
     *
     * @return MutableString
     */
    public function trimRight(): MutableString
    {
        $this->value = parent::doTrimRight($this->value);

        return $this;
    }

    /**
     * Converts the instance's value to Upper Case.
     *
     * This method supports chaning.
     *
     * @return MutableString
     */
    public function toUpper(): MutableString
    {
        $this->value = parent::doToUpper($this->value);

        return $this;
    }

    /**
     * Make a string's first character uppercase.
     *
     * @return MutableString
     */
    public function toUpperFirst(): MutableString
    {
        $this->value = parent::doToUpperFirst($this->value);

        return $this;
    }

    /**
     * Makes the string's first character of each word to Upper Case.
     *
     * @param  string $delimiters - The optional delimiters contains the word separator characters.
     *
     * @return MutableString
     */
    public function toUpperWords(string $delimiters = " \t\r\n\f\v"): MutableString
    {
        $this->value = parent::doToUpperWords($this->value, $delimiters);

        return $this;
    }

    /**
     * Converts the instance's value to Lower Case.
     *
     * This method supports chaning.
     *
     * @return MutableString
     */
    public function toLower(): MutableString
    {
        $this->value = parent::doToLower($this->value);

        return $this;
    }

    /**
     * Make a string's first character lowercase.
     *
     * @return MutableString
     */
    public function toLowerFirst(): MutableString
    {
        $this->value = parent::doToLowerFirst($this->value);

        return $this;
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
     * This method supports chaning.
     *
     * @param  int    $length    - Length of the padded value.
     * @param  string $padding - The pad_string may be truncated if the required number of padding characters
     *                             can't be evenly divided by the $padding's length.
     *
     * @throws \InvalidArgumentException - If any of the parameters is invalid.
     * @return MutableString
     */
    public function padLeft(int $length, string $padding = " "): MutableString
    {
        $this->value = parent::doPadLeft($this->value, $length, $padding);

        return $this;
    }

    /**
     * This method returns a new instance padded on the left, exactly to the specified padding length.
     *
     * If the optional argument $padding is not supplied, the input is padded with spaces, otherwise
     * it is padded with characters from $padding up to the limit.
     *
     * @param  int    $length    - Length of the padded value.
     * @param  string $padding - The pad_string may be truncated if the required number of padding characters
     *                             can't be evenly divided by the $padding's length.
     *
     * @throws \InvalidArgumentException - If any of the parameters is invalid.
     * @return MutableString
     */
    public function padLeftExtra(int $length, string $padding = " "): MutableString
    {
        $this->value = parent::doPadLeftExtra($this->value, $length, $padding);

        return $this;
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
     * This method supports chaning.
     *
     * @param  int    $length    - Length of the padded value.
     * @param  string $padding - The pad_string may be truncated if the required number of padding characters
     *                             can't be evenly divided by the $padding's length.
     *
     * @throws \InvalidArgumentException - If any of the parameters is invalid.
     * @return MutableString
     */
    public function padRight(int $length, string $padding = " "): MutableString
    {
        $this->value = parent::doPadRight($this->value, $length, $padding);

        return $this;
    }

    /**
     * This method returns a new instance padded on the right, exactly to the specified padding length.
     *
     * If the optional argument $padding is not supplied, the input is padded with spaces, otherwise
     * it is padded with characters from $padding up to the limit.
     *
     * @param  int    $length    - Length of the padded value.
     * @param  string $padding - The pad_string may be truncated if the required number of padding characters
     *                             can't be evenly divided by the $padding's length.
     *
     * @throws \InvalidArgumentException - If any of the parameters is invalid.
     * @return MutableString
     */
    public function padRightExtra(int $length, string $padding = " "): MutableString
    {
        $this->value = parent::doPadRightExtra($this->value, $length, $padding);

        return $this;
    }

    /**
     * This method mutates the instance's value with a portion of the original value, specified by the
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
     * @return MutableString
     */
    public function subString(int $start, int $length = null): MutableString
    {
        $this->value = parent::doSubString($this->value, $start, $length);

        return $this;
    }

    /**
     * This method mutates the instance's value with a portion of the original instance's value, starting at the
     * beginning of the value, with the number of characters specified in the $length parameter.
     *
     * Same rules as MutableString::subString() are applied.
     *
     * @param  int $length - Length of the sub-string. Must be positive.
     *
     * @throws \InvalidArgumentException - If supplied Length is not a positive integer.
     * @return MutableString
     */
    public function subLeft(int $length): MutableString
    {
        $this->value = parent::doSubLeft($this->value, $length);

        return $this;
    }

    /**
     * This method mutates the instance's value with a portion of the original instance's value, couting from the
     * end of the value, with the number of characters specified in the $length parameter.
     *
     * Same rules as MutableString::subString() are applied.
     *
     * @param  int $length - Length of the sub-string. Must be positive.
     *
     * @throws \InvalidArgumentException - If supplied Length is not a positive integer.
     * @return MutableString
     */
    public function subRight(int $length): MutableString
    {
        $this->value = parent::doSubRight($this->value, $length);

        return $this;
    }

    /**
     * This method reverses value of the instance.
     *
     * @return MutableString
     */
    public function reverse(): MutableString
    {
        $this->value = parent::doReverse($this->value);

        return $this;
    }

    /**
     * This method replaces a string's occurance by another.
     *
     * @param  string $search  - The string to search for.
     * @param  string $replace - The search's replacement.
     *
     * @throws \InvalidArgumentException - If $search is empty.
     * @return MutableString
     */
    public function replace(string $search, string $replace): MutableString
    {
        $this->value = parent::doReplace($this->value, $search, $replace);

        return $this;
    }
}
