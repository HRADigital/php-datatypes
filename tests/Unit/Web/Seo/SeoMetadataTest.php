<?php

declare(strict_types=1);

namespace HraDigital\Tests\Datatypes\Unit\Web\Seo;

use DateTimeImmutable;
use HraDigital\Datatypes\Exceptions\Datatypes\NonEmptyStringException;
use HraDigital\Datatypes\Web\Seo\ArticleMetadata;
use HraDigital\Datatypes\Web\Seo\OpenGraphType;
use HraDigital\Datatypes\Web\Seo\SeoMetadata;
use HraDigital\Datatypes\Web\Seo\SocialImage;
use HraDigital\Datatypes\Web\Seo\TwitterCardType;
use HraDigital\Tests\Datatypes\AbstractBaseTestCase;

/**
 * SeoMetadata Unit testing.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
class SeoMetadataTest extends AbstractBaseTestCase
{
    private function makeMetadata(array $overrides = []): SeoMetadata
    {
        return SeoMetadata::create(
            title:       $overrides['title']       ?? 'Page title',
            description: $overrides['description'] ?? 'Page description',
            url:         $overrides['url']         ?? 'https://example.com/page',
            siteName:    $overrides['siteName']    ?? 'Example',
            locale:      $overrides['locale']      ?? 'en_GB',
        );
    }

    public function testCreatesWithMinimalFields(): void
    {
        $seo = $this->makeMetadata();

        $this->assertSame('Page title', $seo->title);
        $this->assertSame('Page description', $seo->description);
        $this->assertSame('https://example.com/page', $seo->url);
        $this->assertSame('Example', $seo->siteName);
        $this->assertSame('en_GB', $seo->locale);
        $this->assertSame(OpenGraphType::Website, $seo->type);
        $this->assertNull($seo->image);
        $this->assertNull($seo->article);
        $this->assertNull($seo->canonicalUrl);
        $this->assertTrue($seo->robotsIndex);
        $this->assertTrue($seo->robotsFollow);
    }

    public function testDefaultTwitterCardIsSummaryWhenNoImage(): void
    {
        $seo = $this->makeMetadata();

        $this->assertSame(TwitterCardType::Summary, $seo->twitterCard);
    }

    public function testDefaultTwitterCardIsSummaryLargeImageWhenImageProvided(): void
    {
        $image = SocialImage::create('https://example.com/img.jpg');
        $seo   = SeoMetadata::create(
            'Title', 'Desc', 'https://example.com', 'Site', 'en_GB',
            image: $image,
        );

        $this->assertSame(TwitterCardType::SummaryLargeImage, $seo->twitterCard);
    }

    public function testExplicitTwitterCardIsRespected(): void
    {
        $seo = SeoMetadata::create(
            'Title', 'Desc', 'https://example.com', 'Site', 'en_GB',
            twitterCard: TwitterCardType::App,
        );

        $this->assertSame(TwitterCardType::App, $seo->twitterCard);
    }

    public function testRobotsDirectiveAllowed(): void
    {
        $seo = $this->makeMetadata();

        $this->assertSame('index,follow', $seo->robotsDirective());
    }

    public function testRobotsDirectiveNoindexNofollow(): void
    {
        $seo = SeoMetadata::create(
            'Title', 'Desc', 'https://example.com', 'Site', 'en_GB',
            robotsIndex: false,
            robotsFollow: false,
        );

        $this->assertSame('noindex,nofollow', $seo->robotsDirective());
    }

    public function testWithImageReturnsNewInstanceWithImage(): void
    {
        $seo   = $this->makeMetadata();
        $image = SocialImage::create('https://example.com/img.jpg');
        $seo2  = $seo->withImage($image);

        $this->assertNotSame($seo, $seo2);
        $this->assertNull($seo->image);
        $this->assertSame($image, $seo2->image);
    }

    public function testWithArticleReturnsNewInstanceWithArticleAndOgTypeArticle(): void
    {
        $seo     = $this->makeMetadata();
        $article = ArticleMetadata::create(new DateTimeImmutable('2024-01-01'));
        $seo2    = $seo->withArticle($article);

        $this->assertNotSame($seo, $seo2);
        $this->assertSame(OpenGraphType::Article, $seo2->type);
        $this->assertSame($article, $seo2->article);
    }

    public function testCanonicalUrlIsStored(): void
    {
        $seo = SeoMetadata::create(
            'Title', 'Desc', 'https://example.com', 'Site', 'en_GB',
            canonicalUrl: '  https://example.com/canonical  ',
        );

        $this->assertSame('https://example.com/canonical', $seo->canonicalUrl);
    }

    public function testThrowsWhenTitleIsEmpty(): void
    {
        $this->expectException(NonEmptyStringException::class);

        $this->makeMetadata(['title' => '']);
    }

    public function testThrowsWhenDescriptionIsEmpty(): void
    {
        $this->expectException(NonEmptyStringException::class);

        $this->makeMetadata(['description' => '']);
    }

    public function testThrowsWhenUrlIsEmpty(): void
    {
        $this->expectException(NonEmptyStringException::class);

        $this->makeMetadata(['url' => '']);
    }

    public function testThrowsWhenSiteNameIsEmpty(): void
    {
        $this->expectException(NonEmptyStringException::class);

        $this->makeMetadata(['siteName' => '']);
    }

    public function testThrowsWhenLocaleIsEmpty(): void
    {
        $this->expectException(NonEmptyStringException::class);

        $this->makeMetadata(['locale' => '']);
    }

    public function testLeadingAndTrailingWhitespaceIsTrimmed(): void
    {
        $seo = SeoMetadata::create(
            '  Title  ', '  Desc  ', '  https://example.com  ', '  Site  ', '  en_GB  ',
        );

        $this->assertSame('Title', $seo->title);
        $this->assertSame('Desc', $seo->description);
        $this->assertSame('https://example.com', $seo->url);
        $this->assertSame('Site', $seo->siteName);
        $this->assertSame('en_GB', $seo->locale);
    }
}
