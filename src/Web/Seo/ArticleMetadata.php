<?php

/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at https://mozilla.org/MPL/2.0/.
 *
 * Copyright (c) HRADigital - Hugo Rafael Azevedo.
 */

declare(strict_types=1);

namespace HraDigital\Datatypes\Web\Seo;

use DateTimeImmutable;
use InvalidArgumentException;

use function array_values;
use function is_string;

/**
 * Article-specific Open Graph metadata. Maps to the `article:*` meta family.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
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
     * @param array<int, mixed> $tags - Validated at runtime; every entry must be a string.
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
     * @param array<int, mixed> $tags - Validated at runtime; every entry must be a string.
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
        $validated = [];
        foreach ($tags as $tag) {
            if (!is_string($tag)) {
                throw new InvalidArgumentException('$tags must contain only strings.');
            }

            $validated[] = $tag;
        }

        $this->publishedAt = $publishedAt;
        $this->modifiedAt  = $modifiedAt;
        $this->author      = $author;
        $this->section     = $section;
        $this->tags        = $validated;
    }
}
