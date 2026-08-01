<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Web;

use HraDigital\Datatypes\Exceptions\Datatypes\InvalidUrlException;
use HraDigital\Datatypes\Exceptions\Datatypes\NonEmptyStringException;
use HraDigital\Datatypes\Scalar\Str;

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
 * @license   MIT
 */
class Url
{
    /** @var Str $value - Holds the full, normalized URL. */
    protected Str $value;

    /** @var Str $scheme - Holds the URL's scheme, lowercased (e.g. `https`). */
    protected Str $scheme;

    /** @var Str $host - Holds the URL's host, lowercased (e.g. `example.com`). */
    protected Str $host;

    /**
     * Loads a new Url instance from a native string.
     *
     * @param  string $url - URL used to initialize instance.
     * @return Url
     */
    public static function create(string $url): Url
    {
        return new Url($url);
    }

    /**
     * Initializes a new instance of a URL.
     *
     * @param  string $url - String representation of the URL.
     *
     * @throws NonEmptyStringException - If the supplied URL is empty.
     * @throws InvalidUrlException     - If the supplied URL is not a valid absolute URL.
     * @return void
     */
    protected function __construct(string $url)
    {
        $this->loadFromPrimitive($url);
    }

    /**
     * Loads supplied $url string representation into the class.
     *
     * The scheme and host are lowercased because they are case-insensitive per
     * RFC 3986; the path and query are left untouched because they are not.
     *
     * @param  string $url - String representation of the URL.
     *
     * @throws NonEmptyStringException - If the supplied URL is empty.
     * @throws InvalidUrlException     - If the supplied URL is not a valid absolute URL.
     * @return void
     */
    protected function loadFromPrimitive(string $url): void
    {
        $voUrl = Str::create($url)->trim();

        if ($voUrl->getLength() === 0) {
            throw NonEmptyStringException::withName('$url');
        }

        if (!\filter_var((string) $voUrl, FILTER_VALIDATE_URL)) {
            throw InvalidUrlException::withValue((string) $voUrl);
        }

        $parts = \parse_url((string) $voUrl);

        if ($parts === false || !isset($parts['scheme'], $parts['host'])) {
            throw InvalidUrlException::withValue((string) $voUrl);
        }

        $this->scheme = Str::create($parts['scheme'])->toLower();
        $this->host = Str::create($parts['host'])->toLower();

        $this->value = Str::create(
            \sprintf(
                '%s://%s%s%s%s',
                (string) $this->scheme,
                (string) $this->host,
                isset($parts['port']) ? ':' . $parts['port'] : '',
                $parts['path'] ?? '',
                isset($parts['query']) ? '?' . $parts['query'] : ''
            )
        );
    }

    public function __serialize(): array
    {
        return [
            'url' => (string) $this,
        ];
    }

    public function __unserialize(array $data): void
    {
        $this->loadFromPrimitive(
            $data['url']
        );
    }

    /**
     * Returns the String representation of the object.
     *
     * @return string
     */
    public function __toString(): string
    {
        return (string) $this->getAddress();
    }

    /**
     * Returns a string representation for the URL.
     *
     * @return Str
     */
    public function getAddress(): Str
    {
        return $this->value;
    }

    /**
     * Returns the URL's scheme (e.g. `https`).
     *
     * @return Str
     */
    public function getScheme(): Str
    {
        return $this->scheme;
    }

    /**
     * Returns the URL's host (e.g. `example.com`).
     *
     * @return Str
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
     *
     * @return string
     */
    public function getHash(): string
    {
        return \md5((string) $this->value);
    }

    /**
     * Whether both instances represent the very same URL.
     *
     * @param  Url $other - URL to compare against.
     * @return bool
     */
    public function equals(Url $other): bool
    {
        return (string) $this->value === (string) $other;
    }
}
