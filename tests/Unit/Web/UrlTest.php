<?php

declare(strict_types=1);

namespace HraDigital\Tests\Datatypes\Unit\Web;

use HraDigital\Datatypes\Exceptions\Datatypes\InvalidUrlException;
use HraDigital\Datatypes\Exceptions\Datatypes\NonEmptyStringException;
use HraDigital\Datatypes\Web\Url;
use HraDigital\Tests\Datatypes\AbstractBaseTestCase;
use Error;
use function serialize;
use function str_repeat;
use function strlen;
use function unserialize;

/**
 * Url Unit testing.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 */
class UrlTest extends AbstractBaseTestCase
{
    public function testCreatesFromValidUrl(): void
    {
        $url = Url::create('https://example.com/posts/hello');

        $this->assertInstanceOf(Url::class, $url);
        $this->assertSame('https://example.com/posts/hello', (string) $url);
    }

    public function testTrimsWhitespaceBeforeValidation(): void
    {
        $url = Url::create('  https://example.com/a  ');

        $this->assertSame('https://example.com/a', (string) $url);
    }

    public function testLowerCasesSchemeAndHost(): void
    {
        $url = Url::create('HTTPS://Example.COM/Posts/Hello');

        $this->assertSame('https', (string) $url->getScheme());
        $this->assertSame('example.com', (string) $url->getHost());
    }

    public function testPreservesPathCaseBecausePathsAreCaseSensitive(): void
    {
        $url = Url::create('https://Example.com/Posts/Hello');

        $this->assertSame('https://example.com/Posts/Hello', (string) $url);
    }

    public function testPreservesPortAndQueryString(): void
    {
        $url = Url::create('https://example.com:8443/a?b=1&c=2');

        $this->assertSame('https://example.com:8443/a?b=1&c=2', (string) $url);
    }

    public function testDropsFragmentBecauseItNeverReachesTheServer(): void
    {
        $url = Url::create('https://example.com/a#section');

        $this->assertSame('https://example.com/a', (string) $url);
    }

    public function testThrowsOnEmptyValue(): void
    {
        $this->expectException(NonEmptyStringException::class);

        Url::create('   ');
    }

    public function testThrowsOnRelativeUrl(): void
    {
        $this->expectException(InvalidUrlException::class);

        Url::create('/posts/hello');
    }

    public function testThrowsOnGarbageValue(): void
    {
        $this->expectException(InvalidUrlException::class);

        Url::create('not a url');
    }

    // -----------------------------------------------------------------------
    // getSchemeRelative
    // -----------------------------------------------------------------------

    public function testGetSchemeRelativeDropsTheSchemeAndKeepsTheAuthority(): void
    {
        $url = Url::create('https://example.com/posts/hello');

        $this->assertSame('//example.com/posts/hello', $url->getSchemeRelative());
    }

    public function testGetSchemeRelativeDropsAnHttpSchemeToo(): void
    {
        $url = Url::create('http://example.com/a');

        $this->assertSame('//example.com/a', $url->getSchemeRelative());
    }

    public function testGetSchemeRelativeKeepsPortAndQueryString(): void
    {
        $url = Url::create('https://example.com:8443/a?b=1&c=2');

        $this->assertSame('//example.com:8443/a?b=1&c=2', $url->getSchemeRelative());
    }

    public function testGetSchemeRelativeKeepsAnAbsoluteUrlNestedInThePath(): void
    {
        // An image proxy addressed as `https://proxy/https://origin/file.png`: only the
        // URL's own scheme comes off, never the one sitting in its path.
        $url = Url::create('https://picperf.io/https://example.com/preview.png');

        $this->assertSame('//picperf.io/https://example.com/preview.png', $url->getSchemeRelative());
    }

    public function testGetSchemeRelativeCarriesTheSameNormalizationAsTheAddress(): void
    {
        $url = Url::create('HTTPS://Example.COM/Posts/Hello');

        $this->assertSame('//example.com/Posts/Hello', $url->getSchemeRelative());
    }

    // -----------------------------------------------------------------------
    // getHash
    // -----------------------------------------------------------------------

    public function testGetHashReturnsThirtyTwoCharacterDigest(): void
    {
        $url = Url::create('https://example.com/posts/hello');

        $this->assertSame(32, strlen($url->getHash()));
    }

    public function testGetHashIsStableForTheSameUrl(): void
    {
        $first = Url::create('https://example.com/posts/hello');
        $second = Url::create('https://example.com/posts/hello');

        $this->assertSame($first->getHash(), $second->getHash());
    }

    public function testGetHashDiffersForDifferentUrls(): void
    {
        $first = Url::create('https://example.com/posts/hello');
        $second = Url::create('https://example.com/posts/world');

        $this->assertNotSame($first->getHash(), $second->getHash());
    }

    public function testGetHashIsFixedWidthForAVeryLongUrl(): void
    {
        // The whole point of the digest: a URL far past any index key limit
        // still yields a 32 character value.
        $url = Url::create('https://example.com/' . str_repeat('a', 3000));

        $this->assertSame(32, strlen($url->getHash()));
    }

    public function testGetHashMatchesForUrlsDifferingOnlyByHostCase(): void
    {
        $first = Url::create('https://Example.com/a');
        $second = Url::create('https://example.com/a');

        $this->assertSame($first->getHash(), $second->getHash());
    }

    // -----------------------------------------------------------------------
    // equals
    // -----------------------------------------------------------------------

    public function testEqualsIsTrueForTheSameUrl(): void
    {
        $first = Url::create('https://example.com/a');
        $second = Url::create('https://example.com/a');

        $this->assertTrue($first->equals($second));
    }

    public function testEqualsIsFalseForDifferentUrls(): void
    {
        $first = Url::create('https://example.com/a');
        $second = Url::create('https://example.com/b');

        $this->assertFalse($first->equals($second));
    }

    // -----------------------------------------------------------------------
    // Serialization
    // -----------------------------------------------------------------------

    public function testSerializesAndUnserializesBackToTheSameValue(): void
    {
        $url = Url::create('https://example.com/a?b=1');
        $other = unserialize(serialize($url));

        $this->assertEquals($url, $other);
        $this->assertInstanceOf(Url::class, $other);
        $this->assertSame((string) $url, (string) $other);
        $this->assertNotSame($url, $other);
    }

    // -----------------------------------------------------------------------
    // Readonly semantics
    // -----------------------------------------------------------------------

    public function testRefusesToAcceptADynamicProperty(): void
    {
        $url = Url::create('https://example.com/a');

        $this->expectException(Error::class);

        /** @phpstan-ignore property.notFound */
        $url->port = 8080;
    }
}
