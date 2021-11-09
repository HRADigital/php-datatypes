<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Traits\Entities\SocialMedia;

/**
 * Adds Linkedin's Social Media account URL field.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   Proprietary
 */
trait HasLinkedinProfileTrait
{
    /** @var string|null $linkedin - Social Media account's URL. */
    protected ?string $linkedin = null;

    /**
     * Sets the Social Media account URL value of an Entity.
     *
     * @param  string|null $linkedin - Social Media account's URL.
     * @return void
     */
    protected function castLinkedin(?string $linkedin): void
    {
        $this->linkedin = $linkedin;
    }

    /**
     * Retrieves record's Social Media account's URL.
     *
     * @return string|null
     */
    public function getLinkedinUrl(): ?string
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
