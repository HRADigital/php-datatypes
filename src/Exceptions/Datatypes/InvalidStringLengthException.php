<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Exceptions\Datatypes;

use HraDigital\Datatypes\Exceptions\UnprocessableEntityException;

/**
 * Invalid String's Length Datatype Exception.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
class InvalidStringLengthException extends UnprocessableEntityException
{
    protected $message = "Supplied field doesn't have required character length.";

    public static function withNameAndLength(string $name, int $length, ?\Exception $inner = null): self
    {
        return new self(
            \sprintf("Field '%s' doesn't have minimum required character length of %d.", $name, $length),
            $inner
        );
    }
}
