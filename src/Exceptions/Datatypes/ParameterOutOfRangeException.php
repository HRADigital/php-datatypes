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
    /** @var string $message - Exception's error message. */
    protected $message = "Supplied parameter is out of range.";

    /** @var string $message - Exception's error message with field's name. */
    protected string $messageWithName = "Parameter '%s' is out of expected range.";
}
