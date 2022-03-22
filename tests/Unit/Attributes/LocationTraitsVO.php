<?php

declare(strict_types=1);

namespace HraDigital\Tests\Datatypes\Unit\Attributes;

use HraDigital\Datatypes\Traits\Entities\CanProcessOnUpdateEventsTrait;
use HraDigital\Datatypes\Attributes\Location\HasAddressTrait;
use HraDigital\Datatypes\Attributes\Location\HasCityTrait;
use HraDigital\Datatypes\Attributes\Location\HasCountryCodeTrait;
use HraDigital\Datatypes\Attributes\Location\HasCountryTrait;
use HraDigital\Datatypes\Attributes\Location\HasDistrictTrait;
use HraDigital\Datatypes\Attributes\Location\HasLatitudeTrait;
use HraDigital\Datatypes\Attributes\Location\HasLongitudeTrait;
use HraDigital\Datatypes\Attributes\Location\HasParishTrait;
use HraDigital\Datatypes\Attributes\Location\HasPostalCodeTrait;
use HraDigital\Datatypes\Attributes\Location\HasStreetAdditionalTrait;
use HraDigital\Datatypes\Attributes\Location\HasStreetNumberTrait;
use HraDigital\Datatypes\Attributes\Location\HasStreetTrait;
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
