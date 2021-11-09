<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Exceptions\Entities;

use HraDigital\Datatypes\Exceptions\UnprocessableEntityException;

/**
 * Unexpected value Entity Exception.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
class UnexpectedEntityValueException extends UnprocessableEntityException
{
    /** @var string $message - Exception's error message. */
    protected $message = "Application tried to load one or more unexpected values into the Entity.";

    /** @var string $message - Exception's error message. */
    protected string $messageWithName = "Field '%s' had an unexpected value, while loading into an Entity.";
}
