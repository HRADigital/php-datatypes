<?php declare(strict_types=1);

namespace Hradigital\Datatypes\Exceptions\Datatypes;

use Hradigital\Datatypes\Exceptions\UnprocessableEntityException;

/**
 * Invalid String's Length Datatype Exception.
 *
 * @package   Hradigital\Datatypes
 * @license   MIT
 */
class InvalidStringLengthException extends UnprocessableEntityException
{
    /** @var string $message - Exception's error message. */
    protected string $message = "Supplied field doesn't have required character length.";

    /** @var string $message - Exception's error message with field's name. */
    protected string $messageWithName = "Field '%s' doesn't have required character length.";
}
