<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Web\Seo;

use HraDigital\Datatypes\Exceptions\Datatypes\NonEmptyStringException;
use InvalidArgumentException;

use function filter_var;
use function trim;

use const FILTER_VALIDATE_URL;

/**
 * Image used in social previews (og:image / twitter:image).
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
class SocialImage
{
    public readonly string $url;
    public readonly string $alt;
    public readonly ?int $width;
    public readonly ?int $height;

    public static function create(
        string $url,
        string $alt = '',
        ?int $width = null,
        ?int $height = null,
    ): SocialImage {
        return new SocialImage($url, $alt, $width, $height);
    }

    private function __construct(string $url, string $alt, ?int $width, ?int $height)
    {
        $trimmed = trim($url);
        if ($trimmed === '') {
            throw NonEmptyStringException::withName('$url');
        }
        if (filter_var($trimmed, FILTER_VALIDATE_URL) === false) {
            throw new InvalidArgumentException(\sprintf('Invalid image URL: "%s".', $trimmed));
        }
        if ($width !== null && $width <= 0) {
            throw new InvalidArgumentException('$width must be a positive integer.');
        }
        if ($height !== null && $height <= 0) {
            throw new InvalidArgumentException('$height must be a positive integer.');
        }

        $this->url    = $trimmed;
        $this->alt    = trim($alt);
        $this->width  = $width;
        $this->height = $height;
    }

    public function hasDimensions(): bool
    {
        return $this->width !== null && $this->height !== null;
    }

    public function __toString(): string
    {
        return $this->url;
    }
}
