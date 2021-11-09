<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Traits\Entities\General;

use HraDigital\Datatypes\Datetime\Datetime;
use HraDigital\Datatypes\Scalar\Str;

/**
 * Trait for an Updatable Record UpdatedAt attribute.
 *
 * Provides an onUpdate handler, on top of existing HasUpdatedAtTrait.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
trait HasUpdatableUpdatedAtTrait
{
    use HasUpdatedAtTrait;

    /**
     * Event handler to be called when the record has been updated successfully.
     *
     * @return void
     */
    protected function onUpdateRecalculateUpdatedAt(): void
    {
        $this->updated_at = Datetime::now();
    }
}
