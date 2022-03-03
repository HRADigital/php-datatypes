<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Exceptions\Datatypes;

use HraDigital\Datatypes\Exceptions\UnprocessableEntityException;

/**
 * Invalid Date Interval Datatype Exception.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
class InvalidDateIntervalException extends UnprocessableEntityException
{
    protected $message = "Provided interval field does not seam to be a valid DateInterval string.";

    public static function withName(string $name, ?\Exception $inner = null): self
    {
        return new self(
            \sprintf("Provided Interval '%s' does not seam to be a valid DateInterval string.", $name),
            $inner
        );
    }
}
