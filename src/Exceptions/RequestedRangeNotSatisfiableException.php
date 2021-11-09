<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Exceptions;

/**
 * Requested Range is Not Satisfiable Domain Exception.
 *
 * None of the ranges in the request's Range header field1 overlap the
 * current extent of the selected resource or that the set of ranges
 * requested has been rejected due to invalid ranges or an excessive
 * request of small or overlapping ranges.
 *
 * Use this Exception where it makes semanticle sense, even if not making
 * total technical sense.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
class RequestedRangeNotSatisfiableException extends AbstractBaseException
{
    /** @var string $message - Exception's error message. */
    protected $message = "The requested range for the operation you're trying to perform, is not satisfiable.";

    /** @var int $code - Exception's error code. */
    protected $code = 416;

    /**
     * Initializes Base Requested Range is Not Satisfiable Exception.
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
