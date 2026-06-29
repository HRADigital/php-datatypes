<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Web\Seo;

use HraDigital\Datatypes\Exceptions\Datatypes\InvalidSlugException;
use HraDigital\Datatypes\Exceptions\Datatypes\NonEmptyStringException;

/**
 * Slug datatype.
 *
 * URL-safe identifier composed of lowercase ASCII letters, digits and dashes.
 * Used as the human-readable key for entities exposed over HTTP.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
class Slug
{
    public const MAX_LENGTH = 191;

    private string $value;

    protected function __construct(string $value)
    {
        $trimmed = \trim($value);

        if ($trimmed === '') {
            throw NonEmptyStringException::withName('$slug');
        }

        $normalized = \strtolower($trimmed);

        if (\strlen($normalized) > self::MAX_LENGTH) {
            throw InvalidSlugException::withValue($normalized);
        }

        if (\preg_match('/^[a-z0-9]+(?:-[a-z0-9]+)*$/', $normalized) !== 1) {
            throw InvalidSlugException::withValue($normalized);
        }

        $this->value = $normalized;
    }

    /**
     * Builds a new Slug instance from a primitive string.
     *
     * @throws NonEmptyStringException When the supplied value is empty after trim.
     * @throws InvalidSlugException    When the supplied value violates the slug format.
     */
    public static function create(string $value): self
    {
        return new self($value);
    }

    /**
     * Builds a Slug derived from a free-form title.
     *
     * Transliterates accents to ASCII, lowercases, replaces every run of
     * non-alphanumeric characters with a single dash, trims dashes and
     * truncates to MAX_LENGTH before format validation.
     *
     * @throws NonEmptyStringException When the title yields no slug-safe characters.
     * @throws InvalidSlugException    When the derived value violates the slug format.
     */
    public static function fromTitle(string $title): self
    {
        $value = \strtolower(self::transliterate($title));
        $value = (string) \preg_replace('/[^a-z0-9]+/', '-', $value);
        $value = \trim($value, '-');

        if (\strlen($value) > self::MAX_LENGTH) {
            $value = \rtrim(\substr($value, 0, self::MAX_LENGTH), '-');
        }

        if ($value === '') {
            throw NonEmptyStringException::withName('$slug');
        }

        return new self($value);
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public function equals(self $other): bool
    {
        return $this->value === (string) $other;
    }

    /**
     * Maps common Latin accented characters to their ASCII equivalents
     * without relying on ext-intl or iconv.
     */
    private static function transliterate(string $value): string
    {
        static $map = [
            'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Ā' => 'A', 'Ă' => 'A', 'Ą' => 'A',
            'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'ā' => 'a', 'ă' => 'a', 'ą' => 'a',
            'Æ' => 'AE', 'æ' => 'ae',
            'Ç' => 'C', 'Ć' => 'C', 'Č' => 'C', 'Ĉ' => 'C', 'Ċ' => 'C',
            'ç' => 'c', 'ć' => 'c', 'č' => 'c', 'ĉ' => 'c', 'ċ' => 'c',
            'Ð' => 'D', 'Ď' => 'D', 'Đ' => 'D', 'ð' => 'd', 'ď' => 'd', 'đ' => 'd',
            'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ē' => 'E', 'Ĕ' => 'E', 'Ė' => 'E', 'Ę' => 'E', 'Ě' => 'E',
            'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ē' => 'e', 'ĕ' => 'e', 'ė' => 'e', 'ę' => 'e', 'ě' => 'e',
            'Ğ' => 'G', 'Ĝ' => 'G', 'Ġ' => 'G', 'Ģ' => 'G', 'ğ' => 'g', 'ĝ' => 'g', 'ġ' => 'g', 'ģ' => 'g',
            'Ĥ' => 'H', 'Ħ' => 'H', 'ĥ' => 'h', 'ħ' => 'h',
            'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 'Ĩ' => 'I', 'Ī' => 'I', 'Ĭ' => 'I', 'Į' => 'I', 'İ' => 'I',
            'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 'ĩ' => 'i', 'ī' => 'i', 'ĭ' => 'i', 'į' => 'i', 'ı' => 'i',
            'Ĵ' => 'J', 'ĵ' => 'j',
            'Ķ' => 'K', 'ķ' => 'k',
            'Ĺ' => 'L', 'Ļ' => 'L', 'Ľ' => 'L', 'Ł' => 'L', 'ĺ' => 'l', 'ļ' => 'l', 'ľ' => 'l', 'ł' => 'l',
            'Ñ' => 'N', 'Ń' => 'N', 'Ņ' => 'N', 'Ň' => 'N', 'ñ' => 'n', 'ń' => 'n', 'ņ' => 'n', 'ň' => 'n',
            'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ø' => 'O', 'Ō' => 'O', 'Ŏ' => 'O', 'Ő' => 'O',
            'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ø' => 'o', 'ō' => 'o', 'ŏ' => 'o', 'ő' => 'o',
            'Œ' => 'OE', 'œ' => 'oe',
            'Ŕ' => 'R', 'Ŗ' => 'R', 'Ř' => 'R', 'ŕ' => 'r', 'ŗ' => 'r', 'ř' => 'r',
            'Ś' => 'S', 'Ŝ' => 'S', 'Ş' => 'S', 'Š' => 'S', 'ś' => 's', 'ŝ' => 's', 'ş' => 's', 'š' => 's', 'ß' => 'ss',
            'Ţ' => 'T', 'Ť' => 'T', 'Ŧ' => 'T', 'ţ' => 't', 'ť' => 't', 'ŧ' => 't',
            'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ũ' => 'U', 'Ū' => 'U', 'Ŭ' => 'U',
            'Ů' => 'U', 'Ű' => 'U', 'Ų' => 'U',
            'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ũ' => 'u', 'ū' => 'u', 'ŭ' => 'u',
            'ů' => 'u', 'ű' => 'u', 'ų' => 'u',
            'Ŵ' => 'W', 'ŵ' => 'w',
            'Ý' => 'Y', 'Ŷ' => 'Y', 'Ÿ' => 'Y', 'ý' => 'y', 'ŷ' => 'y', 'ÿ' => 'y',
            'Ź' => 'Z', 'Ż' => 'Z', 'Ž' => 'Z', 'ź' => 'z', 'ż' => 'z', 'ž' => 'z',
            'Þ' => 'TH', 'þ' => 'th',
        ];

        return \strtr($value, $map);
    }
}
