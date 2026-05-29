<?php

declare(strict_types=1);

namespace HraDigital\Tests\Datatypes\Unit\Web\Seo;

use HraDigital\Datatypes\Exceptions\Datatypes\InvalidSlugException;
use HraDigital\Datatypes\Exceptions\Datatypes\NonEmptyStringException;
use HraDigital\Datatypes\Web\Seo\Slug;
use HraDigital\Tests\Datatypes\AbstractBaseTestCase;

/**
 * Slug Unit testing.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
class SlugTest extends AbstractBaseTestCase
{
    public function testCreatesFromValidSlug(): void
    {
        $slug = Slug::create('hello-world');

        $this->assertInstanceOf(Slug::class, $slug);
        $this->assertSame('hello-world', (string) $slug);
    }

    public function testNormalizesToLowerCase(): void
    {
        $slug = Slug::create('Hello-World');

        $this->assertSame('hello-world', (string) $slug);
    }

    public function testTrimsWhitespaceBeforeValidation(): void
    {
        $slug = Slug::create('  hello  ');

        $this->assertSame('hello', (string) $slug);
    }

    public function testSingleWordSlug(): void
    {
        $slug = Slug::create('hello');

        $this->assertSame('hello', (string) $slug);
    }

    public function testSlugWithDigits(): void
    {
        $slug = Slug::create('article-2024-01');

        $this->assertSame('article-2024-01', (string) $slug);
    }

    public function testEqualsReturnsTrueForIdenticalValues(): void
    {
        $a = Slug::create('my-slug');
        $b = Slug::create('my-slug');

        $this->assertTrue($a->equals($b));
    }

    public function testEqualsReturnsFalseForDifferentValues(): void
    {
        $a = Slug::create('slug-a');
        $b = Slug::create('slug-b');

        $this->assertFalse($a->equals($b));
    }

    public function testThrowsNonEmptyStringExceptionForEmptyString(): void
    {
        $this->expectException(NonEmptyStringException::class);

        Slug::create('');
    }

    public function testThrowsNonEmptyStringExceptionForWhitespaceOnly(): void
    {
        $this->expectException(NonEmptyStringException::class);

        Slug::create('   ');
    }

    public function testThrowsInvalidSlugExceptionForUnderscores(): void
    {
        $this->expectException(InvalidSlugException::class);

        Slug::create('hello_world');
    }

    public function testThrowsInvalidSlugExceptionForSpacesInMiddle(): void
    {
        $this->expectException(InvalidSlugException::class);

        Slug::create('hello world');
    }

    public function testThrowsInvalidSlugExceptionForLeadingDash(): void
    {
        $this->expectException(InvalidSlugException::class);

        Slug::create('-hello');
    }

    public function testThrowsInvalidSlugExceptionForTrailingDash(): void
    {
        $this->expectException(InvalidSlugException::class);

        Slug::create('hello-');
    }

    public function testThrowsInvalidSlugExceptionForConsecutiveDashes(): void
    {
        $this->expectException(InvalidSlugException::class);

        Slug::create('hello--world');
    }

    public function testThrowsInvalidSlugExceptionWhenExceedsMaxLength(): void
    {
        $this->expectException(InvalidSlugException::class);

        Slug::create(\str_repeat('a', Slug::MAX_LENGTH + 1));
    }

    public function testAcceptsSlugAtMaxLength(): void
    {
        $value = \str_repeat('a', Slug::MAX_LENGTH);
        $slug  = Slug::create($value);

        $this->assertSame($value, (string) $slug);
    }
}
