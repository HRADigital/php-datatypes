<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Web\Seo;

use HraDigital\Datatypes\Exceptions\Datatypes\NonEmptyStringException;

use function trim;

/**
 * Aggregate of every SEO/social field a page can expose. Consumers populate
 * the slots they have data for; rendering layers skip null/empty values.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
class SeoMetadata
{
    public readonly string $title;
    public readonly string $description;
    public readonly string $url;
    public readonly string $siteName;
    public readonly string $locale;
    public readonly OpenGraphType $type;
    public readonly TwitterCardType $twitterCard;
    public readonly ?SocialImage $image;
    public readonly ?ArticleMetadata $article;
    public readonly ?string $canonicalUrl;
    public readonly bool $robotsIndex;
    public readonly bool $robotsFollow;

    public static function create(
        string $title,
        string $description,
        string $url,
        string $siteName,
        string $locale,
        OpenGraphType $type = OpenGraphType::Website,
        ?TwitterCardType $twitterCard = null,
        ?SocialImage $image = null,
        ?ArticleMetadata $article = null,
        ?string $canonicalUrl = null,
        bool $robotsIndex = true,
        bool $robotsFollow = true,
    ): SeoMetadata {
        return new SeoMetadata(
            $title,
            $description,
            $url,
            $siteName,
            $locale,
            $type,
            $twitterCard,
            $image,
            $article,
            $canonicalUrl,
            $robotsIndex,
            $robotsFollow,
        );
    }

    private function __construct(
        string $title,
        string $description,
        string $url,
        string $siteName,
        string $locale,
        OpenGraphType $type,
        ?TwitterCardType $twitterCard,
        ?SocialImage $image,
        ?ArticleMetadata $article,
        ?string $canonicalUrl,
        bool $robotsIndex,
        bool $robotsFollow,
    ) {
        $title       = trim($title);
        $description = trim($description);
        $url         = trim($url);
        $siteName    = trim($siteName);
        $locale      = trim($locale);

        if ($title === '') {
            throw NonEmptyStringException::withName('$title');
        }
        if ($description === '') {
            throw NonEmptyStringException::withName('$description');
        }
        if ($url === '') {
            throw NonEmptyStringException::withName('$url');
        }
        if ($siteName === '') {
            throw NonEmptyStringException::withName('$siteName');
        }
        if ($locale === '') {
            throw NonEmptyStringException::withName('$locale');
        }

        // If caller didn't choose, derive the card layout from the image presence.
        $card = $twitterCard ?? ($image !== null
            ? TwitterCardType::SummaryLargeImage
            : TwitterCardType::Summary);

        $this->title        = $title;
        $this->description  = $description;
        $this->url          = $url;
        $this->siteName     = $siteName;
        $this->locale       = $locale;
        $this->type         = $type;
        $this->twitterCard  = $card;
        $this->image        = $image;
        $this->article      = $article;
        $this->canonicalUrl = $canonicalUrl !== null ? trim($canonicalUrl) : null;
        $this->robotsIndex  = $robotsIndex;
        $this->robotsFollow = $robotsFollow;
    }

    public function withImage(SocialImage $image): SeoMetadata
    {
        return new SeoMetadata(
            $this->title,
            $this->description,
            $this->url,
            $this->siteName,
            $this->locale,
            $this->type,
            $this->twitterCard,
            $image,
            $this->article,
            $this->canonicalUrl,
            $this->robotsIndex,
            $this->robotsFollow,
        );
    }

    public function withArticle(ArticleMetadata $article): SeoMetadata
    {
        return new SeoMetadata(
            $this->title,
            $this->description,
            $this->url,
            $this->siteName,
            $this->locale,
            OpenGraphType::Article,
            $this->twitterCard,
            $this->image,
            $article,
            $this->canonicalUrl,
            $this->robotsIndex,
            $this->robotsFollow,
        );
    }

    public function robotsDirective(): string
    {
        return ($this->robotsIndex ? 'index' : 'noindex')
            . ',' . ($this->robotsFollow ? 'follow' : 'nofollow');
    }
}
