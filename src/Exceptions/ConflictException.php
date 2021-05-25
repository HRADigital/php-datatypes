<?php declare(strict_types=1);

namespace Hradigital\Datatypes\Exceptions;

/**
 * Conflict Base Domain Exception.
 *
 * The 409 (Conflict) status code indicates that the request could not be
 * processed because of conflict in the request, such as an edit conflict.
 *
 * Whenever a resource conflict would be caused by fulfilling the request. Duplicate
 * entries and deleting root objects when cascade-delete is not supported are a couple
 * of examples.
 *
 * @package   Hradigital\Datatypes
 * @license   MIT
 */
class ConflictException extends AbstractBaseException
{
    /** @var string $message - Exception's error message. */
    protected string $message = "The action failed due to a conflict in the provided request.";

    /** @var int $code - Exception's error code. */
    protected int $code = 409;

    /**
     * Initializes Base Conflist Exception.
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
