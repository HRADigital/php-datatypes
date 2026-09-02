<?php

/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at https://mozilla.org/MPL/2.0/.
 *
 * Copyright (c) HRADigital - Hugo Rafael Azevedo.
 */

declare(strict_types=1);

namespace HraDigital\Datatypes\Web;

use HraDigital\Datatypes\Exceptions\Datatypes\InvalidUrlException;
use HraDigital\Datatypes\Exceptions\Datatypes\NonEmptyStringException;
use HraDigital\Datatypes\Scalar\Str;
use function filter_var;
use function md5;
use function parse_url;
use function sprintf;

/**
 * URL datatype.
 *
 * Datatype class to hold and validate a single absolute URL value.
 *
 * A URL is routinely too long to be indexed directly by a database engine -
 * InnoDB caps an index key at 3072 bytes, which a `varchar(2048)` utf8mb4
 * column blows straight past. `getHash()` exists for exactly that case: it
 * returns a fixed-width digest of the URL, suitable as the stored surrogate a
 * UNIQUE index can be built on, while identity stays conceptually the URL.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 */
readonly class Url
{
    /** @var Str $value - Holds the full, normalized URL. */
    protected Str $value;

    /** @var Str $scheme - Holds the URL's scheme, lowercased (e.g. `https`). */
    protected Str $scheme;

    /** @var Str $host - Holds the URL's host, lowercased (e.g. `example.com`). */
    protected Str $host;

    /**
     * Loads a new Url instance from a native string.
     */
    public static function create(string $url): Url
    {
        return new Url($url);
    }

    /**
     * Initializes a new instance of a URL.
     *
     * @throws NonEmptyStringException - If the supplied URL is empty.
     * @throws InvalidUrlException     - If the supplied URL is not a valid absolute URL.
     */
    protected function __construct(string $url)
    {
        $voUrl = Str::create($url)->trim();

        if ($voUrl->getLength() === 0) {
            throw NonEmptyStringException::withName('$url');
        }

        if (!filter_var((string) $voUrl, FILTER_VALIDATE_URL)) {
            throw InvalidUrlException::withValue((string) $voUrl);
        }

        $parts = parse_url((string) $voUrl);

        if ($parts === false || !isset($parts['scheme'], $parts['host'])) {
            throw InvalidUrlException::withValue((string) $voUrl);
        }

        // The scheme and host are lowercased because they are case-insensitive per
        // RFC 3986; the path and query are left untouched because they are not.
        $this->scheme = Str::create($parts['scheme'])->toLower();
        $this->host = Str::create($parts['host'])->toLower();

        $this->value = Str::create(
            sprintf(
                '%s://%s%s%s%s',
                (string) $this->scheme,
                (string) $this->host,
                isset($parts['port']) ? ':' . $parts['port'] : '',
                $parts['path'] ?? '',
                isset($parts['query']) ? '?' . $parts['query'] : ''
            )
        );
    }

    /**
     * Returns the String representation of the object.
     */
    public function __toString(): string
    {
        return (string) $this->getAddress();
    }

    /**
     * Returns a string representation for the URL.
     */
    public function getAddress(): Str
    {
        return $this->value;
    }

    /**
     * Returns the URL's scheme (e.g. `https`).
     */
    public function getScheme(): Str
    {
        return $this->scheme;
    }

    /**
     * Returns the URL without its scheme, in scheme-relative form (`//example.com/a`).
     *
     * RFC 3986 calls this a network-path reference: the authority and everything after
     * it, with the scheme left for the surrounding context to supply. A browser
     * resolves it against the scheme of the document carrying it, which is what makes
     * it worth having in markup - one document served over either scheme keeps its
     * subresources and its links on that same scheme.
     *
     * That also bounds where it belongs. Anything read away from the document it came
     * from - `rel=canonical`, `hreflang`, `og:url`, `og:image`, JSON-LD, a sitemap, a
     * redirect target, an email - has no scheme to inherit, and wants `getAddress()`.
     *
     * Carries the same normalization as every other accessor here, the dropped
     * fragment included, so it still addresses the resource the server sees.
     */
    public function getSchemeRelative(): string
    {
        // Cut past `scheme:`, which leaves the `//` opening the authority in place,
        // rather than re-joining the parts and normalizing a second time here.
        return (string) $this->value->subString($this->scheme->getLength() + 1);
    }

    /**
     * Returns the URL's host (e.g. `example.com`).
     */
    public function getHost(): Str
    {
        return $this->host;
    }

    /**
     * Returns a fixed-width digest of the URL.
     *
     * Intended as the stored surrogate for a UNIQUE index, where the URL itself
     * is too long to index. Always 32 characters, whatever the URL's length.
     */
    public function getHash(): string
    {
        return md5((string) $this->value);
    }

    /**
     * Whether both instances represent the very same URL.
     */
    public function equals(Url $other): bool
    {
        return (string) $this->value === (string) $other;
    }
}
