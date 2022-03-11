<?php

declare(strict_types=1);

namespace HraDigital\Tests\Datatypes\Unit\Traits\Entities;

use HraDigital\Datatypes\Traits\Entities\SocialMedia\HasFacebookProfileTrait;
use HraDigital\Datatypes\Traits\Entities\SocialMedia\HasInstagramProfileTrait;
use HraDigital\Datatypes\Traits\Entities\SocialMedia\HasLinkedinProfileTrait;
use HraDigital\Datatypes\Traits\Entities\SocialMedia\HasTwitterProfileTrait;
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
