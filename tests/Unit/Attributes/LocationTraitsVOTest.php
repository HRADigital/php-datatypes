<?php

declare(strict_types=1);

namespace HraDigital\Tests\Datatypes\Unit\Attributes;

use HraDigital\Datatypes\Exceptions\Datatypes\NonEmptyStringException;
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
use HraDigital\Tests\Datatypes\AbstractBaseTestCase;

/**
 * Testing Value Object for Location Entity Traits.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
class LocationTraitsVOTest extends AbstractBaseTestCase
{
    const DATA = [
        'address' => 'Main Street',
        'city' => 'Gotham',
        'country_code' => '123',
        'country' => 'USA',
        'district' => 'Mid-West',
        'latitude' => 14.12345,
        'longitude' => 12.654231,
        'parish' => 'SoHo',
        'postal_code' => 'PS13456',
        'street_additional' => 'Wayne Lane',
        'street_no' => '456',
        'street' => 'Main Street',
    ];

    public function testLoadsSuccessfully(): void
    {
        $object = new LocationTraitsVO(self::DATA);

        $this->assertEquals(self::DATA['address'], (string) $object->getAddress());
        $this->assertEquals(self::DATA['city'], (string) $object->getCity());
        $this->assertEquals(self::DATA['country_code'], (string) $object->getCountryCode());
        $this->assertEquals(self::DATA['country'], (string) $object->getCountry());
        $this->assertEquals(self::DATA['district'], (string) $object->getDistrict());
        $this->assertEquals(self::DATA['latitude'], (string) $object->getLatitude());
        $this->assertEquals(self::DATA['longitude'], (string) $object->getLongitude());
        $this->assertEquals(self::DATA['parish'], (string) $object->getParish());
        $this->assertEquals(self::DATA['postal_code'], (string) $object->getPostalCode());
        $this->assertEquals(self::DATA['street_additional'], (string) $object->getStreetAdditional());
        $this->assertEquals(self::DATA['street_no'], (string) $object->getStreetNumber());
        $this->assertEquals(self::DATA['street'], (string) $object->getStreet());
    }

    public function testBreaksWithEmptyCity(): void
    {
        $data = self::DATA;
        $data['city'] = ' ';

        $this->expectException(NonEmptyStringException::class);

        new LocationTraitsVO($data);
    }

    public function testBreaksWithEmptyDistrict(): void
    {
        $data = self::DATA;
        $data['district'] = ' ';

        $this->expectException(NonEmptyStringException::class);

        new LocationTraitsVO($data);
    }

    public function testBreaksWithEmptyParish(): void
    {
        $data = self::DATA;
        $data['parish'] = ' ';

        $this->expectException(NonEmptyStringException::class);

        new LocationTraitsVO($data);
    }
}
