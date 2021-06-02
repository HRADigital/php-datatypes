<?php declare(strict_types=1);

namespace Hradigital\Datatypes\Exceptions;

/**
 * Denied Access Base Domain Exception.
 *
 * The requested resource could not be found but may be available again in the
 * future. Subsequent requests by the client are permissible.
 *
 * Used specifically for use when authentication is required and has failed or
 * has not yet been provided.
 *
 * Semantically means "unauthorised", the user does not have valid authentication
 * credentials for the target resource.
 *
 * @package   Hradigital\Datatypes
 * @copyright Hradigital\Datatypes
 * @license   MIT
 */
class DeniedAccessException extends AbstractBaseException
{
    /** @var string $message - Exception's error message. */
    protected $message = "You don't have access to the resource you are looking for.";

    /** @var int $code - Exception's error code. */
    protected $code = 401;

    /**
     * Initializes Base Denied Access Exception.
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
