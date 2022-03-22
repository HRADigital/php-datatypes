<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Attributes\SocialMedia;

use HraDigital\Datatypes\Scalar\Str;

/**
 * Adds Facebook's Social Media account URL field.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
trait HasFacebookProfileTrait
{
    /** @var Str|null $facebook - Social Media account's URL. */
    protected ?Str $facebook = null;

    /**
     * Sets the Social Media account URL value of an Entity.
     *
     * @param  string|null $facebook - Social Media account's URL.
     * @return void
     */
    protected function castFacebook(?string $facebook): void
    {
        $this->facebook = $facebook ? Str::create($facebook)->trim() : null;
    }

    /**
     * Retrieves record's Social Media account's URL.
     *
     * @return Str|null
     */
    public function getFacebookUrl(): ?Str
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
