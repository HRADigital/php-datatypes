<?php

declare(strict_types=1);

namespace HraDigital\Tests\Datatypes\Unit\Traits\Entities;

use HraDigital\Datatypes\Traits\Entities\CanProcessOnUpdateEventsTrait;
use HraDigital\Datatypes\Traits\Entities\Location\HasAddressTrait;
use HraDigital\Datatypes\Traits\Entities\Location\HasCityTrait;
use HraDigital\Datatypes\Traits\Entities\Location\HasCountryCodeTrait;
use HraDigital\Datatypes\Traits\Entities\Location\HasCountryTrait;
use HraDigital\Datatypes\Traits\Entities\Location\HasDistrictTrait;
use HraDigital\Datatypes\Traits\Entities\Location\HasLatitudeTrait;
use HraDigital\Datatypes\Traits\Entities\Location\HasLongitudeTrait;
use HraDigital\Datatypes\Traits\Entities\Location\HasParishTrait;
use HraDigital\Datatypes\Traits\Entities\Location\HasPostalCodeTrait;
use HraDigital\Datatypes\Traits\Entities\Location\HasStreetAdditionalTrait;
use HraDigital\Datatypes\Traits\Entities\Location\HasStreetNumberTrait;
use HraDigital\Datatypes\Traits\Entities\Location\HasStreetTrait;
use HraDigital\Datatypes\ValueObjects\AbstractValueObject;

/**
 * Testing Value Object for Location Entity Traits.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
class LocationTraitsVO extends AbstractValueObject
{
    use HasAddressTrait,
        HasCityTrait,
        HasCountryCodeTrait,
        HasCountryTrait,
        HasDistrictTrait,
        HasLatitudeTrait,
        HasLongitudeTrait,
        HasParishTrait,
        HasPostalCodeTrait,
        HasStreetAdditionalTrait,
        HasStreetNumberTrait,
        HasStreetTrait,
        CanProcessOnUpdateEventsTrait;
}
