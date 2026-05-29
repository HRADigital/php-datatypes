<?php

declare(strict_types=1);

namespace HraDigital\Tests\Datatypes\Unit\Web\Seo;

use HraDigital\Datatypes\Web\Seo\SocialPreviewImageExtractor;
use HraDigital\Tests\Datatypes\AbstractBaseTestCase;

/**
 * SocialPreviewImageExtractor Unit testing.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
class SocialPreviewImageExtractorTest extends AbstractBaseTestCase
{
    private SocialPreviewImageExtractor $extractor;

    protected function setUp(): void
    {
        $this->extractor = new SocialPreviewImageExtractor();
    }

    public function testReturnsNullForEmptyHtml(): void
    {
        $this->assertNull($this->extractor->extract(''));
    }

    public function testReturnsNullWhenNoImageMetaPresent(): void
    {
        $html = '<html><head><title>Test</title></head><body></body></html>';

        $this->assertNull($this->extractor->extract($html));
    }

    public function testExtractsOgImagePropertyBeforeContent(): void
    {
        $html = '<meta property="og:image" content="https://example.com/og.jpg">';

        $this->assertSame('https://example.com/og.jpg', $this->extractor->extract($html));
    }

    public function testExtractsOgImageContentBeforeProperty(): void
    {
        $html = '<meta content="https://example.com/og2.jpg" property="og:image">';

        $this->assertSame('https://example.com/og2.jpg', $this->extractor->extract($html));
    }

    public function testExtractsTwitterImageNameBeforeContent(): void
    {
        $html = '<meta name="twitter:image" content="https://example.com/twitter.jpg">';

        $this->assertSame('https://example.com/twitter.jpg', $this->extractor->extract($html));
    }

    public function testExtractsTwitterImageContentBeforeName(): void
    {
        $html = '<meta content="https://example.com/twitter2.jpg" name="twitter:image">';

        $this->assertSame('https://example.com/twitter2.jpg', $this->extractor->extract($html));
    }

    public function testExtractsLinkRelImageSrc(): void
    {
        $html = '<link rel="image_src" href="https://example.com/link.jpg">';

        $this->assertSame('https://example.com/link.jpg', $this->extractor->extract($html));
    }

    public function testOgImageTakesPriorityOverTwitterImage(): void
    {
        $html = '<meta property="og:image" content="https://example.com/og.jpg">'
            . '<meta name="twitter:image" content="https://example.com/twitter.jpg">';

        $this->assertSame('https://example.com/og.jpg', $this->extractor->extract($html));
    }

    public function testDecodesHtmlEntitiesInUrl(): void
    {
        $html = '<meta property="og:image" content="https://example.com/img.jpg?a=1&amp;b=2">';

        $this->assertSame('https://example.com/img.jpg?a=1&b=2', $this->extractor->extract($html));
    }
}
