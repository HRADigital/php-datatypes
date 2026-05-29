<?php

declare(strict_types=1);

namespace HraDigital\Tests\Datatypes\Unit\Web\Seo;

use HraDigital\Datatypes\Exceptions\Datatypes\NonEmptyStringException;
use HraDigital\Datatypes\Web\Seo\SocialImage;
use HraDigital\Tests\Datatypes\AbstractBaseTestCase;
use InvalidArgumentException;

/**
 * SocialImage Unit testing.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
class SocialImageTest extends AbstractBaseTestCase
{
    private const URL = 'https://example.com/image.jpg';

    public function testCreatesWithUrlOnly(): void
    {
        $image = SocialImage::create(self::URL);

        $this->assertSame(self::URL, $image->url);
        $this->assertSame('', $image->alt);
        $this->assertNull($image->width);
        $this->assertNull($image->height);
    }

    public function testCreatesWithAllFields(): void
    {
        $image = SocialImage::create(self::URL, 'Alt text', 1200, 630);

        $this->assertSame('Alt text', $image->alt);
        $this->assertSame(1200, $image->width);
        $this->assertSame(630, $image->height);
    }

    public function testToStringReturnsUrl(): void
    {
        $image = SocialImage::create(self::URL);

        $this->assertSame(self::URL, (string) $image);
    }

    public function testHasDimensionsTrueWhenBothSet(): void
    {
        $image = SocialImage::create(self::URL, '', 1200, 630);

        $this->assertTrue($image->hasDimensions());
    }

    public function testHasDimensionsFalseWhenOnlyWidthSet(): void
    {
        $image = SocialImage::create(self::URL, '', 1200);

        $this->assertFalse($image->hasDimensions());
    }

    public function testHasDimensionsFalseWhenNeitherSet(): void
    {
        $image = SocialImage::create(self::URL);

        $this->assertFalse($image->hasDimensions());
    }

    public function testThrowsNonEmptyStringExceptionForEmptyUrl(): void
    {
        $this->expectException(NonEmptyStringException::class);

        SocialImage::create('');
    }

    public function testThrowsInvalidArgumentExceptionForInvalidUrl(): void
    {
        $this->expectException(InvalidArgumentException::class);

        SocialImage::create('not-a-url');
    }

    public function testThrowsWhenWidthIsZero(): void
    {
        $this->expectException(InvalidArgumentException::class);

        SocialImage::create(self::URL, '', 0);
    }

    public function testThrowsWhenWidthIsNegative(): void
    {
        $this->expectException(InvalidArgumentException::class);

        SocialImage::create(self::URL, '', -1);
    }

    public function testThrowsWhenHeightIsZero(): void
    {
        $this->expectException(InvalidArgumentException::class);

        SocialImage::create(self::URL, '', null, 0);
    }
}
