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
    protected $message = "A Required Entity field was missing, while loading.";

    public static function withName(string $name, ?\Exception $inner = null): self
    {
        return new self(
            \sprintf("Entity field '%s' was missing, while loading.", $name),
            $inner
        );
    }
}
