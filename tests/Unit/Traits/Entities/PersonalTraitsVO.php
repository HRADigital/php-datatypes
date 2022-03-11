<?php

declare(strict_types=1);

namespace HraDigital\Tests\Datatypes\Unit\Traits\Entities;

use HraDigital\Datatypes\Traits\Entities\CanProcessOnUpdateEventsTrait;
use HraDigital\Datatypes\Traits\Entities\Personal\HasCountryOfBirthTrait;
use HraDigital\Datatypes\Traits\Entities\Personal\HasDateOfBirthTrait;
use HraDigital\Datatypes\Traits\Entities\Personal\HasGenderTrait;
use HraDigital\Datatypes\Traits\Entities\Personal\HasNationalityTrait;
use HraDigital\Datatypes\Traits\Entities\Personal\HasPhotoTrait;
use HraDigital\Datatypes\ValueObjects\AbstractValueObject;

/**
 * Testing Value Object for Personal Entity Traits.
 *
 * @package   Hradigital\Datatypes
 * @copyright Hradigital\Datatypes
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
