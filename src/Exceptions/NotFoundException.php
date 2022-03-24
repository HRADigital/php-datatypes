<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Exceptions;

/**
 * Not Found Base Domain Exception.
 *
 * The requested resource could not be found but may be available again in the
 * future. Subsequent requests by the client are permissible.
 *
 * Used when the requested resource is not found/doesn't exist.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
class NotFoundException extends AbstractBaseException
{
    protected $message = "The resource you are looking for, was not found in the system.";
    protected $code = 404;

    /**
     * Initializes Base Record Not Found Exception.
     *
     * Code value will be collected from defined class attribute.
     *
     * @param  int $id
     * @param \Exception|null $inner
     * @return self
     */
    public static function withId(int $id, ?\Exception $inner = null): self
    {
        return new static(
            \sprintf("The resource with the ID %d you are looking for, was not found in the system.", $id),
            $inner
        );
    }
}
