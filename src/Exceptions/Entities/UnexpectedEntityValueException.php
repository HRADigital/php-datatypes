<?php declare(strict_types=1);

namespace Hradigital\Datatypes\Exceptions\Entities;

use Hradigital\Datatypes\Exceptions\UnprocessableEntityException;

/**
 * Unexpected value Entity Exception.
 *
 * @package   Hradigital\Datatypes
 * @license   MIT
 */
class UnexpectedEntityValueException extends UnprocessableEntityException
{
    /** @var string $message - Exception's error message. */
    protected $message = "Application tried to load one or more unexpected values into the Entity.";

    /** @var string $message - Exception's error message. */
    protected string $messageWithName = "Field '%s' had an unexpected value, while loading into an Entity.";
}
