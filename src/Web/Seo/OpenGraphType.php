<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Web\Seo;

/**
 * Open Graph object type. Maps to the `og:type` meta property.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
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
