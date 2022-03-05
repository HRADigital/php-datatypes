<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Exceptions;

/**
 * Record Gone Base Domain Exception.
 *
 * The requested resource existed once in the system, but is no longer available.
 * Subsequent requests by the client are permissible.
 *
 * Used when the requested resource is gone already.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
class GoneException extends AbstractBaseException
{
    protected $message = "The resource you are looking for, is no longer available in the system.";
    protected $code = 410;

    /**
     * Initializes Base Record Gone Exception.
     *
     * Code value will be collected from defined class attribute.
     *
     * @param  int $id
     * @param \Exception|null $inner
     * @return self
     */
    public static function withId(int $id, ?\Exception $inner = null): self
    {
        return new self(
            \sprintf("The resource with the ID %d no longer exists in the system.", $id),
            $inner
        );
    }
}
