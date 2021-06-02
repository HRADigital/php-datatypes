<?php declare(strict_types=1);

namespace Hradigital\Datatypes\Exceptions;

/**
 * Not Acceptable Base Domain Exception.
 *
 * The resource identified by the request is only capable of generating
 * response entities which have content characteristics not acceptable
 * according to the accept headers sent in the request.
 *
 * Use this Exception where it makes semanticle sense, even if not making
 * total technical sense.
 *
 * @package   Hradigital\Datatypes
 * @license   MIT
 */
class NotAcceptableException extends AbstractBaseException
{
    /** @var string $message - Exception's error message. */
    protected $message = "The operation you're trying to perform, is not acceptable.";

    /** @var int $code - Exception's error code. */
    protected $code = 406;

    /**
     * Initializes Base Not Acceptable Exception.
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
