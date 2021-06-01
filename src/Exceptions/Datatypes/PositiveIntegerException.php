<?php declare(strict_types=1);

namespace Hradigital\Datatypes\Exceptions\Datatypes;

use Hradigital\Datatypes\Exceptions\UnprocessableEntityException;

/**
 * Must be a Positive Integer Datatype Exception.
 *
 * @package   Hradigital\Datatypes
 * @license   MIT
 */
class PositiveIntegerException extends UnprocessableEntityException
{
    /** @var string $message - Exception's error message. */
    protected string $message = "Supplied parameter must be a positive integer.";

    /** @var string $message - Exception's error message with field's name. */
    protected string $messageWithName = "Parameter '%s' must be a positive integer.";
}