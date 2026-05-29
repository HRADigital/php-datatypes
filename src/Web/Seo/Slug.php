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

    public function __toString(): string
    {
        return $this->value;
    }

    public function equals(self $other): bool
    {
        return $this->value === (string) $other;
    }
}
