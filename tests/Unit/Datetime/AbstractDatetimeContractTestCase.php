<?php

declare(strict_types=1);

namespace HraDigital\Tests\Datatypes\Unit\Datetime;

use DateTime as NativeDateTime;
use DateTimeImmutable as NativeDateTimeImmutable;
use HraDigital\Datatypes\Datetime\Clock;
use HraDigital\Datatypes\Datetime\DateInterval;
use HraDigital\Datatypes\Datetime\DatetimeContract;
use HraDigital\Datatypes\Datetime\DateTimeZone;
use HraDigital\Datatypes\Datetime\FrozenClock;
use HraDigital\Datatypes\Exceptions\Datatypes\InvalidDatetimeException;
use HraDigital\Datatypes\Scalar\Str;
use HraDigital\Tests\Datatypes\AbstractBaseTestCase;
use InvalidArgumentException;
use function json_encode;

/**
 * Unit tests for every method of the DatetimeContract, run once per implementing class.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 */
abstract class AbstractDatetimeContractTestCase extends AbstractBaseTestCase
{
    const DATETIME = '2021-05-06 10:11:12';

    /**
     * @return class-string<DatetimeContract>
     */
    abstract protected function datetimeClass(): string;

    protected function tearDown(): void
    {
        Clock::reset();

        parent::tearDown();
    }

    protected function create(string $datetime = self::DATETIME, ?DateTimeZone $timezone = null): DatetimeContract
    {
        return $this->datetimeClass()::fromString($datetime, $timezone);
    }

    protected function freezeClock(string $datetime): void
    {
        Clock::set(new FrozenClock(new NativeDateTimeImmutable($datetime)));
    }

    public function testCanInstantiateSuccessfullyFromString(): void
    {
        $dt = $this->create();

        $this->assertInstanceOf($this->datetimeClass(), $dt);
        $this->assertEquals(2021, $dt->getYear());
        $this->assertEquals(5, $dt->getMonth());
        $this->assertEquals(6, $dt->getDay());
        $this->assertEquals(10, $dt->getHour());
        $this->assertEquals(11, $dt->getMinute());
        $this->assertEquals(12, $dt->getSecond());
        $this->assertEquals(self::DATETIME, (string) $dt);
        $this->assertEquals(self::DATETIME, $dt->jsonSerialize());
        $this->assertEquals('"' . self::DATETIME . '"', json_encode($dt));
    }

    public function testFromStringWithTimezone(): void
    {
        $dt = $this->create(self::DATETIME, new DateTimeZone('Asia/Tokyo'));

        $this->assertEquals('Asia/Tokyo', $dt->getTimezone()->getName());
        $this->assertEquals(self::DATETIME, (string) $dt);
    }

    public function testFromStringWithoutValueReadsTheClock(): void
    {
        $this->freezeClock('2020-01-02 03:04:05');

        $this->assertEquals('2020-01-02 03:04:05', (string) $this->datetimeClass()::fromString());
    }

    public function testFromStringRejectsAnUnparsableString(): void
    {
        $this->expectException(InvalidDatetimeException::class);

        $this->create('not a date');
    }

    public function testFromStringRejectsADateThatDoesNotExist(): void
    {
        $this->expectException(InvalidDatetimeException::class);

        $this->create('2021-02-30 10:00:00');
    }

    public function testNowReadsTheClock(): void
    {
        $this->freezeClock('2020-01-02 03:04:05.123456');

        $now = $this->datetimeClass()::now();

        $this->assertInstanceOf($this->datetimeClass(), $now);
        $this->assertEquals('2020-01-02 03:04:05', (string) $now);
        $this->assertEquals(123456, $now->getMicrosecond());
    }

    public function testTodayReadsTheClock(): void
    {
        $this->freezeClock('2020-01-02 03:04:05.123456');

        $this->assertEquals('2020-01-02 00:00:00.000000', $this->datetimeClass()::today()->format('Y-m-d H:i:s.u'));
    }

    public function testTomorrowReadsTheClock(): void
    {
        $this->freezeClock('2020-01-31 03:04:05');

        $this->assertEquals('2020-02-01 00:00:00', (string) $this->datetimeClass()::tomorrow());
    }

    public function testYesterdayReadsTheClock(): void
    {
        $this->freezeClock('2020-03-01 03:04:05');

        $this->assertEquals('2020-02-29 00:00:00', (string) $this->datetimeClass()::yesterday());
    }

