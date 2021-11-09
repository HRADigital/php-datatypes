<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Traits\Entities\General;

/**
 * Gives Timestamp capabilities to a Record.
 *
 * Adds CreatedAt and UpdatedAt capabilities, at the same time, to an Entity/Value Object.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
trait HasTimestampsTrait
{
    use HasCreatedAtTrait,
        HasUpdatedAtTrait;
}
