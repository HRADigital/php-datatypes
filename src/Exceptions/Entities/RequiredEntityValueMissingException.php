<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Exceptions\Entities;

use HraDigital\Datatypes\Exceptions\UnprocessableEntityException;

/**
 * Required Entity Value Missing Exception.
 *
 * This Exception should be raised when an Entity's required field is missing while
 * loading the Entity.
 *
 * When possible, message should be overridden, and missing field should be specified
 * in error message.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
class RequiredEntityValueMissingException extends UnprocessableEntityException
{
    /** @var string $message - Exception's error message. */
    protected $message = "A Required Entity field was missing, while loading.";

    /** @var string $message - Exception's error message with field's name. */
    protected string $messageWithName = "Entity field '%s' was missing, while loading.";
}
