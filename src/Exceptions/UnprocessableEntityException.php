<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Exceptions;

/**
 * The request was well-formed but was unable to be followed due to semantic errors.
 *
 * The 422 (Unprocessable Entity) status code means the server understands the content
 * type of the request entity (hence a 415(Unsupported Media Type) status code is inappropriate),
 * and the syntax of the request entity is correct (thus a 400 (Bad Request) status code is
 * inappropriate) but was unable to process the contained instructions.
 *
 * For example, this error condition may occur if an XML request body contains well-formed
 * (i.e., syntactically correct), but semantically erroneous, XML instructions.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
class UnprocessableEntityException extends AbstractBaseException
{
    /** @var string $message - Exception's error message. */
    protected $message = "The request was well-formed but was unable to be followed due to semantic errors.";

    /** @var string $messageWithName - Exception's error message when an attribute name is supplied. */
    protected string $messageWithName = "The request was well-formed but was unable to be followed due to field '%s'.";

    /** @var int $code - Exception's error code. */
    protected $code = 422;

    /**
     * Initializes Base Unprocessable Entity Exception.
     *
     * Code value will be collected from defined class attribute.
     *
     * @param  string|null     $name  - Optional attribute name that could't be processed.
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
