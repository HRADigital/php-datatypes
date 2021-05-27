<?php declare(strict_types=1);

namespace Hradigital\Datatypes\Traits\Entities\General;

/**
 * Gives Timestamp capabilities to a Record.
 *
 * Adds CreatedAt and UpdatedAt capabilities, at the same time, to an Entity/Value Object.
 *
 * @package   Hradigital\Datatypes
 * @copyright Hradigital\Datatypes
 * @license   Proprietary
 */
trait HasTimestampsTrait
{
    use HasCreatedAtTrait,
        HasUpdatedAtTrait;
}
