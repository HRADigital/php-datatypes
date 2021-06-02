<?php declare(strict_types=1);

namespace Hradigital\Datatypes\Exceptions;

/**
 * Abstract Base Domain Exception.
 *
 * This Exception extends the native \Exception directly, and provides basic configuration for all
 * domain related Exceptions.
 *
 * All domain Exceptions should extend this root class.
 * Child Exceptions should only need to override the $message and $code attributes.
 *
 * All child classes that extend this base Exception class, should define as an error code one of the available
 * HTTP status codes.
 *
 * @package   Hradigital\Datatypes
 * @license   MIT
 * @link      https://httpstatuses.com/
 */
abstract class AbstractBaseException extends \Exception
{
    /** @var string $message - Exception's error message. */
    protected $message = "An unspecified error occurred on the server.";

    /** @var int $code - Exception's error code. */
    protected $code = 500;

    /**
     * Initializes the Base Exception.
     *
     * Override native \Exception class, and processes supplied parameters if empty.
     * If supplied parameters are empty, corresponding attribute values will be used instead.
     *
     * @param  string|null    $message - Exception's text message.
     * @param \Exception|null $inner   - Previous Exception in the stack, for Exception's nesting.
     * @return void
     */
    public function __construct(?string $message = null, ?\Exception $inner = null)
    {
        // Validates provided parameters.
        // If no message was supplied, then we'll use whatever values were already set in the class.
        if ($message === null) {
            $message = $this->message;
        }
        $code = $this->code;

        // Calls parent construct() with default code.
        parent::__construct($message, $code, $inner);
    }
}
