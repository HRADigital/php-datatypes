<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Exceptions;

/**
 * Unsupported Media Type Base Domain Exception.
 *
 * The 415 (Unsupported Media Type) status code indicates that the request could not be
 * processed because of an unsupported MediaType in the request.
 *
 * The request entity has a media type which the server or resource does not support.
 * For example, the client uploads an image as image/svg+xml, but the server requires
 * that images use a different format.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
class UnsupportedMediaTypeException extends AbstractBaseException
{
    protected $message = "The supplied MediaType is not supported by the system.";
    protected $code = 415;

    /**
     * Initializes Base Unsupported Media Type Exception.
     *
     * Code value will be collected from defined class attribute.
     *
     * @param  string          $name  - Media type name that is not supported.
     * @param  \Exception|null $inner - Optional previous Exception in the stack, for Exception's nesting.
     * @return self
     */
    public static function withName(string $name, ?\Exception $inner = null): self
    {
        return new self(
            \sprintf("MediaType '%s' is not supported by the system.", $name),
            $inner
        );
    }
}
