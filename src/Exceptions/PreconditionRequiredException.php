<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Exceptions;

/**
 * Precondition Required Base Domain Exception.
 *
 * Responses using this status code SHOULD explain how to resubmit the request successfully.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
class PreconditionRequiredException extends AbstractBaseException
{
    protected $message = "A given required precondition evaluated to false on the system.";
    protected $code = 428;

    /**
     * Initializes Base Precondition Required Exception.
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
