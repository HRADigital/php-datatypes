<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Exceptions\Collections;

use HraDigital\Datatypes\Exceptions\UnprocessableEntityException;

/**
 * Duplicated Entry Collection Exception.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
class DuplicatedEntryException extends UnprocessableEntityException
{
    protected $message = "Provided entry was already added to Collection.";

    public static function withId(int $id, ?\Exception $inner = null): self
    {
        return new self(
            \sprintf("Provided entry with ID '%d' was already added to Collection.", $id),
            $inner
        );
    }
}
