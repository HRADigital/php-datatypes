<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Web\Seo;

use DateTimeImmutable;
use InvalidArgumentException;

use function array_values;

/**
 * Article-specific Open Graph metadata. Maps to the `article:*` meta family.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
class ArticleMetadata
{
    public readonly DateTimeImmutable $publishedAt;
    public readonly ?DateTimeImmutable $modifiedAt;
    public readonly ?string $author;
    public readonly ?string $section;

    /** @var array<int, string> */
    public readonly array $tags;

    /**
     * @param array<int, string> $tags
     */
    public static function create(
        DateTimeImmutable $publishedAt,
        ?DateTimeImmutable $modifiedAt = null,
        ?string $author = null,
        ?string $section = null,
        array $tags = [],
    ): ArticleMetadata {
        return new ArticleMetadata($publishedAt, $modifiedAt, $author, $section, $tags);
    }

    /**
     * @param array<int, string> $tags
     */
    private function __construct(
        DateTimeImmutable $publishedAt,
        ?DateTimeImmutable $modifiedAt,
        ?string $author,
        ?string $section,
        array $tags,
    ) {
        if ($modifiedAt !== null && $modifiedAt < $publishedAt) {
            throw new InvalidArgumentException('$modifiedAt cannot be earlier than $publishedAt.');
        }
        foreach ($tags as $tag) {
            if (!\is_string($tag)) {
                throw new InvalidArgumentException('$tags must contain only strings.');
            }
        }

        $this->publishedAt = $publishedAt;
        $this->modifiedAt  = $modifiedAt;
        $this->author      = $author;
        $this->section     = $section;
        $this->tags        = array_values($tags);
    }
}
