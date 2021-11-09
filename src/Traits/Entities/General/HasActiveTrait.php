<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Traits\Entities\General;

/**
 * Gives Activation information capabilities to an Entity/Value Object.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   Proprietary
 */
trait HasActiveTrait
{
    /** @var bool $active - If the record is marked as ACTIVE in the system. */
    protected bool $active = false;

    /**
     * Sets the active value of an Entity.
     *
     * @param  bool $active - New active value.
     * @return void
     */
    protected function castActive(bool $active): void
    {
        $this->active = $active;
    }

    /**
     * Returns TRUE if the record is marked as ACTIVE in the system.
     *
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }
}