    public function testEveryFactoryReturnsTheCalledClass(): void
    {
        $class = $this->datetimeClass();

        $this->assertInstanceOf($class, $class::now());
        $this->assertInstanceOf($class, $class::today());
        $this->assertInstanceOf($class, $class::tomorrow());
        $this->assertInstanceOf($class, $class::yesterday());
        $this->assertInstanceOf($class, $class::fromString(self::DATETIME));
        $this->assertInstanceOf($class, $class::fromTimestamp(0));
        $this->assertInstanceOf($class, $class::fromUnits(2021, 5, 6));
        $this->assertInstanceOf($class, $class::fromNative(new NativeDateTimeImmutable()));
    }

    public function testCanInstantiateFromTimestamp(): void
    {
        $dt = $this->datetimeClass()::fromTimestamp(0, new DateTimeZone('UTC'));

        $this->assertEquals('1970-01-01 00:00:00', (string) $dt);
        $this->assertEquals(0, $dt->getTimestamp());
        $this->assertEquals('UTC', $dt->getTimezone()->getName());
    }

    public function testFromTimestampWithoutTimezoneUsesTheDefaultOne(): void
    {
        $native = new NativeDateTimeImmutable(self::DATETIME);

        $dt = $this->datetimeClass()::fromTimestamp($native->getTimestamp());

        $this->assertEquals(self::DATETIME, (string) $dt);
        $this->assertEquals($native->getTimezone()->getName(), $dt->getTimezone()->getName());
    }

    public function testCanInstantiateFromUnits(): void
    {
        $dt = $this->datetimeClass()::fromUnits(2020, 11, 10, 9, 30, 5);

        $this->assertEquals('2020-11-10 09:30:05', (string) $dt);
    }

    public function testFromUnitsWithoutTimezoneUsesUtcOffset(): void
    {
        $dt = $this->datetimeClass()::fromUnits(2020, 11, 10);

        $this->assertEquals('+00:00', $dt->getTimezone()->getName());
        $this->assertEquals('2020-11-10 00:00:00', (string) $dt);
    }

    public function testFromUnitsUsesTheSuppliedTimezone(): void
    {
        $dt = $this->datetimeClass()::fromUnits(2020, 11, 10, 9, 30, 0, new DateTimeZone('Europe/Lisbon'));

        $this->assertEquals('Europe/Lisbon', $dt->getTimezone()->getName());
        $this->assertEquals('2020-11-10 09:30:00', (string) $dt);
    }

    public function testFromUnitsRejectsAnInvalidDate(): void
    {
        $this->expectException(InvalidDatetimeException::class);

        $this->datetimeClass()::fromUnits(2021, 2, 30);
    }

    public function testFromUnitsRejectsAnInvalidTime(): void
    {
        $this->expectException(InvalidDatetimeException::class);

        $this->datetimeClass()::fromUnits(2021, 2, 1, 24);
    }

    public function testCanInstantiateFromNativeMutable(): void
    {
        $native = new NativeDateTime(self::DATETIME);

        $dt = $this->datetimeClass()::fromNative($native);
        $native->modify('+1 day');

        $this->assertInstanceOf($this->datetimeClass(), $dt);
        $this->assertEquals(self::DATETIME, (string) $dt);
    }

    public function testCanInstantiateFromNativeImmutable(): void
    {
        $dt = $this->datetimeClass()::fromNative(new NativeDateTimeImmutable(self::DATETIME));

        $this->assertInstanceOf($this->datetimeClass(), $dt);
        $this->assertEquals(self::DATETIME, (string) $dt);
    }

    public function testToNativeReturnsACopy(): void
    {
        $dt = $this->create();

        $first = $dt->toNative();
        $second = $dt->toNative();

        $this->assertNotSame($first, $second);
        $this->assertEquals(self::DATETIME, $first->format('Y-m-d H:i:s'));
    }

    public function testFormatAndTimestampMatchTheNativeValue(): void
    {
        $native = new NativeDateTimeImmutable(self::DATETIME);
        $dt = $this->create();

        $this->assertEquals($native->format('d/m/Y H:i'), $dt->format('d/m/Y H:i'));
        $this->assertEquals($native->getTimestamp(), $dt->getTimestamp());
    }

    public function testKeepsTheFormatConstants(): void
    {
        $this->assertEquals(NativeDateTimeImmutable::ATOM, $this->datetimeClass()::ATOM);
        $this->assertEquals(NativeDateTimeImmutable::W3C, $this->datetimeClass()::W3C);
    }

