<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Exceptions\Datatypes;

use HraDigital\Datatypes\Exceptions\UnprocessableEntityException;

/**
 * Non empty String Datatype Exception.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
class NonEmptyStringException extends UnprocessableEntityException
{
    protected $message = "Supplied parameter must be non empty string.";

    public static function withName(string $name, ?\Exception $inner = null): self
    {
        return new self(
            \sprintf("Parameter '%s' must be a non empty string.", $name),
            $inner
        );
    }
}
