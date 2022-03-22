<?php

declare(strict_types=1);

namespace HraDigital\Tests\Datatypes\Unit\Attributes;

use HraDigital\Datatypes\Exceptions\Datatypes\NonEmptyStringException;
use HraDigital\Tests\Datatypes\AbstractBaseTestCase;

/**
 * Testing Value Object for Personal Entity Traits.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
class PersonalTraitsVOTest extends AbstractBaseTestCase
{
    const DATA = [
        'country_of_birth' => 'Ukraine',
        'dob' => '1980-02-05 00:00:00',
        'gender' => 'Male',
        'nationality' => 'Ukrainian',
        'photo' => '/path/to/some/photo.jpg',
    ];

    public function testLoadsSuccessfully(): void
    {
        $object = new PersonalTraitsVO(self::DATA);

        $this->assertEquals(self::DATA['country_of_birth'], (string) $object->getCountryOfBirth());
        $this->assertEquals(self::DATA['dob'], (string) $object->getDateOfBirth());
        $this->assertEquals(self::DATA['gender'], (string) $object->getGender());
        $this->assertEquals(self::DATA['nationality'], (string) $object->getNationality());
        $this->assertEquals(self::DATA['photo'], (string) $object->getPhoto());
        $this->assertTrue($object->hasPhoto());
    }

    public function testBreaksWithEmptyCoutryOfBirth(): void
    {
        $data = self::DATA;
        $data['country_of_birth'] = ' ';

        $this->expectException(NonEmptyStringException::class);

        new PersonalTraitsVO($data);
    }

    public function testBreaksWithEmptyNationality(): void
    {
        $data = self::DATA;
        $data['nationality'] = ' ';

        $this->expectException(NonEmptyStringException::class);

        new PersonalTraitsVO($data);
    }

    public function testBreaksWithEmptyPhoto(): void
    {
        $data = self::DATA;
        $data['photo'] = ' ';

        $this->expectException(NonEmptyStringException::class);

        new PersonalTraitsVO($data);
    }
}
