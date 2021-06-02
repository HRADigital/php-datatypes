<?php declare(strict_types=1);

namespace Hradigital\Datatypes\Exceptions;

/**
 * Record Gone Base Domain Exception.
 *
 * The requested resource existed once in the system, but is no longer available.
 * Subsequent requests by the client are permissible.
 *
 * Used when the requested resource is gone already.
 *
 * @package   Hradigital\Datatypes
 * @license   MIT
 */
class GoneException extends AbstractBaseException
{
    /** @var string $message - Exception's error message. */
    protected $message = "The resource you are looking for, is no longer available in the system.";

    /** @var string $message - Exception's error message when a record ID is specified. */
    protected string $messageWithId = "The resource with the ID %d no longer exists in the system.";

    /** @var int $code - Exception's error code. */
    protected $code = 410;

    /**
     * Initializes Base Record Gone Exception.
     *
     * Code value will be collected from defined class attribute.
     *
     * @param  int|null        $id    - Optional record ID that was already erased from the system.
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
