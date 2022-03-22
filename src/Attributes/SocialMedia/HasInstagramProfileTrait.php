<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Attributes\SocialMedia;

use HraDigital\Datatypes\Scalar\Str;

/**
 * Adds Instagram's Social Media account URL field.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
trait HasInstagramProfileTrait
{
    /** @var Str|null $instagram - Social Media account's URL. */
    protected ?Str $instagram = null;

    /**
     * Sets the Social Media account URL value of an Entity.
     *
     * @param  string|null $instagram - Social Media account's URL.
     * @return void
     */
    protected function castInstagram(?string $instagram): void
    {
        $this->instagram = $instagram ? Str::create($instagram)->trim() : null;
    }

    /**
     * Retrieves record's Social Media account's URL.
     *
     * @return Str|null
     */
    public function getInstagramUrl(): ?Str
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
