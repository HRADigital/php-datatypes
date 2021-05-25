<?php declare(strict_types=1);

namespace Hradigital\Datatypes\Exceptions\Datatypes;

use Hradigital\Datatypes\Exceptions\UnprocessableEntityException;

/**
 * Invalid E-mail Datatype Exception.
 *
 * @package   Hradigital\Datatypes
 * @license   MIT
 */
class InvalidEmailException extends UnprocessableEntityException
{
    /** @var string $message - Exception's error message. */
    protected string $message = "Provided e-mail field does not seam to be a valid e-mail address.";

    /** @var string $messageWithName - Exception's error message when an attribute name is supplied. */
    protected string $messageWithName = "Provided e-mail '%s' does not seam to be a valid e-mail address.";
}
