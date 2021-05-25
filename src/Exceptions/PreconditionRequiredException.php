<?php declare(strict_types=1);

namespace Hradigital\Datatypes\Exceptions;

/**
 * Precondition Required Base Domain Exception.
 *
 * Responses using this status code SHOULD explain how to resubmit the request successfully.
 *
 * @package   Hradigital\Datatypes
 * @license   MIT
 */
class PreconditionRequiredException extends AbstractBaseException
{
    /** @var string $message - Exception's error message. */
    protected string $message = "A given required precondition evaluated to false on the system.";

    /** @var int $code - Exception's error code. */
    protected int $code = 428;

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
