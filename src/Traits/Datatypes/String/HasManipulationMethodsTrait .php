<?php declare(strict_types=1);

namespace Hradigital\Datatypes\Traits\Datatypes\String;

use Hradigital\Datatypes\Datatypes\Str;

/**
 * Manipulation methods for a String class.
 *
 * @package   Hradigital\Datatypes
 * @copyright Hradigital\Datatypes
 * @license   Proprietary
 */
trait HasManipulationMethodsTrait
{
    /** @var string $value - Instance's value. */
    protected string $value = '';

    /**
     * Trims the String's value.
     *
     * This method will return a new instance of Str.
     *
     * @return Str
     */
    public function trim(): Str
    {
        return new Str(
            \trim($this->value)
        );
    }

    /**
     * Right Trims the String's value.
     *
     * This method will return a new instance of Str.
     *
     * @return Str
     */
    public function trimRight(): Str
    {
        return new Str(
            \rtrim($this->value)
        );
    }

    /**
     * Left Trims the String's value.
     *
     * This method will return a new instance of Str.
     *
     * @return Str
     */
    public function trimLeft(): Str
    {
        return new Str(
            \ltrim($this->value)
        );
    }

    /**
     * Lower Cases String's value.
     *
     * This method will return a new instance of Str.
     *
     * @return Str
     */
    public function lowercase(): Str
    {
        return new Str(
            \strtolower($this->value)
        );
    }

    /**
     * Upper Cases String's value.
     *
     * This method will return a new instance of Str.
     *
     * @return Str
     */
    public function uppercase(): Str
    {
        return new Str(
            \strtoupper($this->value)
        );
    }

    /**
     * Lower Cases first character of the String's value.
     *
     * This method will return a new instance of Str.
     *
     * @return Str
     */
    public function lowercaseFirst(): Str
    {
        return new Str(
            \lcfirst($this->value)
        );
    }

    /**
     * Upper Cases first character of the String's value.
     *
     * This method will return a new instance of Str.
     *
     * @return Str
     */
    public function uppercaseFirst(): Str
    {
        return new Str(
            \ucfirst($this->value)
        );
    }

    /**
     * Upper Cases all words of the String's value.
     *
     * This method will return a new instance of Str.
     *
     * @return Str
     */
    public function uppercaseWords(): Str
    {
        return new Str(
            \ucwords($this->value)
        );
    }

    /**
     * Replaces a given portion of the String for another.
     *
     * This method will return a new instance of Str.
     *
     * @param  string $search  - String to search for.
     * @param  string $replace - String replacement.
     * @return Str
     */
    public function replace(string $search, string $replace): Str
    {
        return new Str(
            \str_replace($search, $replace, $this->value)
        );
    }
}
