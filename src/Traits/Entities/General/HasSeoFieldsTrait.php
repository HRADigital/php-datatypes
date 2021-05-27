<?php declare(strict_types=1);

namespace Hradigital\Datatypes\Traits\Entities\General;

use Hradigital\Datatypes\Exceptions\Datatypes\InvalidStringLengthException;

/**
 * Gives Seo Title, Seo Description and Seo Keywords information capabilities to an Entity/Value Object.
 *
 * @package   Hradigital\Datatypes
 * @copyright Hradigital\Datatypes
 * @license   Proprietary
 */
trait HasSeoFieldsTrait
{
    /** @var string|null $seo_title - Record's Seo title option. */
    protected ?string $seo_title = null;

    /** @var string|null $seo_description - Record's Seo description option. */
    protected ?string $seo_description = null;

    /** @var string|null $seo_keywords - Record's Seo keywords option. */
    protected ?string $seo_keywords = null;

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
        if ($title !== null && \strlen(\trim($title)) > 70) {
            throw new InvalidStringLengthException("Supplied Seo title must have length up to 70 characters.");
        }

        $this->seo_title = $this->seoSanitize($title);
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
        if ($description !== null && \strlen(\trim($description)) > 160) {
            throw new InvalidStringLengthException("Supplied Seo description must have length up to 160 characters.");
        }

        $this->seo_description = $this->seoSanitize($description);
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
        if ($keywords !== null && \strlen(\trim($keywords)) > 255) {
            throw new InvalidStringLengthException("Supplied Seo keywords must have length up to 255 characters.");
        }

        $this->seo_keywords = $this->seoSanitize($keywords);
    }

    /**
     * Returns the Entity's seo title.
     *
     * @return string|null
     */
    public function seoTitle(): ?string
    {
        // If the Seo title is not set it is set to name property.
        if ($this->seo_title === null || \strlen(\trim($this->seo_title)) === 0) {
            return ( \property_exists($this, 'name') ? $this->{'name'} : null );
        }

        return $this->seo_title;
    }

    /**
     * Returns the Entity's seo description.
     *
     * @return string|null
     */
    public function seoDescription(): ?string
    {
        return $this->seo_description;
    }

    /**
     * Returns the Entity's seo keywords.
     *
     * @return string|null
     */
    public function seoKeywords(): ?string
    {
        return $this->seo_keywords;
    }

    /**
     * Sanitizes the individual Seo field in the Entity.
     *
     * @param  string|null $seoField - New Hit's value.
     * @return string|null
     */
    private function seoSanitize(?string $seoField = null): ?string
    {
        // Checking if the value is an empty string or a string made of spaces.
        if ($seoField !== null && \strlen(\trim($seoField)) === 0) {
            $seoField = null;
        }

        // If there is a valid string trimming the spaces form the beginning and the end.
        if ($seoField !== null) {
            $seoField = \trim($seoField);
        }

        return $seoField;
    }
}
