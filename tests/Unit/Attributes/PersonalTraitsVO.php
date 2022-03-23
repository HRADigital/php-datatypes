<?php

declare(strict_types=1);

namespace HraDigital\Tests\Datatypes\Unit\Attributes;

use HraDigital\Datatypes\Attributes\Personal\HasCountryOfBirthTrait;
use HraDigital\Datatypes\Attributes\Personal\HasDateOfBirthTrait;
use HraDigital\Datatypes\Attributes\Personal\HasGenderTrait;
use HraDigital\Datatypes\Attributes\Personal\HasNationalityTrait;
use HraDigital\Datatypes\Attributes\Personal\HasPhotoTrait;
use HraDigital\Datatypes\ValueObjects\AbstractValueObject;
use HraDigital\Datatypes\ValueObjects\Traits\CanProcessOnUpdateEventsTrait;

/**
 * Testing Value Object for Personal Entity Traits.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
class PersonalTraitsVO extends AbstractValueObject
{
    use HasCountryOfBirthTrait,
        HasDateOfBirthTrait,
        HasGenderTrait,
        HasNationalityTrait,
        HasPhotoTrait,
        CanProcessOnUpdateEventsTrait;
}
