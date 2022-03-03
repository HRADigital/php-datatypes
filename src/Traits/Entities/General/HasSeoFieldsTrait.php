<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Traits\Entities\General;

use HraDigital\Datatypes\Exceptions\Datatypes\InvalidStringLengthException;
use HraDigital\Datatypes\Exceptions\Datatypes\NonEmptyStringException;
use HraDigital\Datatypes\Scalar\Str;

/**
 * Gives Seo Title, Seo Description and Seo Keywords information capabilities to an Entity/Value Object.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
trait HasSeoFieldsTrait
{
    /** @var Str|null $seo_title - Record's Seo title option. */
    protected ?Str $seo_title = null;

    /** @var Str|null $seo_description - Record's Seo description option. */
    protected ?Str $seo_description = null;

    /** @var Str|null $seo_keywords - Record's Seo keywords option. */
    protected ?Str $seo_keywords = null;

    /**
     * Checking the character limitations of the <seo_title>.
     * Setting the <seo_title> value.
     *
     * @param string|null $title - New value to be set on Attribute.
     *
     * @throws InvalidStringLengthException - Supplied Seo Title must be a non empty string.
     *
     * @link  https://seopressor.com/blog/google-title-meta-descriptions-length
     * @return void
     */
    protected function castSeoTitle(?string $title = null): void
    {
        // Setting the max length for Seo description.
        $titleValue = ($title ? Str::create($title)->trim() : null);

        if ($titleValue !== null && $titleValue->getLength() > 70) {
            throw InvalidStringLengthException::withNameAndLength("Seo title", 70);
        }

        $this->seo_title = $this->seoSanitize($titleValue);
    }

    /**
     * Checking the character limitations of the <seo_description>.
     * Setting the <seo_description> value.
     *
     * @param string|null $description - New value to be set on Attribute.
     *
     * @throws InvalidStringLengthException - Supplied Seo Description must be a non empty string.
     *
     * @link  https://seopressor.com/blog/google-title-meta-descriptions-length
     * @return void
     */
    protected function castSeoDescription(?string $description = null): void
    {
        // Setting the max length for Seo description.
        $descriptionValue = ($description ? Str::create($description) : null);

        if ($descriptionValue !== null && $descriptionValue->trim()->getLength() > 160) {
            throw InvalidStringLengthException::withNameAndLength("Seo description", 160);
        }

        $this->seo_description = $this->seoSanitize($descriptionValue);
    }

    /**
     * Checking the character limitations of the <seo_keywords>.
     * Setting the <seo_keywords> value.
     *
     * @param string|null $keywords - New value to be set on Attribute.
     *
     * @throws InvalidStringLengthException - Supplied Seo Keywords must be a non empty string.
     *
     * @link  https://www.quora.com/What-is-the-minimum-length-of-a-meta-keyword-in-on-page-SEO
     * @return void
     */
    protected function castSeoKeywords(string $keywords = null): void
    {
        // Setting the max length for Seo keywords.
        $keywordsValue = ($keywords ? Str::create($keywords) : null);

        if ($keywordsValue !== null && $keywordsValue->trim()->getLength() > 255) {
            throw InvalidStringLengthException::withNameAndLength("Seo keywords", 255);
        }

        $this->seo_keywords = $this->seoSanitize($keywordsValue);
    }

    /**
     * Returns the Entity's seo title.
     *
     * @return Str|null
     */
    public function getSeoTitle(): ?Str
    {
        // If the Seo title is not set it is set to name property.
        if ($this->seo_title === null || $this->seo_title->trim()->getLength() === 0) {
            return ( \property_exists($this, 'name') ? $this->{'name'} : null );
        }

        return $this->seo_title;
    }

    /**
     * Returns the Entity's seo description.
     *
     * @return Str|null
     */
    public function getSeoDescription(): ?Str
    {
        return $this->seo_description;
    }

    /**
     * Returns the Entity's seo keywords.
     *
     * @return Str|null
     */
    public function getSeoKeywords(): ?Str
    {
        return $this->seo_keywords;
    }

    /**
     * Sanitizes the individual Seo field in the Entity.
     *
     * @param  Str|null $seoField - New Hit's value.
     * @return Str|null
     */
    private function seoSanitize(?Str $seoField = null): ?Str
    {
        // Checking if the value is an empty string or a string made of spaces.
        if ($seoField !== null && $seoField->trim()->getLength() === 0) {
            $seoField = null;
        }

        // If there is a valid string trimming the spaces form the beginning and the end.
        if ($seoField !== null) {
            $seoField = $seoField->trim();
        }

        return $seoField;
    }
}
