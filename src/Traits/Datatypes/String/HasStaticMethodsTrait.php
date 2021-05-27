<?php declare(strict_types=1);

namespace Hradigital\Datatypes\Traits\Datatypes\String;

use Hradigital\Datatypes\Datatypes\Str;

/**
 * Static Factory methods for String's class.
 *
 * @package   Hradigital\Datatypes
 * @copyright Hradigital\Datatypes
 * @license   Proprietary
 */
trait HasStaticMethodsTrait
{
    /**
     * Returns a Str instance for the supplied native string.
     *
     * @param  string $value - Native string representation.
     *
     * @return Str
     */
    public static function fromString(string $value): Str
    {
        return new Str($value);
    }
}
