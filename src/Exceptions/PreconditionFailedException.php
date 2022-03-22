<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Exceptions;

/**
 * Precondition Base Domain Exception.
 *
 * The precondition given in one or more of the request-header fields evaluated
 * to false when it was tested on the server.
 *
 * This response code allows the client to place preconditions on the current
 * resource meta-information (header field data) and thus prevent the requested
 * method from being applied to a resource other than the one intended.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
class PreconditionFailedException extends AbstractBaseException
{
    protected $message = "A given precondition evaluated to false on the system.";
    protected $code = 412;

    /**
     * Initializes Base Precondition Failed Exception.
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