    /**
     * @return array<string, array{string, string}>
     */
    public static function formatProvider(): array
    {
        return [
            'ATOM'             => ['toATOM', NativeDateTimeImmutable::ATOM],
            'COOKIE'           => ['toCookie', NativeDateTimeImmutable::COOKIE],
            'ISO8601'          => ['toISO8601', NativeDateTimeImmutable::ISO8601],
            'RFC822'           => ['toRFC822', NativeDateTimeImmutable::RFC822],
            'RFC850'           => ['toRFC850', NativeDateTimeImmutable::RFC850],
            'RFC1036'          => ['toRFC1036', NativeDateTimeImmutable::RFC1036],
            'RFC1123'          => ['toRFC1123', NativeDateTimeImmutable::RFC1123],
            'RFC7231'          => ['toRFC7231', NativeDateTimeImmutable::RFC7231],
            'RFC2822'          => ['toRFC2822', NativeDateTimeImmutable::RFC2822],
            'RFC3339'          => ['toRFC3339', NativeDateTimeImmutable::RFC3339],
            'RFC3339_EXTENDED' => ['toRFC3339Extended', NativeDateTimeImmutable::RFC3339_EXTENDED],
            'RSS'              => ['toRSS', NativeDateTimeImmutable::RSS],
            'W3C'              => ['toW3C', NativeDateTimeImmutable::W3C],
            'Datetime string'  => ['toDatetimeString', 'Y-m-d H:i:s'],
            'Date string'      => ['toDateString', 'Y-m-d'],
            'Time string'      => ['toTimeString', 'H:i:s'],
        ];
    }

    /**
     * @dataProvider formatProvider
     */
    public function testCanOutputInFormat(string $method, string $format): void
    {
        $result = $this->create()->{$method}();

        $this->assertInstanceOf(Str::class, $result);
        $this->assertEquals((new NativeDateTimeImmutable(self::DATETIME))->format($format), (string) $result);
    }

    public function testCanOutputInSuppliedFormat(): void
    {
        $this->assertEquals('06/05/2021', (string) $this->create()->toFormat(Str::create('d/m/Y')));
    }

    public function testCanOutputLocalizedDateTimeForEnglishLocale(): void
    {
        $formatted = (string) $this->create()
            ->toLocalizedDateTime(Str::create('long'), Str::create('short'), Str::create('en_GB'));

        $this->assertEquals('6 May 2021 at 10:11', $formatted);
    }

    public function testCanOutputLocalizedDateTimeForPortugueseLocale(): void
    {
        $formatted = (string) $this->create()
            ->toLocalizedDateTime(Str::create('long'), Str::create('short'), Str::create('pt_PT'));

        $this->assertEquals('6 de maio de 2021 às 10:11', $formatted);
    }

    public function testCanOutputLocalizedDateOnly(): void
    {
        $formatted = (string) $this->create()
            ->toLocalizedDateTime(Str::create('long'), Str::create('none'), Str::create('pt_PT'));

        $this->assertEquals('6 de maio de 2021', $formatted);
    }

    public function testLocalizedDateTimeStyleIsCaseInsensitive(): void
    {
        $dt = $this->create();

        $lower = $dt->toLocalizedDateTime(Str::create('medium'), Str::create('short'), Str::create('en_GB'));
        $upper = $dt->toLocalizedDateTime(Str::create('MEDIUM'), Str::create('SHORT'), Str::create('en_GB'));

        $this->assertEquals((string) $lower, (string) $upper);
    }

    public function testLocalizedDateTimeRejectsInvalidStyle(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->create()->toLocalizedDateTime(Str::create('huge'), Str::create('short'), Str::create('en_GB'));
    }

    public function testCanReadCalendarUnits(): void
    {
        // 2021-05-06 is a Thursday, in ISO week 18.
        $dt = $this->create('2021-05-06 10:11:12.654321');

        $this->assertEquals(654321, $dt->getMicrosecond());
        $this->assertEquals(4, $dt->getDayOfWeek());
        $this->assertEquals(126, $dt->getDayOfYear());
        $this->assertEquals(18, $dt->getWeekOfYear());
        $this->assertEquals(2, $dt->getQuarter());
        $this->assertFalse($dt->isWeekend());
    }

