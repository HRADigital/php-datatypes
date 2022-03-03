<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Exceptions\Datatypes;

use HraDigital\Datatypes\Exceptions\UnprocessableEntityException;

/**
 * Out of Range value Datatype Exception.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
class ParameterOutOfRangeException extends UnprocessableEntityException
{
    protected $message = "Supplied parameter is out of range.";

    public static function withName(string $name, ?\Exception $inner = null): self
    {
        return new self(
            \sprintf("Parameter '%s' is out of expected range.", $name),
            $inner
        );
    }
}
