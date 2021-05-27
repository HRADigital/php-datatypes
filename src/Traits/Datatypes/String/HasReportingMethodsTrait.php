<?php declare(strict_types=1);

namespace Hradigital\Datatypes\Traits\Datatypes\String;

/**
 * Reporting methods for a String class.
 *
 * @package   Hradigital\Datatypes
 * @copyright Hradigital\Datatypes
 * @license   Proprietary
 */
trait HasReportingMethodsTrait
{
    /** @var string $value - Instance's value. */
    protected string $value = '';

    /**
     * Returns a Str instance for the supplied native string.
     *
     * @param  string $value - Native string representation.
     *
     * @return int
     */
    public function length(): int
    {
        return \strlen($this->value);
    }

    /**
     * Searches the String for a given sub-string's position.
     *
     * @param  string $search - String to search for.
     * @return int
     */
    public function position(string $search): int
    {
        return \strpos($this->value, $search);
    }

    /**
     * Counts the number of words in the String.
     *
     * @return int
     */
    public function wordCount(): int
    {
        return \str_word_count($this->value);
    }
}
