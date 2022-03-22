<?php

declare(strict_types=1);

namespace HraDigital\Tests\Datatypes\Unit\Attributes;

use HraDigital\Tests\Datatypes\AbstractBaseTestCase;

/**
 * Testing Value Object for Timezone Entity Traits.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
class TimezoneTraitsVOTest extends AbstractBaseTestCase
{
    const DATA = [
        'timestamp' => 123456789,
    ];

    public function testLoadsSuccessfully(): void
    {
        $object = new TimezoneTraitsVO(self::DATA);

        $this->assertEquals(self::DATA['timestamp'], (string) $object->getTimestamp());
    }
}
