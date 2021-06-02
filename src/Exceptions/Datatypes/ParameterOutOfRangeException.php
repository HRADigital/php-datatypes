<?php declare(strict_types=1);

namespace Hradigital\Datatypes\Exceptions\Datatypes;

use Hradigital\Datatypes\Exceptions\UnprocessableEntityException;

/**
 * Out of Range value Datatype Exception.
 *
 * @package   Hradigital\Datatypes
 * @license   MIT
 */
class ParameterOutOfRangeException extends UnprocessableEntityException
{
    /** @var string $message - Exception's error message. */
    protected string $message = "Supplied parameter is out of range.";

    /** @var string $message - Exception's error message with field's name. */
    protected string $messageWithName = "Parameter '%s' is out of expected range.";
}
