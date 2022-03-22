<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Exceptions;

/**
 * Too Many Requests Base Domain Exception.
 *
 * The 429 status code indicates that the user has sent too many requests
 * in a given amount of time ("rate limiting").
 *
 * The response representations SHOULD include details explaining the condition,
 * and MAY include a Retry-After header indicating how long to wait before making
 * a new request.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
class TooManyRequestsException extends AbstractBaseException
{
    protected $message = "Too many requests have been made to the system.";
    protected $code = 429;

    /**
     * Initializes Base Too Many Requests Exception.
     *
     * Message and code values will be collected from defined class attributes.
     * You will only need to define an optional Inner Exceptions.
     *
     * @param \Exception|null $inner - Optional previous Exception in the stack, for Exception's nesting.
     * @return void
     */
    public function __construct(?\Exception $inner = null)
    {
        parent::__construct(null, $inner);
    }
}
