<?php

declare(strict_types=1);

namespace HraDigital\Tests\Datatypes\Unit\Web\Seo;

use DateTimeImmutable;
use HraDigital\Datatypes\Web\Seo\ArticleMetadata;
use HraDigital\Tests\Datatypes\AbstractBaseTestCase;
use InvalidArgumentException;

/**
 * ArticleMetadata Unit testing.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
class ArticleMetadataTest extends AbstractBaseTestCase
{
    private DateTimeImmutable $published;

    protected function setUp(): void
    {
        $this->published = new DateTimeImmutable('2024-01-15 10:00:00');
    }

    public function testCreatesWithPublishedAtOnly(): void
    {
        $article = ArticleMetadata::create($this->published);

        $this->assertEquals($this->published, $article->publishedAt);
        $this->assertNull($article->modifiedAt);
        $this->assertNull($article->author);
        $this->assertNull($article->section);
        $this->assertSame([], $article->tags);
    }

    public function testCreatesWithAllFields(): void
    {
        $modified = new DateTimeImmutable('2024-02-01 12:00:00');
        $article  = ArticleMetadata::create(
            $this->published,
            $modified,
            'John Doe',
            'Technology',
            ['php', 'seo'],
        );

        $this->assertSame('John Doe', $article->author);
        $this->assertSame('Technology', $article->section);
        $this->assertSame(['php', 'seo'], $article->tags);
        $this->assertEquals($modified, $article->modifiedAt);
    }

    public function testTagsAreReIndexed(): void
    {
        $article = ArticleMetadata::create($this->published, null, null, null, [2 => 'tag-a', 5 => 'tag-b']);

        $this->assertSame([0 => 'tag-a', 1 => 'tag-b'], $article->tags);
    }

    public function testThrowsWhenModifiedAtIsBeforePublishedAt(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $before = new DateTimeImmutable('2023-12-01 00:00:00');
        ArticleMetadata::create($this->published, $before);
    }

    public function testThrowsWhenTagsContainNonString(): void
    {
        $this->expectException(InvalidArgumentException::class);

        ArticleMetadata::create($this->published, null, null, null, [42]);
    }

    public function testModifiedAtEqualToPublishedAtIsAllowed(): void
    {
        $article = ArticleMetadata::create($this->published, $this->published);

        $this->assertEquals($this->published, $article->modifiedAt);
    }
}
