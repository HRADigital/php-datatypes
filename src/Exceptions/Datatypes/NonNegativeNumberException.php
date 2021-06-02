<?php declare(strict_types=1);

namespace Hradigital\Datatypes\Exceptions\Datatypes;

use Hradigital\Datatypes\Exceptions\UnprocessableEntityException;

/**
 * Must be a Non Negative Number Datatype Exception.
 *
 * Only Zero or more should be allowed.
 *
 * @package   Hradigital\Datatypes
 * @copyright Hradigital\Datatypes
 * @license   MIT
 */
class NonNegativeNumberException extends UnprocessableEntityException
{
    /** @var string $message - Exception's error message. */
    protected $message = "Supplied parameter must be a non negative number.";

    /** @var string $message - Exception's error message with field's name. */
    protected string $messageWithName = "Parameter '%s' must be a non negative number.";
}
