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
class Str
{
    /** @var string $value - Internal string value for the instance. */
    protected string $value = '';

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
     * Instantiates an AbstractBaseString child class.
     *
     * Constructor should be kept protected, to allow child class manipulation, if required.
     *
     * @param  string $value - Instance's initial state value.
     * @return void
     */
    protected function __construct(string $value)
    {
        $this->value = $value;
    }

    /**
     * Magic method that will print out the native string representation of the instance.
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->value;
    }

    /**
     * Compares the values of 2 separate instances.
     *
     * Returns TRUE if the 2 instance's values match. FALSE otherwise.
     *
     * @param  Str $string - Another Str instance to compare to.
     * @return bool
     */
    public function match(Str $string): bool
    {
        return $this->equals((string) $string);
    }

    /**
     * Compares the instance's value, with the supplied native string.
     *
     * Returns TRUE if the 2 values match. FALSE otherwise.
     *
     * @param  string $string - Another string to compare with.
     * @return bool
     */
    public function equals(string $string): bool
    {
        return ($this->value === $string);
    }

    /**
     * Returns the Instance's character length.
     *
     * @return int
     */
    public function getLength(): int
    {
        return \strlen($this->value);
    }

    /**
     * Counts the number of words in the String.
     *
     * @return int
     */
    public function getWordCount(): int
    {
        return \str_word_count($this->value);
    }

    /**
     * Checks if the instance's value contains the supplied $search string.
     *
     * Returns TRUE if found. FALSE otherwise.
     *
     * @param  string $search - Non empty string to search for in the instance.
     *
     * @throws NonEmptyStringException - If supplied $search is empty.
     * @return bool
     */
    public function contains(string $search): bool
    {
        // Validates supplied parameter.
        if (\strlen($search) === 0) {
            throw NonEmptyStringException::withName('$search');
        }

        return ($this->indexOf($search) !== null);
    }

    /**
     * Searches and returns the character index in the instance, of the $search string.
     *
     * If a $start is specified, search will start this number of characters counted from
     * the beginning of the string. If $start is negative, the search will start this number
     * of characters counted from the end of the string.
     *
     * If the $search is not found in the instance's value, NULL is returned.
     *
     * @param  string $search - String to search for in the instance.
     * @param  int    $start  - Search offset start. Defaults to ZERO.
     *
     * @throws NonEmptyStringException      - If $search value is an empty string.
     * @throws ParameterOutOfRangeException - If the $start is either too small, or too long.
     * @return int|null
     */
    public function indexOf(string $search, int $start = 0): ?int
    {
        // Validates supplied parameters.
        if (\strlen($search) === 0) {
            throw NonEmptyStringException::withName('$search');
        }
        if ($start) {
            $this->validateStartAndLength($start, null);
        }

        // Collects the string position.
        $index = \strpos($this->value, $search, $start);

        // If false is returned, no index was found, and therefore NULL is returned.
        if ($index === false) {
            return null;
        }

        return $index;
    }

    /**
     * Checks if the instance's value starts with the supplied string.
     *
     * @param  string $search - Non empty string to search for in the instance.
     *
     * @throws NonEmptyStringException - If supplied $search is empty.
     * @return bool
     */
    public function startsWith(string $search): bool
    {
        // Validates supplied parameter.
        if (\strlen($search) === 0) {
            throw NonEmptyStringException::withName('$search');
        }

        return ($this->indexOf($search) === 0);
    }

    /**
     * Checks if the instance's value ends with the supplied string.
     *
     * @param  string $search - Non empty string to search for in the instance.
     *
     * @throws NonEmptyStringException - If supplied $search is empty.
     * @return bool
     */
    public function endsWith(string $search): bool
    {
        // Validates supplied parameter.
        if (\strlen($search) === 0) {
            throw NonEmptyStringException::withName('$search');
        }

        return (
            ((string) $this->subString((0 - \strlen($search)))) === $search
        );
    }

    /**
     * Counts the number of substring occurrences in the instance's value.
     *
     * @param  string   $search - Non empty string to search for in the instance.
     * @param  int      $start  - The sub-string's offset/start.
     * @param  int|NULL $length - Length value. Can be NULL, in which case, it won't be validated.
     *
     * @throws NonEmptyStringException      - If supplied $search is empty.
     * @throws ParameterOutOfRangeException - If the $start and/or $length is either too small, or too long.
     * @return int
     */
    public function count(string $search, int $start = 0, ?int $length = null): int
    {
        // Validates supplied $search parameter.
        if (\strlen($search) === 0) {
            throw NonEmptyStringException::withName('$search');
        }

        // Validates supplied $start and $length.
        $this->validateStartAndLength($start, $length);

        // Checks if $length was defined.
        if ($length) {
            return \substr_count($this->value, $search, $start, $length);
        }

        return \substr_count($this->value, $search, $start);
    }

