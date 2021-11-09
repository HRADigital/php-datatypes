<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Exceptions;

/**
 * Failed Dependency Base Domain Exception.
 *
 * The 424 (Failed Dependency) status code means that the method could not be
 * performed on the resource because the requested action depended on another
 * action and that action failed.
 *
 * For example, if a command in a PROPPATCH method fails, then, at minimum,
 * the rest of the commands will also fail with 424 (Failed Dependency).
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
class FailedDependencyException extends AbstractBaseException
{
    /** @var string $message - Exception's error message. */
    protected $message = "The action failed due to failure of a previous action.";

    /** @var int $code - Exception's error code. */
    protected $code = 424;

    /**
     * Initializes Base Conflist Exception.
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
