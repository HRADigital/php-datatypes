<?php declare(strict_types=1);

namespace Hradigital\Datatypes\Traits\Entities\General;

/**
 * Gives Publishing capabilities to an Entity/Value Object.
 *
 * @package   Hradigital\Datatypes
 * @copyright Hradigital\Datatypes
 * @license   Proprietary
 */
trait HasPublishedTrait
{
    /** @var bool $published - If the record is marked as Published for the frontend. */
    protected bool $published = false;

    /**
     * Sets the published value of an Entity/Value Object.
     *
     * @param  bool $published - New published value.
     * @return void
     */
    protected function castPublished(bool $published): void
    {
        $this->published = $published;
    }

    /**
     * Returns TRUE if the record is marked as PUBLISHED for the frontend.
     *
     * @return bool
     */
    public function published(): bool
    {
        return $this->published;
    }
}
