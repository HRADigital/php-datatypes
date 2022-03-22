<?php declare(strict_types=1);

namespace Hradigital\Tests\Datatypes\Unit\Datetime;

use HraDigital\Datatypes\Datetime\DateInterval;
use HraDigital\Datatypes\Scalar\Str;
use HraDigital\Tests\Datatypes\AbstractBaseTestCase;

/**
 * DateInterval's Unit testing.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
class DateIntervalTest extends AbstractBaseTestCase
{
    public function testCanLoadSuccessfullyFromYears(): void
    {
        $di = DateInterval::fromYears(6);

        $this->assertEquals(6, $di->getYears());
        $this->assertEquals(0, $di->getMonths());
        $this->assertEquals(0, $di->getDays());
        $this->assertEquals(0, $di->getHours());
        $this->assertEquals(0, $di->getMinutes());
        $this->assertEquals(0, $di->getSeconds());
        $this->assertFalse($di->isNegative());

        $di = DateInterval::fromYears(-6);

        $this->assertEquals(-6, $di->getYears());
        $this->assertEquals(0, $di->getMonths());
        $this->assertEquals(0, $di->getDays());
        $this->assertEquals(0, $di->getHours());
        $this->assertEquals(0, $di->getMinutes());
        $this->assertEquals(0, $di->getSeconds());
        $this->assertTrue($di->isNegative());
    }

    public function testCanLoadSuccessfullyFromMonths(): void
    {
        $di = DateInterval::fromMonths(5);

        $this->assertEquals(0, $di->getYears());
        $this->assertEquals(5, $di->getMonths());
        $this->assertEquals(0, $di->getDays());
        $this->assertEquals(0, $di->getHours());
        $this->assertEquals(0, $di->getMinutes());
        $this->assertEquals(0, $di->getSeconds());
        $this->assertFalse($di->isNegative());

        $di = DateInterval::fromMonths(-5);

        $this->assertEquals(0, $di->getYears());
        $this->assertEquals(-5, $di->getMonths());
        $this->assertEquals(0, $di->getDays());
        $this->assertEquals(0, $di->getHours());
        $this->assertEquals(0, $di->getMinutes());
        $this->assertEquals(0, $di->getSeconds());
        $this->assertTrue($di->isNegative());
    }

    public function testCanLoadSuccessfullyFromDays(): void
    {
        $di = DateInterval::fromDays(4);

        $this->assertEquals(0, $di->getYears());
        $this->assertEquals(0, $di->getMonths());
        $this->assertEquals(4, $di->getDays());
        $this->assertEquals(0, $di->getHours());
        $this->assertEquals(0, $di->getMinutes());
        $this->assertEquals(0, $di->getSeconds());
        $this->assertFalse($di->isNegative());

        $di = DateInterval::fromDays(-4);

        $this->assertEquals(0, $di->getYears());
        $this->assertEquals(0, $di->getMonths());
        $this->assertEquals(-4, $di->getDays());
        $this->assertEquals(0, $di->getHours());
        $this->assertEquals(0, $di->getMinutes());
        $this->assertEquals(0, $di->getSeconds());
        $this->assertTrue($di->isNegative());
    }

    public function testCanLoadSuccessfullyFromHours(): void
    {
        $di = DateInterval::fromHours(3);

        $this->assertEquals(0, $di->getYears());
        $this->assertEquals(0, $di->getMonths());
        $this->assertEquals(0, $di->getDays());
        $this->assertEquals(3, $di->getHours());
        $this->assertEquals(0, $di->getMinutes());
        $this->assertEquals(0, $di->getSeconds());
        $this->assertFalse($di->isNegative());

        $di = DateInterval::fromHours(-3);

        $this->assertEquals(0, $di->getYears());
        $this->assertEquals(0, $di->getMonths());
        $this->assertEquals(0, $di->getDays());
        $this->assertEquals(-3, $di->getHours());
        $this->assertEquals(0, $di->getMinutes());
        $this->assertEquals(0, $di->getSeconds());
        $this->assertTrue($di->isNegative());
    }

    public function testCanLoadSuccessfullyFromMinutes(): void
    {
        $di = DateInterval::fromMinutes(2);

        $this->assertEquals(0, $di->getYears());
        $this->assertEquals(0, $di->getMonths());
        $this->assertEquals(0, $di->getDays());
        $this->assertEquals(0, $di->getHours());
        $this->assertEquals(2, $di->getMinutes());
        $this->assertEquals(0, $di->getSeconds());
        $this->assertFalse($di->isNegative());

        $di = DateInterval::fromMinutes(-2);

        $this->assertEquals(0, $di->getYears());
        $this->assertEquals(0, $di->getMonths());
        $this->assertEquals(0, $di->getDays());
        $this->assertEquals(0, $di->getHours());
        $this->assertEquals(-2, $di->getMinutes());
        $this->assertEquals(0, $di->getSeconds());
        $this->assertTrue($di->isNegative());
    }

    public function testCanLoadSuccessfullyFromSeconds(): void
    {
        $di = DateInterval::fromSeconds(1);

        $this->assertEquals(0, $di->getYears());
        $this->assertEquals(0, $di->getMonths());
        $this->assertEquals(0, $di->getDays());
        $this->assertEquals(0, $di->getHours());
        $this->assertEquals(0, $di->getMinutes());
        $this->assertEquals(1, $di->getSeconds());
        $this->assertFalse($di->isNegative());

        $di = DateInterval::fromSeconds(-1);

        $this->assertEquals(0, $di->getYears());
        $this->assertEquals(0, $di->getMonths());
        $this->assertEquals(0, $di->getDays());
        $this->assertEquals(0, $di->getHours());
        $this->assertEquals(0, $di->getMinutes());
        $this->assertEquals(-1, $di->getSeconds());
        $this->assertTrue($di->isNegative());
    }

    public function testCanLoadSuccessfullyFromDuration(): void
    {
        $strFormat = '%r%Yy %Mm %Dd %H:%I:%S';

        $di = DateInterval::fromDuration(Str::create("P3Y6M4DT12H30M5S"));

        $this->assertEquals(3, $di->getYears());
        $this->assertEquals(6, $di->getMonths());
        $this->assertEquals(4, $di->getDays());
        $this->assertEquals(12, $di->getHours());
        $this->assertEquals(30, $di->getMinutes());
        $this->assertEquals(5, $di->getSeconds());
        $this->assertFalse($di->isNegative());
        $this->assertEquals((string) $di, $di->toDatetimeString());
        $this->assertEquals("03y 06m 04d 12:30:05", $di->toDatetimeString());
        $this->assertEquals("03y 06m 04d 12:30:05", $di->toFormat(Str::create($strFormat)));
        $this->assertEquals("03y 06m 04d 12:30:05", $di->format($strFormat));

        $di = DateInterval::fromDuration(Str::create("P3Y6M4DT12H30M5S"), true);

        $this->assertEquals(-3, $di->getYears());
        $this->assertEquals(-6, $di->getMonths());
        $this->assertEquals(-4, $di->getDays());
        $this->assertEquals(-12, $di->getHours());
        $this->assertEquals(-30, $di->getMinutes());
        $this->assertEquals(-5, $di->getSeconds());
        $this->assertTrue($di->isNegative());
        $this->assertEquals((string) $di, $di->toDatetimeString());
        $this->assertEquals("-03y 06m 04d 12:30:05", $di->toDatetimeString());
        $this->assertEquals("-03y 06m 04d 12:30:05", $di->toFormat(Str::create($strFormat)));
        $this->assertEquals("-03y 06m 04d 12:30:05", $di->format($strFormat));
        $this->assertEquals("-03y 06m 04d 12:30:05", $di->format($strFormat));
    }

    public function testCanLoadSuccessfullyFromDateString(): void
    {
        $di = DateInterval::createFromDateString("2 year + 3 day");

        $this->assertEquals(2, $di->getYears());
        $this->assertEquals(0, $di->getMonths());
        $this->assertEquals(3, $di->getDays());
        $this->assertEquals(0, $di->getHours());
        $this->assertEquals(0, $di->getMinutes());
        $this->assertEquals(0, $di->getSeconds());
        $this->assertFalse($di->isNegative());

        $di = DateInterval::createFromDateString("1 day + 12 hours");

        $this->assertEquals(0, $di->getYears());
        $this->assertEquals(0, $di->getMonths());
        $this->assertEquals(1, $di->getDays());
        $this->assertEquals(12, $di->getHours());
        $this->assertEquals(0, $di->getMinutes());
        $this->assertEquals(0, $di->getSeconds());
        $this->assertFalse($di->isNegative());
    }
}
