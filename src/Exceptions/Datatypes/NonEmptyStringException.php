<?php declare(strict_types=1);

namespace Hradigital\Datatypes\Exceptions\Datatypes;

use Hradigital\Datatypes\Exceptions\UnprocessableEntityException;

/**
 * Non empty String Datatype Exception.
 *
 * @package   Hradigital\Datatypes
 * @license   MIT
 */
class NonEmptyStringException extends UnprocessableEntityException
{
    /** @var string $message - Exception's error message. */
    protected $message = "Supplied parameter must be non empty string.";

    /** @var string $message - Exception's error message with field's name. */
    protected string $messageWithName = "Parameter '%s' must be a non empty string.";
}
