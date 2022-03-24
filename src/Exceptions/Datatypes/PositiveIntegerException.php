<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Exceptions\Datatypes;

use HraDigital\Datatypes\Exceptions\UnprocessableEntityException;

/**
 * Must be a Positive Integer Datatype Exception.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
class PositiveIntegerException extends UnprocessableEntityException
{
    protected $message = "Supplied parameter must be a positive integer.";

    public static function withName(string $name, ?\Exception $inner = null): self
    {
        return new static(
            \sprintf("Parameter '%s' must be a positive integer.", $name),
            $inner
        );
    }
}
