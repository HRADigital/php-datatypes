<?php declare(strict_types=1);

namespace Hradigital\Datatypes\Traits\Entities\General;

/**
 * Gives Featured information capabilities to an Entity/Value Object.
 *
 * @package   Hradigital\Datatypes
 * @copyright Hradigital\Datatypes
 * @license   Proprietary
 */
trait HasFeatureTrait
{
    /** @var bool $featured - If the record is marked as <b>Featured</b> in the system. */
    protected bool $featured = false;

    /**
     * Sets the FEATURED value of an Entity.
     *
     * @param  bool $featured - New featured value.
     * @return void
     */
    protected function castFeatured(bool $featured): void
    {
        $this->featured = $featured;
    }

    /**
     * Returns TRUE if the record is marked as FEATURED in the system.
     *
     * @return bool
     */
    public function featured(): bool
    {
        return $this->featured;
    }
}
