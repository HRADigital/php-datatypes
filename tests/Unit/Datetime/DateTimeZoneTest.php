<?php declare(strict_types=1);

namespace HraDigital\Tests\Datatypes\Unit\Datetime;

use HraDigital\Datatypes\Datetime\DateTimeImmutable;
use HraDigital\Datatypes\Datetime\DateTimeZone;
use HraDigital\Tests\Datatypes\AbstractBaseTestCase;

/**
 * DateTimeZone's Unit testing.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 */
class DateTimeZoneTest extends AbstractBaseTestCase
{
    public function testEqualsIsTrueForTheSameName(): void
    {
        $timezone = new DateTimeZone('Europe/Lisbon');

        $this->assertTrue($timezone->equals(new DateTimeZone('Europe/Lisbon')));
    }

    public function testEqualsIsTrueForTheTimezoneOfADatetime(): void
    {
        $timezone = new DateTimeZone('Europe/Lisbon');
        $datetime = DateTimeImmutable::fromString('2021-05-06 10:00:00', $timezone);

        $this->assertTrue($datetime->getTimezone()->equals($timezone));
    }

    public function testEqualsIsFalseForDifferentNames(): void
    {
        $timezone = new DateTimeZone('Europe/Lisbon');

        $this->assertFalse($timezone->equals(new DateTimeZone('Europe/Madrid')));
    }

    /**
     * Tests equals() compares the name, not the offset: a fixed offset is not a named zone.
     */
    public function testEqualsIsFalseForTheSameOffsetWithADifferentName(): void
    {
        $this->assertFalse((new DateTimeZone('UTC'))->equals(new DateTimeZone('+00:00')));
    }
}
