<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Traits\Entities\SocialMedia;

/**
 * Adds Facebook's Social Media account URL field.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   Proprietary
 */
trait HasFacebookProfileTrait
{
    /** @var string|null $facebook - Social Media account's URL. */
    protected ?string $facebook = null;

    /**
     * Sets the Social Media account URL value of an Entity.
     *
     * @param  string|null $facebook - Social Media account's URL.
     * @return void
     */
    protected function castFacebook(?string $facebook): void
    {
        $this->facebook = $facebook;
    }

    /**
     * Retrieves record's Social Media account's URL.
     *
     * @return string|null
     */
    public function getFacebookUrl(): ?string
    {
        return $this->facebook;
    }

    /**
     * Is Facebook's Social Media account URL is set.
     *
     * @return bool
     */
    public function hasFacebookProfileUrl(): bool
    {
        return ($this->facebook !== null);
    }
}
