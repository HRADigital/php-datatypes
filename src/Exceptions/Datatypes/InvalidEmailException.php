<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Exceptions\Datatypes;

use HraDigital\Datatypes\Exceptions\UnprocessableEntityException;

/**
 * Invalid E-mail Datatype Exception.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
class InvalidEmailException extends UnprocessableEntityException
{
    protected $message = "Provided e-mail field does not seam to be a valid e-mail address.";

    public static function withName(string $name, ?\Exception $inner = null): self
    {
        return new self(
            \sprintf("Provided e-mail '%s' does not seam to be a valid e-mail address.", $name),
            $inner
        );
    }
}
