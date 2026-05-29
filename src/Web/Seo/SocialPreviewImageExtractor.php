<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Web\Seo;

use function html_entity_decode;
use function preg_match;
use function trim;

use const ENT_HTML5;
use const ENT_QUOTES;

/**
 * Extracts the first preview image URL from an HTML document, honouring
 * og:image / twitter:image / link rel="image_src" — in that priority order.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
class SocialPreviewImageExtractor
{
    private const PATTERNS = [
        '/<meta[^>]+property\s*=\s*["\']og:image["\'][^>]*content\s*=\s*["\']([^"\']+)["\']/i',
        '/<meta[^>]+content\s*=\s*["\']([^"\']+)["\'][^>]*property\s*=\s*["\']og:image["\']/i',
        '/<meta[^>]+name\s*=\s*["\']twitter:image["\'][^>]*content\s*=\s*["\']([^"\']+)["\']/i',
        '/<meta[^>]+content\s*=\s*["\']([^"\']+)["\'][^>]*name\s*=\s*["\']twitter:image["\']/i',
        '/<link[^>]+rel\s*=\s*["\']image_src["\'][^>]*href\s*=\s*["\']([^"\']+)["\']/i',
    ];

    public function extract(string $html): ?string
    {
        if ($html === '') {
            return null;
        }

        foreach (self::PATTERNS as $pattern) {
            if (preg_match($pattern, $html, $matches) === 1) {
                $value = trim(html_entity_decode($matches[1], ENT_QUOTES | ENT_HTML5, 'UTF-8'));
                if ($value !== '') {
                    return $value;
                }
            }
        }

        return null;
    }
}
