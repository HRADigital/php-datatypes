<?php
namespace Hradigital\Datatypes\Scalar;

/**
 * Mutable String's Scalar Object class.
 *
 * Instanciate this class, if you want, or don't care, if the internal instance's value
 * mutates during the instance's life.
 *
 * Any mutator call, will transform the instances internal value. Initial value will no longer be available.
 *
 * All mutator/setter methods in this class, support chaning.
 *
 * @package   Hradigital\Datatypes
 * @copyright Hugo Rafael Azevedo <github@hradigital.com>
 * @author    Hugo Rafael Azevedo <github@hradigital.com>
 * @license   MIT
 * @since     1.0.0
 */
class MutableString extends AbstractWriteString
{
    /**
     * Clones this <i>MutableString</i> instance, into a <i>ImmutableString</i> one.
     *
     * @since  1.0.0
     * @return ImmutableString
     */
    public function toImmutable(): ImmutableString
    {
        return new ImmutableString(
            $this->value
        );
    }

    /**
     * Trims the instance's value.
     *
     * This method supports chaning.
     *
     * @since  1.0.0
     * @return MutableString
     */
    public function trim(): MutableString
    {
        $this->value = parent::doTrim();

        return $this;
    }

    /**
     * Left trims the instance's value.
     *
     * This method supports chaning.
     *
     * @since  1.0.0
     * @return MutableString
     */
    public function trimLeft(): MutableString
    {
        $this->value = parent::doTrimLeft();

        return $this;
    }

    /**
     * Right trims the instance's value.
     *
     * This method supports chaning.
     *
     * @since  1.0.0
     * @return MutableString
     */
    public function trimRight(): MutableString
    {
        $this->value = parent::doTrimRight();

        return $this;
    }

    /**
     * Converts the instance's value to <b>Upper Case</b>.
     *
     * This method supports chaning.
     *
     * @since  1.0.0
     * @return MutableString
     */
    public function toUpper(): MutableString
    {
        $this->value = parent::doToUpper();

        return $this;
    }

    /**
     * Make a string's first character uppercase.
     *
     * @return MutableString
     *
     * @since  1.0.0
     * @return MutableString
     */
    public function toUpperFirst(): MutableString
    {
        $this->value = parent::doToUpperFirst();

        return $this;
    }

    /**
     * Makes the string's first character of each word to <b>Upper Case</b>.
     *
     * @param  string $delimiters - The optional delimiters contains the word separator characters.
     *
     * @since  1.0.0
     * @return MutableString
     */
    public function toUpperWords(string $delimiters = " \t\r\n\f\v"): MutableString
    {
        $this->value = parent::doToUpperWords($delimiters);

        return $this;
    }

    /**
     * Converts the instance's value to <b>Lower Case</b>.
     *
     * This method supports chaning.
     *
     * @since  1.0.0
     * @return MutableString
     */
    public function toLower(): MutableString
    {
        $this->value = parent::doToLower();

        return $this;
    }

    /**
     * Make a string's first character lowercase.
     *
     * @since  1.0.0
     * @return MutableString
     */
    public function toLowerFirst(): MutableString
    {
        $this->value = parent::doToLowerFirst();

        return $this;
    }

    /**
     * This method pads the instance's value on the <b>left</b> to the specified padding length.
     *
     * If the optional argument <i>$padString</i> is not supplied, the input is padded with spaces, otherwise
     * it is padded with characters from <i>$padString</i> up to the limit.
     *
     * This method supports chaning.
     *
     * @param  int    $length    - Length of the padded value.
     * @param  string $padString - The pad_string may be truncated if the required number of padding characters
     *                             can't be evenly divided by the <i>$padString</i>'s length.
     *
     * @throws \InvalidArgumentException - If any of the parameters is invalid.
     *
     * @since  1.0.0
     * @return MutableString
     */
    public function padLeft(int $length, string $padString = " "): MutableString
    {
        $this->value = parent::doPadLeft($length, $padString);

        return $this;
    }

    /**
     * This method pads the instance's value on the <b>right</b> to the specified padding length.
     *
     * If the optional argument <i>$padString</i> is not supplied, the input is padded with spaces, otherwise
     * it is padded with characters from <i>$padString</i> up to the limit.
     *
     * This method supports chaning.
     *
     * @param  int    $length    - Length of the padded value.
     * @param  string $padString - The pad_string may be truncated if the required number of padding characters
     *                             can't be evenly divided by the <i>$padString</i>'s length.
     *
     * @throws \InvalidArgumentException - If any of the parameters is invalid.
     *
     * @since  1.0.0
     * @return MutableString
     */
    public function padRight(int $length, string $padString = " "): MutableString
    {
        $this->value = parent::doPadRight($length, $padString);

        return $this;
    }

    /**
     * This method mutates the instance's value with a portion of the original value, specified by the
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
     * @return MutableString
     */
    public function subString(int $start, int $length = null): MutableString
    {
        $this->value = parent::doSubString($start, $length);

        return $this;
    }

    /**
     * This method mutates the instance's value with a portion of the original instance's value, starting at the
     * beginning of the value, with the number of characters specified in the <i>$length</i> parameter.
     *
     * Same rules as <i>MutableString::subString()</i> are applied.
     *
     * @param  int $length - Length of the sub-string. Must be positive.
     *
     * @throws \InvalidArgumentException - If supplied Length is not a positive integer.
     *
     * @since  1.0.0
     * @return MutableString
     */
    public function subLeft(int $length): MutableString
    {
        $this->value = parent::doSubLeft($length);

        return $this;
    }

    /**
     * This method mutates the instance's value with a portion of the original instance's value, couting from the
     * end of the value, with the number of characters specified in the <i>$length</i> parameter.
     *
     * Same rules as <i>MutableString::subString()</i> are applied.
     *
     * @param  int $length - Length of the sub-string. Must be positive.
     *
     * @throws \InvalidArgumentException - If supplied Length is not a positive integer.
     *
     * @since  1.0.0
     * @return MutableString
     */
    public function subRight(int $length): MutableString
    {
        $this->value = parent::doSubRight($length);

        return $this;
    }

    /**
     * This method reverses value of the instance.
     *
     * @since  1.0.0
     * @return MutableString
     */
    public function reverse(): MutableString
    {
        $this->value = parent::doReverse();

        return $this;
    }

    /**
     * This method replaces a string's occurance by another.
     *
     * @param  string $search  - The string to search for.
     * @param  string $replace - The search's replacement.
     *
     * @throws \InvalidArgumentException - If $search is empty.
     *
     * @since  1.0.0
     * @return MutableString
     */
    public function replace(string $search, string $replace): MutableString
    {
        $this->value = parent::doReplace($search, $replace);

        return $this;
    }
}
