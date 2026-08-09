<?php

/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at https://mozilla.org/MPL/2.0/.
 *
 * Copyright (c) HRADigital - Hugo Rafael Azevedo.
 */

declare(strict_types=1);

namespace HraDigital\Datatypes\Web\Seo;

/**
 * Twitter card layout. Maps to the `twitter:card` meta name.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 */
enum TwitterCardType: string
{
    case Summary           = 'summary';
    case SummaryLargeImage = 'summary_large_image';
    case App               = 'app';
    case Player            = 'player';
}