    public function testDayOfYearStartsAtOne(): void
    {
        $this->assertEquals(1, $this->create('2021-01-01')->getDayOfYear());
        $this->assertEquals(365, $this->create('2021-12-31')->getDayOfYear());
    }

    public function testWeekOfYearFollowsIso8601(): void
    {
        // 2021-01-01 is a Friday, so it belongs to the last ISO week of 2020.
        $this->assertEquals(53, $this->create('2021-01-01')->getWeekOfYear());
    }

    /**
     * @return array<string, array{string, int}>
     */
    public static function quarterProvider(): array
    {
        return [
            'January'   => ['2021-01-15', 1],
            'March'     => ['2021-03-31', 1],
            'April'     => ['2021-04-01', 2],
            'September' => ['2021-09-30', 3],
            'October'   => ['2021-10-01', 4],
            'December'  => ['2021-12-31', 4],
        ];
    }

    /**
     * @dataProvider quarterProvider
     */
    public function testCanReadQuarter(string $date, int $quarter): void
    {
        $this->assertEquals($quarter, $this->create($date)->getQuarter());
    }

    public function testCanDetectWeekend(): void
    {
        $this->assertEquals(6, $this->create('2021-05-08')->getDayOfWeek());
        $this->assertTrue($this->create('2021-05-08')->isWeekend());
        $this->assertEquals(7, $this->create('2021-05-09')->getDayOfWeek());
        $this->assertTrue($this->create('2021-05-09')->isWeekend());
        $this->assertEquals(1, $this->create('2021-05-10')->getDayOfWeek());
        $this->assertFalse($this->create('2021-05-10')->isWeekend());
    }

    public function testIsTodayReadsTheClock(): void
    {
        $this->freezeClock('2021-05-06 23:00:00');

        $this->assertTrue($this->create('2021-05-06 00:00:00')->isToday());
        $this->assertFalse($this->create('2021-05-07 00:00:00')->isToday());
    }

    public function testIsPastAndIsFutureReadTheClock(): void
    {
        $this->freezeClock(self::DATETIME);

        $this->assertTrue($this->create('2021-05-06 10:11:11')->isPast());
        $this->assertFalse($this->create('2021-05-06 10:11:11')->isFuture());
        $this->assertTrue($this->create('2021-05-06 10:11:13')->isFuture());
        $this->assertFalse($this->create('2021-05-06 10:11:13')->isPast());
        $this->assertFalse($this->create()->isPast());
        $this->assertFalse($this->create()->isFuture());
    }

    public function testComparesTheInstant(): void
    {
        $earlier = $this->create('2021-05-06 10:11:12.000001');
        $later = $this->create('2021-05-06 10:11:12.000002');

        $this->assertEquals(-1, $earlier->compare($later));
        $this->assertEquals(1, $later->compare($earlier));
        $this->assertEquals(0, $earlier->compare($this->create('2021-05-06 10:11:12.000001')));
        $this->assertTrue($earlier->isBefore($later));
        $this->assertFalse($later->isBefore($earlier));
        $this->assertTrue($later->isAfter($earlier));
        $this->assertFalse($earlier->isAfter($later));
        $this->assertFalse($earlier->equals($later));
    }

    public function testEqualsIgnoresTheTimezone(): void
    {
        $utc = $this->create('2021-05-06 10:00:00', new DateTimeZone('UTC'));
        $lisbon = $this->create('2021-05-06 11:00:00', new DateTimeZone('Europe/Lisbon'));

        $this->assertTrue($utc->equals($lisbon));
    }

    public function testIsBetween(): void
    {
        $start = $this->create('2021-05-01');
        $end = $this->create('2021-05-31');

        $this->assertTrue($this->create('2021-05-15')->isBetween($start, $end));
        $this->assertTrue($this->create('2021-05-01')->isBetween($start, $end));
        $this->assertTrue($this->create('2021-05-31')->isBetween($start, $end));
        $this->assertFalse($this->create('2021-05-01')->isBetween($start, $end, false));
        $this->assertFalse($this->create('2021-05-31')->isBetween($start, $end, false));
        $this->assertTrue($this->create('2021-05-15')->isBetween($start, $end, false));
        $this->assertFalse($this->create('2021-06-01')->isBetween($start, $end));
    }

    public function testDiffReturnsAPackageInterval(): void
    {
        $diff = $this->create('2021-05-06 10:00:00')->diff($this->create('2022-07-09 12:30:15'));

        $this->assertInstanceOf(DateInterval::class, $diff);
        $this->assertEquals('P1Y2M3DT2H30M15S', (string) $diff->toDuration());
        $this->assertFalse($diff->isNegative());
    }

