<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Attributes\General;

/**
 * Gives Featured information capabilities to an Entity/Value Object.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
trait HasFeatureTrait
{
    /** @var bool $is_featured - If the record is marked as Featured in the system. */
    protected bool $is_featured = false;

    /**
     * Sets the FEATURED value of an Entity.
     *
     * @param  bool $featured - New featured value.
     * @return void
     */
    protected function castIsFeatured(bool $featured): void
    {
        $this->is_featured = $featured;
    }

    /**
     * Returns TRUE if the record is marked as FEATURED in the system.
     *
     * @return bool
     */
    public function isFeatured(): bool
    {
        return $this->is_featured;
    }
}
