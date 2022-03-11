<?php

declare(strict_types=1);

namespace HraDigital\Tests\Datatypes\Unit\Traits\Entities;

use HraDigital\Datatypes\Exceptions\Datatypes\NonEmptyStringException;
use HraDigital\Tests\Datatypes\AbstractBaseTestCase;

/**
 * Testing Value Object for Professional Entity Traits.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
class ProfessionalTraitsVOTest extends AbstractBaseTestCase
{
    const DATA = [
        'industry' => 'Information Technology',
        'occupation' => 'Developer',
    ];

    public function testLoadsSuccessfully(): void
    {
        $object = new ProfessionalTraitsVO(self::DATA);

        $this->assertEquals(self::DATA['industry'], (string) $object->getIndustry());
        $this->assertEquals(self::DATA['occupation'], (string) $object->getOccupation());
        $this->assertTrue($object->hasOccupation());
    }

    public function testBreaksWithEmptyIndustry(): void
    {
        $data = self::DATA;
        $data['industry'] = ' ';

        $this->expectException(NonEmptyStringException::class);

        new ProfessionalTraitsVO($data);
    }

    public function testBreaksWithEmptyOccupation(): void
    {
        $data = self::DATA;
        $data['occupation'] = ' ';

        $this->expectException(NonEmptyStringException::class);

        new ProfessionalTraitsVO($data);
    }
}
