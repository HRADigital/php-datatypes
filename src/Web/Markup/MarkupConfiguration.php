<?php

/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at https://mozilla.org/MPL/2.0/.
 *
 * Copyright (c) HRADigital - Hugo Rafael Azevedo.
 */

declare(strict_types=1);

namespace HraDigital\Datatypes\Web\Markup;

use InvalidArgumentException;

/**
 * Knobs for {@see Markup} parsing — how many sentences group into a paragraph
 * when synthesising HTML from a flat plain-text string.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
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
