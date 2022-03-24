<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Exceptions\Datatypes;

use HraDigital\Datatypes\Exceptions\UnprocessableEntityException;

/**
 * Must be a Non Negative Number Datatype Exception.
 *
 * Only Zero or more should be allowed.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
class NonNegativeNumberException extends UnprocessableEntityException
{
    protected $message = "Supplied parameter must be a non negative number.";

    public static function withName(string $name, ?\Exception $inner = null): self
    {
        return new static(
            \sprintf("Parameter '%s' must be a non negative number.", $name),
            $inner
        );
    }
}
