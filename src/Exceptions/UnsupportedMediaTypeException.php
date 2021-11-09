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
    /** @var string $message - Exception's error message. */
    protected $message = "The supplied MediaType is not supported by the system.";

    /** @var string $message - Exception's error message when Media Type is supplied. */
    protected string $messageWithName = "MediaType '%s' is not supported by the system.";

    /** @var int $code - Exception's error code. */
    protected $code = 415;

    /**
     * Initializes Base Unsupported Media Type Exception.
     *
     * Code value will be collected from defined class attribute.
     *
     * @param  string|null     $name  - Optional media type name that is not supported.
     * @param  \Exception|null $inner - Optional previous Exception in the stack, for Exception's nesting.
     * @return void
     */
    public function __construct(?string $name = null, ?\Exception $inner = null)
    {
        parent::__construct(
            ($name !== null ? \sprintf($this->messageWithName, $name) : $this->message),
            $inner
        );
    }
}