    /**
     * Validates a character $length, based on the instance value's length, and supplied $start.
     *
     * @param  int       $start  - The sub-string's offset/start.
     * @param  int|null  $length - Length value. Can be NULL, in which case, it won't be validated.
     *
     * @throws ParameterOutOfRangeException - If the $start and/or $length is either too small, or too long.
     * @return void
     */
    private function validateStartAndLength(int $start, ?int $length): void
    {
        // Calculates the absolute values for validations.
        $absStart  = (int) \abs($start);
        $absLength = $length ? (int) \abs($length) : null;

        // Validates the starting value.
        if ($absStart > $this->getLength()) {
            throw ParameterOutOfRangeException::withName('$start');
        }

        // If supplied $length is NULL, no further validations are required.
        if ($length === null) {
            return;
        }

        // Checks if the supplied $length, doesn't exceed the available number of characters.
        $startTooBig = ($start >= 0 && ($this->getLength() - $start < $absLength));
        $startTooSmall = ($start < 0 && $absLength > $absStart);

        if ($startTooBig || $startTooSmall) {
            throw ParameterOutOfRangeException::withName('$length');
        }
    }

    /**
     * Trims instance's value on both ends.
     *
     * @return self
     */
    public function trim(): self
    {
        return new self(
            \trim($this->value)
        );
    }

    /**
     * Trims instance's value only on the left.
     *
     * @return self
     */
    public function trimLeft(): self
    {
        return new self(
            \ltrim($this->value)
        );
    }

    /**
     * Trims instance's value only on the right.
     *
     * @return self
     */
    public function trimRight(): self
    {
        return new self(
            \rtrim($this->value)
        );
    }

    /**
     * Converts the instance's value to Uppercase.
     *
     * @return self
     */
    public function toUpper(): self
    {
        return new self(
            \mb_strtoupper($this->value)
        );
    }

    /**
     * Converts the instance's value first character to Uppercase.
     *
     * @return self
     */
    public function toUpperFirst(): self
    {
        return new self(
            \ucfirst($this->value)
        );
    }

    /**
     * Converts the instance's value first character of each word to Upper Case.
     *
     * @param  string  $delimiters - The optional delimiters contains the word separator characters.
     * @return self
     */
    public function toUpperWords(string $delimiters = " \t\r\n\f\v"): self
    {
        return new self(
            \ucwords($this->value, $delimiters)
        );
    }

    /**
     * Converts the instance's value to Lowercase.
     *
     * @return self
     */
    public function toLower(): self
    {
        return new self(
            \mb_strtolower($this->value)
        );
    }

