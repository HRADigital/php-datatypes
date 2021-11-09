<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Traits\Entities\SocialMedia;

use HraDigital\Datatypes\Scalar\Str;

/**
 * Adds Twitters's Social Media account URL field.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
trait HasTwitterProfileTrait
{
    /** @var Str|null $twitter - Social Media account's URL. */
    protected ?Str $twitter = null;

    /**
     * Sets the Social Media account URL value of an Entity.
     *
     * @param  string|null $twitter - Social Media account's URL.
     * @return void
     */
    protected function castTwitter(?string $twitter): void
    {
        $this->twitter = $twitter ? Str::create($twitter)->trim() : null;
    }

    /**
     * Retrieves record's Social Media account's URL.
     *
     * @return Str|null
     */
    public function getTwitterUrl(): ?Str
    {
        return $this->twitter;
    }

    /**
     * Is Twitter's Social Media account URL is set.
     *
     * @return bool
     */
    public function hasTwitterProfileUrl(): bool
    {
        return ($this->twitter !== null);
    }
}
