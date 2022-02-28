<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Traits\Entities\General;

/**
 * Gives Publishing capabilities to an Entity/Value Object.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
trait HasPublishedTrait
{
    /** @var bool $published - If the record is marked as Published for the frontend. */
    protected bool $is_published = false;

    /**
     * Sets the published value of an Entity/Value Object.
     *
     * @param  bool $published - New published value.
     * @return void
     */
    protected function castIsPublished(bool $published): void
    {
        $this->is_published = $published;
    }

    /**
     * Returns TRUE if the record is marked as PUBLISHED for the frontend.
     *
     * @return bool
     */
    public function isPublished(): bool
    {
        return $this->is_published;
    }
}
