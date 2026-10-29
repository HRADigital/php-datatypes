<?php

declare(strict_types=1);

namespace HraDigital\Tests\Datatypes\Unit\Datetime;

use HraDigital\Datatypes\Datetime\DateInterval;
use HraDigital\Datatypes\Datetime\DateTime;
use HraDigital\Datatypes\Datetime\DateTimeImmutable;
use HraDigital\Datatypes\Datetime\DateTimeZone;

/**
 * DateTimeImmutable's Unit testing.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 */
class DateTimeImmutableTest extends AbstractDatetimeContractTestCase
{
    protected function datetimeClass(): string
    {
        return DateTimeImmutable::class;
    }

    public function testChangingMethodsReturnANewInstance(): void
    {
        $original = DateTimeImmutable::fromString(self::DATETIME);

        $changed = [
            $original->add(DateInterval::fromDays(1)),
            $original->sub(DateInterval::fromDays(1)),
            $original->addSeconds(1),
            $original->addMinutes(1),
            $original->addHours(1),
            $original->addDays(1),
            $original->addMonths(1),
            $original->addYears(1),
            $original->subSeconds(1),
            $original->subMinutes(1),
            $original->subHours(1),
            $original->subDays(1),
            $original->subMonths(1),
            $original->subYears(1),
            $original->startOfDay(),
            $original->endOfDay(),
            $original->startOfMonth(),
            $original->endOfMonth(),
            $original->startOfYear(),
            $original->endOfYear(),
            $original->withTimezone(new DateTimeZone('Asia/Tokyo')),
        ];

        foreach ($changed as $result) {
            $this->assertNotSame($original, $result);
        }
        $this->assertEquals(self::DATETIME, (string) $original);
    }

    public function testCanConvertToMutable(): void
    {
        $immutable = DateTimeImmutable::fromString(self::DATETIME);

        $mutable = $immutable->toMutable();
        $mutable->addDays(1);

        $this->assertInstanceOf(DateTime::class, $mutable);
        $this->assertEquals('2021-05-07 10:11:12', (string) $mutable);
        $this->assertEquals(self::DATETIME, (string) $immutable);
    }
}
