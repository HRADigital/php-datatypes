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
 * Open Graph object type. Maps to the `og:type` meta property.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 */
enum OpenGraphType: string
{
    case Website = 'website';
    case Article = 'article';
    case Profile = 'profile';
    case Product = 'product';
    case Book    = 'book';
    case Video   = 'video.other';
    case Music   = 'music.song';
}
