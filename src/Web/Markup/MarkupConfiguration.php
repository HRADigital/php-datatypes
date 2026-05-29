<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Web\Markup;

use InvalidArgumentException;

/**
 * Knobs for {@see Markup} parsing — how many sentences group into a paragraph
 * when synthesising HTML from a flat plain-text string.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
class MarkupConfiguration
{
    public function __construct(
        public readonly int $sentencesPerParagraph,
    ) {
        if ($sentencesPerParagraph < 1) {
            throw new InvalidArgumentException(
                'sentencesPerParagraph must be a positive integer.',
            );
        }
    }
}
