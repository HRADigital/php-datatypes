<?php

declare(strict_types=1);

namespace HraDigital\Tests\Datatypes\Unit\Web\Markup;

use HraDigital\Datatypes\Web\Markup\Markup;
use HraDigital\Datatypes\Web\Markup\MarkupConfiguration;
use HraDigital\Tests\Datatypes\AbstractBaseTestCase;
use InvalidArgumentException;

/**
 * Markup Unit testing.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
class MarkupTest extends AbstractBaseTestCase
{
    // --- fromPlainText ---

    public function testFromPlainTextEmptyStringReturnsEmptyHtml(): void
    {
        $markup = Markup::fromPlainText('');

        $this->assertSame('', $markup->toHtml());
        $this->assertSame([], $markup->blocks());
    }

    public function testFromPlainTextWhitespaceOnlyReturnsEmpty(): void
    {
        $markup = Markup::fromPlainText('   ');

        $this->assertSame('', $markup->toHtml());
    }

    public function testFromPlainTextSingleSentenceProducesParagraph(): void
    {
        $markup = Markup::fromPlainText('Hello world.');

        $this->assertSame('<p>Hello world.</p>', $markup->toHtml());
    }

    public function testFromPlainTextListLinesProduceUlElement(): void
    {
        $text   = "- Apple\n- Banana\n- Cherry";
        $markup = Markup::fromPlainText($text);

        $html = $markup->toHtml();
        $this->assertStringContainsString('<ul>', $html);
        $this->assertStringContainsString('<li>Apple</li>', $html);
        $this->assertStringContainsString('<li>Banana</li>', $html);
        $this->assertStringContainsString('<li>Cherry</li>', $html);
    }

    public function testFromPlainTextGroupsSentencesPerConfig(): void
    {
        $config = new MarkupConfiguration(sentencesPerParagraph: 1);
        $text   = 'First sentence. Second sentence. Third sentence.';
        $markup = Markup::fromPlainText($text, $config);
        $blocks = $markup->blocks();

        $this->assertCount(3, $blocks);
    }

    public function testToStringDelegatesToToHtml(): void
    {
        $markup = Markup::fromPlainText('Hello.');

        $this->assertSame($markup->toHtml(), (string) $markup);
    }

    // --- fromHtml ---

    public function testFromHtmlEmptyStringReturnsEmptyBlocks(): void
    {
        $markup = Markup::fromHtml('');

        $this->assertSame([], $markup->blocks());
    }

    public function testFromHtmlParseParagraphs(): void
    {
        $markup = Markup::fromHtml('<p>Hello world.</p>');
        $blocks = $markup->blocks();

        $this->assertCount(1, $blocks);
        $this->assertSame('Hello world.', $blocks[0]);
    }

    public function testFromHtmlParseList(): void
    {
        $markup = Markup::fromHtml('<ul><li>One</li><li>Two</li></ul>');
        $blocks = $markup->blocks();

        $this->assertCount(1, $blocks);
        $this->assertIsArray($blocks[0]);
        $this->assertSame(['One', 'Two'], $blocks[0]);
    }

    public function testFromHtmlDecodeEntities(): void
    {
        $markup = Markup::fromHtml('<p>Hello &amp; world.</p>');
        $blocks = $markup->blocks();

        $this->assertSame('Hello & world.', $blocks[0]);
    }

    // --- fromBlocks ---

    public function testFromBlocksAcceptsStringsAndArrays(): void
    {
        $markup = Markup::fromBlocks(['Hello.', ['Item one', 'Item two']]);

        $html = $markup->toHtml();
        $this->assertStringContainsString('<p>Hello.</p>', $html);
        $this->assertStringContainsString('<ul>', $html);
    }

    public function testFromBlocksThrowsForInvalidBlockType(): void
    {
        $this->expectException(InvalidArgumentException::class);

        Markup::fromBlocks([42]);
    }

    public function testFromBlocksThrowsForNonStringListItem(): void
    {
        $this->expectException(InvalidArgumentException::class);

        Markup::fromBlocks([[42]]);
    }

    // --- toIntro ---

    public function testToIntroReturnsFirstParagraphTruncated(): void
    {
        $long   = \str_repeat('a', 200);
        $markup = Markup::fromBlocks([$long]);

        $intro = $markup->toIntro(180);
        $this->assertLessThanOrEqual(184, \mb_strlen($intro)); // 180 chars + ellipsis
        $this->assertStringEndsWith('…', $intro);
    }

    public function testToIntroReturnsShortValueUnchanged(): void
    {
        $markup = Markup::fromBlocks(['Short text.']);

        $this->assertSame('Short text.', $markup->toIntro(180));
    }

    public function testToIntroOnEmptyMarkupReturnsEmptyString(): void
    {
        $markup = Markup::fromPlainText('');

        $this->assertSame('', $markup->toIntro());
    }

    public function testToIntroFallsBackToListItemWhenNoParagraph(): void
    {
        $markup = Markup::fromBlocks([['Only a list item']]);

        $this->assertSame('Only a list item', $markup->toIntro(180));
    }

    // --- toHtmlIntro ---

    public function testToHtmlIntroWrapsInParagraph(): void
    {
        $markup = Markup::fromBlocks(['Hello.']);

        $this->assertSame('<p>Hello.</p>', $markup->toHtmlIntro(180));
    }

    public function testToHtmlIntroEmptyReturnsEmptyString(): void
    {
        $markup = Markup::fromPlainText('');

        $this->assertSame('', $markup->toHtmlIntro());
    }

    // --- toHtml escaping ---

    public function testToHtmlEscapesSpecialCharacters(): void
    {
        $markup = Markup::fromBlocks(['<script>alert("xss")</script>']);

        $html = $markup->toHtml();
        $this->assertStringNotContainsString('<script>', $html);
        $this->assertStringContainsString('&lt;script&gt;', $html);
    }
}
