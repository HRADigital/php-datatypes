<?php

declare(strict_types=1);

namespace HraDigital\Tests\Datatypes\Unit\Attributes;

use HraDigital\Datatypes\Attributes\SocialMedia\HasFacebookProfileTrait;
use HraDigital\Datatypes\Attributes\SocialMedia\HasInstagramProfileTrait;
use HraDigital\Datatypes\Attributes\SocialMedia\HasLinkedinProfileTrait;
use HraDigital\Datatypes\Attributes\SocialMedia\HasTwitterProfileTrait;
use HraDigital\Datatypes\ValueObjects\AbstractValueObject;

/**
 * Testing Value Object for Social Media Entity Traits.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
class SocialMediaTraitsVO extends AbstractValueObject
{
    use HasFacebookProfileTrait,
        HasInstagramProfileTrait,
        HasLinkedinProfileTrait,
        HasTwitterProfileTrait;
}
