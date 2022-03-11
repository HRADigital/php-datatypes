<?php

declare(strict_types=1);

namespace HraDigital\Tests\Datatypes\Unit\Traits\Entities;

use HraDigital\Datatypes\Traits\Entities\Professional\HasIndustryTrait;
use HraDigital\Datatypes\Traits\Entities\Professional\HasOccupationTrait;
use HraDigital\Datatypes\ValueObjects\AbstractValueObject;

/**
 * Testing Value Object for Professional Entity Traits.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
class ProfessionalTraitsVO extends AbstractValueObject
{
    use HasIndustryTrait,
        HasOccupationTrait;
}
