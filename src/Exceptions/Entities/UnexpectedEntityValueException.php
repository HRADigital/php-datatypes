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
    protected $message = "Application tried to load one or more unexpected values into the Entity.";

    public static function withName(string $name, ?\Exception $inner = null): self
    {
        return new self(
            \sprintf("Field '%s' had an unexpected value, while loading into an Entity.", $name),
            $inner
        );
    }
}