    /**
     * Converts the instance's value first character to Lowercase.
     *
     * @return self
     */
    public function toLowerFirst(): self
    {
        return new self(
            \lcfirst($this->value)
        );
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
     * @param  int     $length  - Length of the padded value.
     * @param  string  $padding - The pad_string may be truncated if the required number of padding characters
     *                            can't be evenly divided by the $padString's length.
     *
     * @throws NonEmptyStringException      - If supplied $padding is empty.
     * @throws ParameterOutOfRangeException - If the $length is either too small, or too long.
     * @return self
     */
    public function padLeft(int $length, string $padding = " "): self
    {
        // Validates supplied parameters.
        if ($length < 1) {
            throw ParameterOutOfRangeException::withName('$length');
        }
        if (\strlen($padding) === 0) {
            throw NonEmptyStringException::withName('$padding');
        }

        return new self(
            \str_pad($this->value, $length, $padding, STR_PAD_LEFT)
        );
    }

    /**
     * This method returns a new instance padded on the LEFT, exactly to the specified padding length.
     *
     * If the optional argument $padding is not supplied, the input is padded with spaces, otherwise
     * it is padded with characters from $padding up to the limit.
     *
     * @param  int     $length  - Length of the padded value.
     * @param  string  $padding - The pad_string may be truncated if the required number of padding characters
     *                            can't be evenly divided by the $padding's length.
     *
     * @throws NonEmptyStringException      - If supplied $padding is empty.
     * @throws ParameterOutOfRangeException - If the $length is either too small, or too long.
     * @return self
     */
    public function padLeftExtra(int $length, string $padding = " "): self
    {
        return $this->padLeft(($this->getLength() + $length), $padding);
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
     * @param  int     $length  - Length of the padded value.
     * @param  string  $padding - The pad_string may be truncated if the required number of padding characters
     *                            can't be evenly divided by the $padding's length.
     *
     * @throws NonEmptyStringException      - If supplied $padding is empty.
     * @throws ParameterOutOfRangeException - If the $length is either too small, or too long.
     * @return self
     */
    public function padRight(int $length, string $padding = " "): self
    {
        // Validates supplied parameters.
        if ($length < 1) {
            throw ParameterOutOfRangeException::withName('$length');
        }
        if (\strlen($padding) === 0) {
            throw NonEmptyStringException::withName('$padding');
        }

        return new self(
            \str_pad($this->value, $length, $padding, STR_PAD_RIGHT)
        );
    }

    /**
     * This method returns a new instance padded on the RIGHT, exactly to the specified padding length.
     *
     * If the optional argument $padding is not supplied, the input is padded with spaces, otherwise
     * it is padded with characters from $padding up to the limit.
     *
     * @param  int     $length  - Length of the padded value.
     * @param  string  $padding - The pad_string may be truncated if the required number of padding characters
     *                            can't be evenly divided by the $padding's length.
     *
     * @throws NonEmptyStringException      - If supplied $padding is empty.
     * @throws ParameterOutOfRangeException - If the $length is either too small, or too long.
     * @return self
     */
    public function padRightExtra(int $length, string $padding = " "): self
    {
        return $this->padRight(($this->getLength() + $length), $padding);
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
     * @param  int     $start  - Start of the sub-string. Can be negative.
     * @param  int     $length - Length of the sub-string. Can be negative.
     *
     * @throws ParameterOutOfRangeException - If the $start and/or $length is either too small, or too long.
     * @return self
     */
    public function subString(int $start, int $length = null): self
    {
        // Validates supplied $start and $length.
        $this->validateStartAndLength($start, $length);

        // Processes the substring.
        if ($length !== null) {
            $value = \substr($this->value, $start, $length);
        } else {
            $value = \substr($this->value, $start);
        }

        return new self(
            ($value ?? '')
        );
    }

    /**
     * This method returns a new instance with a portion of the original instance's value, starting at the beginning
     * of the value, with the number of characters specified in the $length parameter.
     *
     * @param  int     $length - Length of the sub-string. Must be positive.
     *
     * @throws ParameterOutOfRangeException - If supplied Length is not a positive integer.
     * @return self
     */
    public function subLeft(int $length): self
    {
        // Validates parameter.
        if ($length < 1) {
            throw ParameterOutOfRangeException::withName('$length');
        }

        return $this->subString(0, $length);
    }

    /**
     * This method returns a new instance with a portion of the original instance's value, couting from the end
     * of the value, with the number of characters specified in the $length parameter.
     *
     * @param  int     $length - Length of the sub-string. Must be positive.
     *
     * @throws ParameterOutOfRangeException - If supplied Length is not a positive integer.
     * @return self
     */
    public function subRight(int $length): self
    {
        // Validates parameter.
        if ($length < 1) {
            throw ParameterOutOfRangeException::withName('$length');
        }

        return $this->subString(0 - $length);
    }

    /**
     * This method returns the reversed value of the instance.
     *
     * @return self
     */
    public function reverse(): self
    {
        return new self(
            \strrev($this->value)
        );
    }

    /**
     * This method replaces a string's occurance by another, and returns a new instance with the new value.
     *
     * @param  string  $search  - The string to search for.
     * @param  string  $replace - The search's replacement.
     *
     * @throws NonEmptyStringException - If either $search or $replace are empty.
     * @return self
     */
    public function replace(string $search, string $replace): self
    {
        // Validates supplied parameters.
        if (\strlen($search) === 0) {
            throw NonEmptyStringException::withName('$search');
        }
        if (\strlen($replace) === 0) {
            throw NonEmptyStringException::withName('$replace');
        }

        return new self(
            \str_replace($search, $replace, $this->value)
        );
    }

    /**
     * Returns an array of strings, each of which is a substring of string formed
     * by splitting it on boundaries formed by the string separator.
     *
     * If limit is set and positive, the returned array will contain a maximum of limit
     * elements with the last element containing the rest of string.
     *
     * If the limit parameter is negative, all components except the last -limit are returned.
     *
     * If the limit parameter is zero, then this is treated as 1.
     *
     * @param  string   $separator - The boundary string.
     * @param  int|null $limit     - The limit of returned segments.
     *
     * @throws NonEmptyStringException - If $separator is an empty string.
     * @return array|Str[]
     */
    public function explode(string $separator, ?int $limit = null): array
    {
        // Validates supplied parameters.
        if (\strlen($separator) === 0) {
            throw NonEmptyStringException::withName('$separator');
        }

        if ($limit === null) {
            $segments = \explode($separator, $this->value);
        } else {
            $segments = \explode($separator, $this->value, $limit);
        }

        $exploded = [];
        foreach ($segments as $segment) {
            $exploded[] = Str::create($segment);
        }

        return $exploded;
    }
}
