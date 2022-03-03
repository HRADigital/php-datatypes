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
    protected $message = "The request was well-formed but was unable to be followed due to semantic errors.";
    protected $code = 422;

    /**
     * Initializes Base Unprocessable Entity Exception.
     *
     * Code value will be collected from defined class attribute.
     *
     * @param  string          $name  - Attribute's name that could't be processed.
     * @param  \Exception|null $inner - Optional previous Exception in the stack, for Exception's nesting.
     * @return self
     */
    public static function withName(string $name, ?\Exception $inner = null): self
    {
        return new self(
            \sprintf("The request was well-formed but was unable to be followed due to field '%s'.", $name),
            $inner
        );
    }
}