    public function testDiffIsNegativeWhenTheOtherInstanceIsBefore(): void
    {
        $diff = $this->create('2021-05-06')->diff($this->create('2021-05-01'));

        $this->assertTrue($diff->isNegative());
        $this->assertEquals(-5, $diff->getDays());
    }

    public function testGetTimezoneReturnsAPackageTimezone(): void
    {
        $timezone = $this->create(self::DATETIME, new DateTimeZone('Europe/Lisbon'))->getTimezone();

        $this->assertInstanceOf(DateTimeZone::class, $timezone);
        $this->assertEquals('Europe/Lisbon', $timezone->getName());
    }

    public function testWithTimezoneKeepsTheInstant(): void
    {
        $utc = $this->create('2021-05-06 10:00:00', new DateTimeZone('UTC'));
        $timestamp = $utc->getTimestamp();

        $tokyo = $utc->withTimezone(new DateTimeZone('Asia/Tokyo'));

        $this->assertEquals('Asia/Tokyo', $tokyo->getTimezone()->getName());
        $this->assertEquals('2021-05-06 19:00:00', (string) $tokyo);
        $this->assertEquals($timestamp, $tokyo->getTimestamp());
    }

    public function testCanAddAndSubtractAnInterval(): void
    {
        $this->assertEquals('2022-05-06 10:11:12', (string) $this->create()->add(DateInterval::fromYears(1)));
        $this->assertEquals('2020-05-06 10:11:12', (string) $this->create()->sub(DateInterval::fromYears(1)));
    }

    /**
     * @return array<string, array{string, int, string}>
     */
    public static function unitProvider(): array
    {
        return [
            'add seconds'          => ['addSeconds', 50, '2021-05-06 10:12:02'],
            'add minutes'          => ['addMinutes', 50, '2021-05-06 11:01:12'],
            'add hours'            => ['addHours', 14, '2021-05-07 00:11:12'],
            'add days'             => ['addDays', 26, '2021-06-01 10:11:12'],
            'add months'           => ['addMonths', 8, '2022-01-06 10:11:12'],
            'add years'            => ['addYears', 3, '2024-05-06 10:11:12'],
            'add negative seconds' => ['addSeconds', -13, '2021-05-06 10:10:59'],
            'add negative days'    => ['addDays', -6, '2021-04-30 10:11:12'],
            'sub seconds'          => ['subSeconds', 13, '2021-05-06 10:10:59'],
            'sub minutes'          => ['subMinutes', 12, '2021-05-06 09:59:12'],
            'sub hours'            => ['subHours', 11, '2021-05-05 23:11:12'],
            'sub days'             => ['subDays', 6, '2021-04-30 10:11:12'],
            'sub months'           => ['subMonths', 5, '2020-12-06 10:11:12'],
            'sub years'            => ['subYears', 3, '2018-05-06 10:11:12'],
            'sub negative hours'   => ['subHours', -14, '2021-05-07 00:11:12'],
        ];
    }

    /**
     * @dataProvider unitProvider
     */
    public function testCanAddAndSubtractUnits(string $method, int $value, string $expected): void
    {
        $result = $this->create()->{$method}($value);

        $this->assertInstanceOf($this->datetimeClass(), $result);
        $this->assertEquals($expected, (string) $result);
    }

    /**
     * @return array<string, array{string, string}>
     */
    public static function boundaryProvider(): array
    {
        return [
            'start of day'   => ['startOfDay', '2024-02-15 00:00:00.000000'],
            'end of day'     => ['endOfDay', '2024-02-15 23:59:59.999999'],
            'start of month' => ['startOfMonth', '2024-02-01 00:00:00.000000'],
            'end of month'   => ['endOfMonth', '2024-02-29 23:59:59.999999'],
            'start of year'  => ['startOfYear', '2024-01-01 00:00:00.000000'],
            'end of year'    => ['endOfYear', '2024-12-31 23:59:59.999999'],
        ];
    }

    /**
     * @dataProvider boundaryProvider
     */
    public function testCanMoveToBoundaries(string $method, string $expected): void
    {
        $result = $this->create('2024-02-15 10:11:12.123456')->{$method}();

        $this->assertInstanceOf($this->datetimeClass(), $result);
        $this->assertEquals($expected, $result->format('Y-m-d H:i:s.u'));
    }
}
