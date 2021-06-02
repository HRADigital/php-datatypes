<?php declare(strict_types=1);

namespace Hradigital\Datatypes\Exceptions;

/**
 * Not Found Base Domain Exception.
 *
 * The requested resource could not be found but may be available again in the
 * future. Subsequent requests by the client are permissible.
 *
 * Used when the requested resource is not found/doesn't exist.
 *
 * @package   Hradigital\Datatypes
 * @copyright Hradigital\Datatypes
 * @license   MIT
 */
class NotFoundException extends AbstractBaseException
{
    /** @var string $message - Exception's error message. */
    protected $message = "The resource you are looking for, was not found in the system.";

    /** @var string $message - Exception's error message when a record ID is specified. */
    protected string $messageWithId = "The resource with the ID %d you are looking for, was not found in the system.";

    /** @var int $code - Exception's error code. */
    protected $code = 404;

    /**
     * Initializes Base NotFound Exception.
     *
     * Code value will be collected from defined class attribute.
     *
     * @param  int|null        $id    - Optional record ID that was not found in the system.
     * @param  \Exception|null $inner - Optional previous Exception in the stack, for Exception's nesting.
     * @return void
     */
    public function __construct(?int $id = null, ?\Exception $inner = null)
    {
        parent::__construct(
            ($id !== null ? \sprintf($this->messageWithId, $id) : $this->message),
            $inner
        );
    }
}
