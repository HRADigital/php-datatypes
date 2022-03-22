<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Attributes\SocialMedia;

use HraDigital\Datatypes\Scalar\Str;

/**
 * Adds Linkedin's Social Media account URL field.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
trait HasLinkedinProfileTrait
{
    /** @var Str|null $linkedin - Social Media account's URL. */
    protected ?Str $linkedin = null;

    /**
     * Sets the Social Media account URL value of an Entity.
     *
     * @param  string|null $linkedin - Social Media account's URL.
     * @return void
     */
    protected function castLinkedin(?string $linkedin): void
    {
        $this->linkedin = $linkedin ? Str::create($linkedin)->trim() : null;
    }

    /**
     * Retrieves record's Social Media account's URL.
     *
     * @return Str|null
     */
    public function getLinkedinUrl(): ?Str
    {
        return $this->linkedin;
    }

    /**
     * Is Linkedin's Social Media account URL is set.
     *
     * @return bool
     */
    public function hasLinkedinProfileUrl(): bool
    {
        return ($this->linkedin !== null);
    }
}
