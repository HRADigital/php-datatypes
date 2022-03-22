<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Exceptions;

/**
 * Method Not Allowed Base Domain Exception.
 *
 * The 405 (Method Not Allowed) status code indicates that the request could not be
 * processed because of a resource using a request method not supported by
 * that resource; for example, using GET on a form which requires data to be
 * presented via POST, or using PUT on a read-only resource.
 *
 * The method specified in the Request-Line is not allowed for the resource
 * identified by the Request-URI. The response MUST include an Allow header
 * containing a list of valid methods for the requested resource.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
class MethodNotAllowedException extends AbstractBaseException
{
    protected $message = "The action failed due using a request method not supported by that resource.";
    protected $code = 405;

    /**
     * Initializes Base Method not Allowed Exception.
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
