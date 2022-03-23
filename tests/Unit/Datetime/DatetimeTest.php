<?php

declare(strict_types=1);

namespace HraDigital\Tests\Datatypes\Unit\Datetime;

use HraDigital\Datatypes\Datetime\Datetime;
use HraDigital\Datatypes\Scalar\Str;
use HraDigital\Tests\Datatypes\AbstractBaseTestCase;

/**
 * Datetime's Unit testing.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
class DatetimeTest extends AbstractBaseTestCase
{
    const DATETIME = '2021-05-06 10:11:12';

    public function testCanInstanciateSuccessfullyFromString(): void
    {
        $dt = Datetime::fromString(self::DATETIME);

        $this->assertInstanceOf(Datetime::class, $dt);
        $this->assertEquals($dt->getYear(), 2021);
        $this->assertEquals($dt->getMonth(), 5);
        $this->assertEquals($dt->getDay(), 6);
        $this->assertEquals($dt->getHour(), 10);
        $this->assertEquals($dt->getMinute(), 11);
        $this->assertEquals($dt->getSecond(), 12);
        $this->assertEquals((string) $dt, self::DATETIME);
        $this->assertEquals($dt->jsonSerialize(), self::DATETIME);
    }

    public function testCanInstantiateSuccessfullyFromNow(): void
    {
        $datetime = Datetime::now();
        $native = new \DateTime('now');

        $this->assertEquals(
            $datetime->toDateString(),
            $native->format('Y-m-d')
        );
    }

    public function testCanInstantiateSuccessfullyFromToday(): void
    {
        $datetime = Datetime::today();
        $native = new \DateTime('now');

        $this->assertEquals(
            $datetime->toDateString(),
            $native->format('Y-m-d')
        );
        $this->assertEquals(0, $datetime->getHour());
        $this->assertEquals(0, $datetime->getMinute());
        $this->assertEquals(0, $datetime->getSecond());
    }

    public function testCanInstantiateSuccessfullyFromTomorrow(): void
    {
        $datetime = Datetime::tomorrow();
        $native = new \DateTime('now');

        $this->assertEquals(
            $datetime->addDays(-1)->toDateString(),
            $native->format('Y-m-d')
        );
        $this->assertEquals(0, $datetime->getHour());
        $this->assertEquals(0, $datetime->getMinute());
        $this->assertEquals(0, $datetime->getSecond());
    }

    public function testCanInstantiateSuccessfullyFromYesterday(): void
    {
        $datetime = Datetime::yesterday();
        $native = new \DateTime('now');

        $this->assertEquals(
            $datetime->addDays(1)->toDateString(),
            $native->format('Y-m-d')
        );
        $this->assertEquals(0, $datetime->getHour());
        $this->assertEquals(0, $datetime->getMinute());
        $this->assertEquals(0, $datetime->getSecond());
    }

    public function testCanInstantiateSuccessfullyFromTimestamp(): void
    {
        $original = Datetime::now();
        $timestamp = $original->getTimestamp();

        $fromTimestamp = Datetime::fromTimestamp($timestamp);

        $this->assertFalse($original === $fromTimestamp);
        $this->assertEquals(
            $original->toDatetimeString(),
            $fromTimestamp->toDatetimeString()
        );
    }

    public function testCanInstantiateSuccessfullyFromUnits(): void
    {
        $years = 2020;
        $months = 11;
        $days = 10;
        $hours = 9;
        $minutes = 30;
        $seconds = 0;
        $dt = Datetime::fromUnits($years, $months, $days, $hours, $minutes, $seconds);

        $this->assertEquals(
            $years,
            $dt->getYear()
        );
        $this->assertEquals(
            $months,
            $dt->getMonth()
        );
        $this->assertEquals(
            $days,
            $dt->getDay()
        );
        $this->assertEquals(
            $hours,
            $dt->getHour()
        );
        $this->assertEquals(
            $minutes,
            $dt->getMinute()
        );
        $this->assertEquals(
            $seconds,
            $dt->getSecond()
        );
    }

    public function testCanAddInterval(): void
    {
        $dt = Datetime::fromString(self::DATETIME);
        $interval = new \DateInterval('P1Y');

        $result = $dt->add($interval);

        $this->assertInstanceOf(Datetime::class, $result);
        $this->assertEquals($result->getYear(), 2022);
        $this->assertFalse($dt === $result);
    }

    private function assertOutputInFormat(string $datetime, string $format, Str $expected): void
    {
        $native = new \Datetime(self::DATETIME);
        $result = $native->format($format);

        $this->assertEquals(
            $result,
            (string) $expected
        );
    }

    public function testCanOutputInFormatATOM(): void
    {
        $this->assertOutputInFormat(
            self::DATETIME,
            \Datetime::ATOM,
            Datetime::fromString(self::DATETIME)->toATOM()
        );
    }

    public function testCanOutputInFormatCOOKIE(): void
    {
        $this->assertOutputInFormat(
            self::DATETIME,
            \Datetime::COOKIE,
            Datetime::fromString(self::DATETIME)->toCookie()
        );
    }

    public function testCanOutputInFormatISO8601(): void
    {
        $this->assertOutputInFormat(
            self::DATETIME,
            \Datetime::ISO8601,
            Datetime::fromString(self::DATETIME)->toISO8601()
        );
    }

    public function testCanOutputInFormatRFC822(): void
    {
        $this->assertOutputInFormat(
            self::DATETIME,
            \Datetime::RFC822,
            Datetime::fromString(self::DATETIME)->toRFC822()
        );
    }

    public function testCanOutputInFormatRFC850(): void
    {
        $this->assertOutputInFormat(
            self::DATETIME,
            \Datetime::RFC850,
            Datetime::fromString(self::DATETIME)->toRFC850()
        );
    }

    public function testCanOutputInFormatRFC1036(): void
    {
        $this->assertOutputInFormat(
            self::DATETIME,
            \Datetime::RFC1036,
            Datetime::fromString(self::DATETIME)->toRFC1036()
        );
    }

    public function testCanOutputInFormatRFC1123(): void
    {
        $this->assertOutputInFormat(
            self::DATETIME,
            \Datetime::RFC1123,
            Datetime::fromString(self::DATETIME)->toRFC1123()
        );
    }

    public function testCanOutputInFormatRFC7231(): void
    {
        $this->assertOutputInFormat(
            self::DATETIME,
            \Datetime::RFC7231,
            Datetime::fromString(self::DATETIME)->toRFC7231()
        );
    }

    public function testCanOutputInFormatRFC2822(): void
    {
        $this->assertOutputInFormat(
            self::DATETIME,
            \Datetime::RFC2822,
            Datetime::fromString(self::DATETIME)->toRFC2822()
        );
    }

    public function testCanOutputInFormatRFC3339(): void
    {
        $this->assertOutputInFormat(
            self::DATETIME,
            \Datetime::RFC3339,
            Datetime::fromString(self::DATETIME)->toRFC3339()
        );
    }

    public function testCanOutputInFormatRFC3339Extended(): void
    {
        $this->assertOutputInFormat(
            self::DATETIME,
            \Datetime::RFC3339_EXTENDED,
            Datetime::fromString(self::DATETIME)->toRFC3339Extended()
        );
    }

    public function testCanOutputInFormatRSS(): void
    {
        $this->assertOutputInFormat(
            self::DATETIME,
            \Datetime::RSS,
            Datetime::fromString(self::DATETIME)->toRSS()
        );
    }

    public function testCanOutputInFormatW3C(): void
    {
        $this->assertOutputInFormat(
            self::DATETIME,
            \Datetime::W3C,
            Datetime::fromString(self::DATETIME)->toW3C()
        );
    }

    public function testCanOutputInFormatDatetimeString(): void
    {
        $dt = new \Datetime(self::DATETIME);

        $this->assertOutputInFormat(
            self::DATETIME,
            $dt->format('Y-m-d H:i:s'),
            Datetime::fromString(self::DATETIME)->toDatetimeString()
        );
    }

    public function testCanOutputInFormatTimeString(): void
    {
        $dt = new \Datetime(self::DATETIME);

        $this->assertOutputInFormat(
            self::DATETIME,
            $dt->format('H:i:s'),
            Datetime::fromString(self::DATETIME)->toTimeString()
        );
    }

    public function testCanOutputInFormat(): void
    {
        $dt = new \Datetime(self::DATETIME);

        $this->assertOutputInFormat(
            self::DATETIME,
            $dt->format('Y-m-d H:i:s'),
            Datetime::fromString(self::DATETIME)->toFormat(Str::create('Y-m-d H:i:s'))
        );
    }

    public function testCanAddUnitsIndependently(): void
    {
        $original = Datetime::fromUnits(2022, 2, 2, 10, 11, 12);
        $calculated = $original
            ->addYears(1)
            ->addMonths(1)
            ->addDays(1)
            ->addHours(1)
            ->addMinutes(1)
            ->addSeconds(1);

        $this->assertFalse($original === $calculated);
        $this->assertNotEquals(
            (string) $original->toDatetimeString(),
            (string) $calculated->toDatetimeString()
        );
        $this->assertEquals($original->getYear(), ($calculated->getYear() - 1));
        $this->assertEquals($original->getMonth(), ($calculated->getMonth() - 1));
        $this->assertEquals($original->getDay(), ($calculated->getDay() - 1));
        $this->assertEquals($original->getHour(), ($calculated->getHour() - 1));
        $this->assertEquals($original->getMinute(), ($calculated->getMinute() - 1));
        $this->assertEquals($original->getSecond(), ($calculated->getSecond() - 1));
    }
}
