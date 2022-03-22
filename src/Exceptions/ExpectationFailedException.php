<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Exceptions;

/**
 * Expectation Failed Base Domain Exception.
 *
 * The expectation given in an Expect request-header field could not be met
 * by this server, or, if the server is a proxy, the server has unambiguous
 * evidence that the request could not be met by the next-hop server.
 *
 * Use this Exception where it makes semanticle sense, even if not making
 * total technical sense.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
class ExpectationFailedException extends AbstractBaseException
{
    protected $message = "The operation failed due to a previous Expectation not being met.";
    protected $code = 417;

    /**
     * Initializes Base Expectation Failed Exception.
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
