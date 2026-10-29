<?php

declare(strict_types=1);

namespace HraDigital\Tests\Datatypes\Unit\Datetime;

use HraDigital\Datatypes\Datetime\DateInterval;
use HraDigital\Datatypes\Datetime\DateTime;
use HraDigital\Datatypes\Datetime\DateTimeImmutable;
use HraDigital\Datatypes\Datetime\DateTimeZone;

/**
 * DateTime's Unit testing.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 */
class DateTimeTest extends AbstractDatetimeContractTestCase
{
    protected function datetimeClass(): string
    {
        return DateTime::class;
    }

    public function testChangingMethodsChangeAndReturnTheSameInstance(): void
    {
        $dt = DateTime::fromString('2024-02-15 10:11:12');

        $this->assertSame($dt, $dt->add(DateInterval::fromDays(1)));
        $this->assertEquals('2024-02-16 10:11:12', (string) $dt);
        $this->assertSame($dt, $dt->sub(DateInterval::fromHours(1)));
        $this->assertEquals('2024-02-16 09:11:12', (string) $dt);
        $this->assertSame($dt, $dt->addSeconds(1));
        $this->assertSame($dt, $dt->addMinutes(1));
        $this->assertSame($dt, $dt->addHours(1));
        $this->assertSame($dt, $dt->addDays(1));
        $this->assertSame($dt, $dt->addMonths(1));
        $this->assertSame($dt, $dt->addYears(1));
        $this->assertEquals('2025-03-17 10:12:13', (string) $dt);
        $this->assertSame($dt, $dt->subSeconds(1));
        $this->assertSame($dt, $dt->subMinutes(1));
        $this->assertSame($dt, $dt->subHours(1));
        $this->assertSame($dt, $dt->subDays(1));
        $this->assertSame($dt, $dt->subMonths(1));
        $this->assertSame($dt, $dt->subYears(1));
        $this->assertEquals('2024-02-16 09:11:12', (string) $dt);
        $this->assertSame($dt, $dt->startOfDay());
        $this->assertEquals('2024-02-16 00:00:00', (string) $dt);
        $this->assertSame($dt, $dt->endOfDay());
        $this->assertEquals('2024-02-16 23:59:59', (string) $dt);
        $this->assertSame($dt, $dt->startOfMonth());
        $this->assertEquals('2024-02-01 00:00:00', (string) $dt);
        $this->assertSame($dt, $dt->endOfMonth());
        $this->assertEquals('2024-02-29 23:59:59', (string) $dt);
        $this->assertSame($dt, $dt->startOfYear());
        $this->assertEquals('2024-01-01 00:00:00', (string) $dt);
        $this->assertSame($dt, $dt->endOfYear());
        $this->assertEquals('2024-12-31 23:59:59', (string) $dt);
        $this->assertSame($dt, $dt->withTimezone(new DateTimeZone('Asia/Tokyo')));
        $this->assertEquals('Asia/Tokyo', $dt->getTimezone()->getName());
    }

    public function testToNativeDoesNotExposeTheWrappedValue(): void
    {
        $dt = DateTime::fromString(self::DATETIME);

        $native = $dt->toNative();
        $dt->addDays(1);

        $this->assertEquals(self::DATETIME, $native->format('Y-m-d H:i:s'));
    }

    public function testCanConvertToImmutable(): void
    {
        $mutable = DateTime::fromString(self::DATETIME);

        $immutable = $mutable->toImmutable();
        $mutable->addDays(1);

        $this->assertInstanceOf(DateTimeImmutable::class, $immutable);
        $this->assertEquals(self::DATETIME, (string) $immutable);
    }
}
