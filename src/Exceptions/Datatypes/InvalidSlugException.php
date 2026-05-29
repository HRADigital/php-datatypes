<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Exceptions\Datatypes;

use HraDigital\Datatypes\Exceptions\UnprocessableEntityException;

/**
 * Invalid Slug Datatype Exception.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
class InvalidSlugException extends UnprocessableEntityException
{
    protected $message = "Provided slug field does not match the required format.";

    public static function withValue(string $value, ?\Exception $inner = null): self
    {
        return new static(
            \sprintf("Provided slug '%s' does not match the required format.", $value),
            $inner
        );
    }
}
