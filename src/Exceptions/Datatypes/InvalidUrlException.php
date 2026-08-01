<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Exceptions\Datatypes;

use HraDigital\Datatypes\Exceptions\UnprocessableEntityException;

/**
 * Invalid URL Datatype Exception.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
class InvalidUrlException extends UnprocessableEntityException
{
    protected $message = "Provided URL field does not seam to be a valid URL.";

    public static function withValue(string $value, ?\Exception $inner = null): self
    {
        return new static(
            \sprintf("Provided URL '%s' does not seam to be a valid URL.", $value),
            $inner
        );
    }
}
