<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Traits\Entities\SocialMedia;

/**
 * Adds Instagram's Social Media account URL field.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
trait HasInstagramProfileTrait
{
    /** @var string|null $instagram - Social Media account's URL. */
    protected ?string $instagram = null;

    /**
     * Sets the Social Media account URL value of an Entity.
     *
     * @param  string|null $instagram - Social Media account's URL.
     * @return void
     */
    protected function castInstagram(?string $instagram): void
    {
        $this->instagram = $instagram;
    }

    /**
     * Retrieves record's Social Media account's URL.
     *
     * @return string|null
     */
    public function getInstagramUrl(): ?string
    {
        return $this->instagram;
    }

    /**
     * Is Instagram's Social Media account URL is set.
     *
     * @return bool
     */
    public function hasInstagramProfileUrl(): bool
    {
        return ($this->instagram !== null);
    }
}
