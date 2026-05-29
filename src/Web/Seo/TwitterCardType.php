<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Web\Seo;

/**
 * Twitter card layout. Maps to the `twitter:card` meta name.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
enum TwitterCardType: string
{
    case Summary           = 'summary';
    case SummaryLargeImage = 'summary_large_image';
    case App               = 'app';
    case Player            = 'player';
}
