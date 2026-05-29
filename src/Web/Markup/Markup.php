<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Web\Markup;

use InvalidArgumentException;

use function array_chunk;
use function array_filter;
use function array_map;
use function array_values;
use function html_entity_decode;
use function htmlspecialchars;
use function implode;
use function is_array;
use function is_string;
use function mb_strlen;
use function mb_substr;
use function preg_match_all;
use function preg_quote;
use function preg_replace;
use function preg_split;
use function rtrim;
use function strip_tags;
use function trim;

use const ENT_HTML5;
use const ENT_QUOTES;
use const ENT_SUBSTITUTE;
use const PREG_SET_ORDER;

/**
 * Plain-text ↔ structured-block ↔ HTML transformer. Useful for:
 * — turning long body copy into safe HTML paragraphs/lists
 * — deriving an SEO description (`toIntro`) from existing content.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
class Markup
{
    private const LIST_LINE_PATTERN = '/^\s*(?:[-*•·]|\d+\.)\s+(.*\S)\s*$/u';
    private const INLINE_BULLET_PATTERN = '/\s+[•·]\s+/u';
    private const INLINE_DASH_BULLET_PATTERN = '/([.!?])\s+([-*])\s+(?=[A-Z0-9])/u';
    private const PARAGRAPH_GAP_PATTERN = '/([.!?”"\')\]])[ \t]{2,}(?=\S)/u';
    private const ABBREVIATIONS = ['Mr', 'Mrs', 'Ms', 'Dr', 'Sr', 'Jr', 'St', 'vs', 'etc', 'e.g', 'i.e'];
    private const SENTENCE_SPLIT_PATTERN = '/(?<=[.!?])\s+(?=[A-Z0-9"\'(\[])/u';
    private const BLOCK_PATTERN = '/<p>(?<p>.*?)<\/p>|<ul>(?<ul>.*?)<\/ul>/su';
    private const LIST_ITEM_PATTERN = '/<li>(.*?)<\/li>/su';

    /**
     * @var array<int, string|array<int, string>>
     */
    private array $blocks;

    /**
     * @param array<int, string|array<int, string>> $blocks
     */
    private function __construct(array $blocks)
    {
        $this->blocks = $blocks;
    }

    public static function fromPlainText(string $text, ?MarkupConfiguration $config = null): self
    {
        $effectiveConfig = $config ?? new MarkupConfiguration(sentencesPerParagraph: 3);
        $trimmed = trim($text);

        if ($trimmed === '') {
            return new self([]);
        }

        $normalized = (string) preg_replace(self::INLINE_BULLET_PATTERN, "\n• ", $trimmed);
        $normalized = (string) preg_replace(self::INLINE_DASH_BULLET_PATTERN, "$1\n$2 ", $normalized);
        $normalized = (string) preg_replace(self::PARAGRAPH_GAP_PATTERN, "$1\n\n", $normalized);

        return new self(self::buildBlocksFromPlainText($normalized, $effectiveConfig));
    }

    public static function fromHtml(string $html): self
    {
        $trimmed = trim($html);

        if ($trimmed === '') {
            return new self([]);
        }

        $blocks = [];

        if (preg_match_all(self::BLOCK_PATTERN, $trimmed, $matches, PREG_SET_ORDER) === false) {
            return new self([]);
        }

        foreach ($matches as $match) {
            $paragraphInner = $match['p'] ?? '';
            $listInner = $match['ul'] ?? '';

            if ($paragraphInner !== '') {
                $blocks[] = self::decodeInline($paragraphInner);
                continue;
            }

            if ($listInner === '') {
                continue;
            }

            $items = [];
            if (preg_match_all(self::LIST_ITEM_PATTERN, $listInner, $itemMatches) !== false) {
                foreach ($itemMatches[1] ?? [] as $item) {
                    $items[] = self::decodeInline((string) $item);
                }
            }

            if ($items !== []) {
                $blocks[] = $items;
            }
        }

        return new self($blocks);
    }

    /**
     * @param array<int, string|array<int, string>> $blocks
     */
    public static function fromBlocks(array $blocks): self
    {
        foreach ($blocks as $block) {
            if (is_string($block)) {
                continue;
            }

            if (!is_array($block)) {
                throw new InvalidArgumentException(
                    'Each block must be a string (paragraph) or an array<string> (list items).',
                );
            }

            foreach ($block as $item) {
                if (!is_string($item)) {
                    throw new InvalidArgumentException(
                        'List-item blocks must contain only strings.',
                    );
                }
            }
        }

        return new self(array_values($blocks));
    }

    public function __toString(): string
    {
        return $this->toHtml();
    }

    public function toHtml(): string
    {
        if ($this->blocks === []) {
            return '';
        }

        $rendered = [];

        foreach ($this->blocks as $block) {
            if (is_string($block)) {
                $content = self::escape(rtrim($block));
                if ($content === '') {
                    continue;
                }
                $rendered[] = '<p>' . $content . '</p>';
                continue;
            }

            $items = array_values(array_filter(
                array_map(static fn (string $item): string => trim($item), $block),
                static fn (string $item): bool => $item !== '',
            ));

            if ($items === []) {
                continue;
            }

            $rendered[] = '<ul>'
                . implode('', array_map(
                    static fn (string $item): string => '<li>' . self::escape($item) . '</li>',
                    $items,
                ))
                . '</ul>';
        }

        return implode('', $rendered);
    }

    public function toIntro(int $maxLength = 180): string
    {
        if ($this->blocks === []) {
            return '';
        }

        foreach ($this->blocks as $block) {
            if (is_string($block)) {
                $plain = self::collapse($block);
                if ($plain !== '') {
                    return self::truncate($plain, $maxLength);
                }
                continue;
            }

            foreach ($block as $item) {
                $plain = self::collapse($item);
                if ($plain !== '') {
                    return self::truncate($plain, $maxLength);
                }
            }
        }

        return '';
    }

    public function toHtmlIntro(int $maxLength = 180): string
    {
        $plain = $this->toIntro($maxLength);

        return $plain === '' ? '' : '<p>' . self::escape($plain) . '</p>';
    }

    /**
     * @return array<int, string|array<int, string>>
     */
    public function blocks(): array
    {
        return $this->blocks;
    }

    /**
     * @return array<int, string|array<int, string>>
     */
    private static function buildBlocksFromPlainText(string $text, MarkupConfiguration $config): array
    {
        $blocks = [];
        $lines = preg_split('/\R/u', $text) ?: [];

        $proseBuffer = [];
        $listBuffer = [];

        $flushProse = function () use (&$proseBuffer, &$blocks, $config): void {
            if ($proseBuffer === []) {
                return;
            }
            $prose = trim(implode(' ', $proseBuffer));
            $proseBuffer = [];
            if ($prose === '') {
                return;
            }
            foreach (self::groupSentences($prose, $config) as $paragraph) {
                $blocks[] = $paragraph;
            }
        };

        $flushList = function () use (&$listBuffer, &$blocks): void {
            if ($listBuffer === []) {
                return;
            }
            $blocks[] = $listBuffer;
            $listBuffer = [];
        };

        foreach ($lines as $line) {
            if (trim($line) === '') {
                $flushProse();
                $flushList();
                continue;
            }

            if (\preg_match(self::LIST_LINE_PATTERN, $line, $matches) === 1) {
                $flushProse();
                $listBuffer[] = trim($matches[1]);
                continue;
            }

            $flushList();
            $proseBuffer[] = trim($line);
        }

        $flushProse();
        $flushList();

        return $blocks;
    }

    /**
     * @return array<int, string>
     */
    private static function groupSentences(string $prose, MarkupConfiguration $config): array
    {
        $masked = self::maskAbbreviations($prose);
        $sentences = preg_split(self::SENTENCE_SPLIT_PATTERN, $masked) ?: [];
        $sentences = array_values(array_filter(
            array_map(static fn (string $s): string => trim($s), $sentences),
            static fn (string $s): bool => $s !== '',
        ));

        if ($sentences === []) {
            return [];
        }

        $sentences = array_map(
            static fn (string $s): string => self::unmaskAbbreviations($s),
            $sentences,
        );

        $chunks = array_chunk($sentences, $config->sentencesPerParagraph);

        return array_map(
            static fn (array $chunk): string => implode(' ', $chunk),
            $chunks,
        );
    }

    private static function maskAbbreviations(string $text): string
    {
        foreach (self::ABBREVIATIONS as $abbr) {
            $escaped = preg_quote($abbr, '/');
            $text = preg_replace(
                '/\b' . $escaped . '\./u',
                $abbr . '§',
                $text,
            ) ?? $text;
        }

        $text = preg_replace('/(\d)\.(\d)/u', '$1§$2', $text) ?? $text;

        return $text;
    }

    private static function unmaskAbbreviations(string $text): string
    {
        return (string) preg_replace('/§/u', '.', $text);
    }

    private static function decodeInline(string $innerHtml): string
    {
        $plain = strip_tags($innerHtml);
        $plain = html_entity_decode($plain, ENT_QUOTES | ENT_HTML5, 'UTF-8');

        return trim((string) preg_replace('/\s+/u', ' ', $plain));
    }

    private static function collapse(string $value): string
    {
        return trim((string) preg_replace('/\s+/u', ' ', $value));
    }

    private static function truncate(string $plain, int $maxLength): string
    {
        if (mb_strlen($plain) <= $maxLength) {
            return $plain;
        }

        return rtrim(mb_substr($plain, 0, $maxLength)) . '…';
    }

    private static function escape(string $value): string
    {
        return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }
}
