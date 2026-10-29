<?php declare(strict_types=1);

namespace HraDigital\Tests\Datatypes\Unit\Datetime;

use HraDigital\Datatypes\Datetime\DateInterval;
use HraDigital\Datatypes\Scalar\Str;
use HraDigital\Tests\Datatypes\AbstractBaseTestCase;

/**
 * DateInterval's Unit testing.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
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
        $di = DateInterval::fromDateString("2 year + 3 day");

        $this->assertEquals(2, $di->getYears());
        $this->assertEquals(0, $di->getMonths());
        $this->assertEquals(3, $di->getDays());
        $this->assertEquals(0, $di->getHours());
        $this->assertEquals(0, $di->getMinutes());
        $this->assertEquals(0, $di->getSeconds());
        $this->assertFalse($di->isNegative());

        $di = DateInterval::fromDateString("1 day + 12 hours");

        $this->assertEquals(0, $di->getYears());
        $this->assertEquals(0, $di->getMonths());
        $this->assertEquals(1, $di->getDays());
        $this->assertEquals(12, $di->getHours());
        $this->assertEquals(0, $di->getMinutes());
        $this->assertEquals(0, $di->getSeconds());
        $this->assertFalse($di->isNegative());
    }

    public function testEqualsIsTrueForTheSameUnitsAndSign(): void
    {
        $di = DateInterval::fromDuration(Str::create("P3Y6M4DT12H30M5S"));

        $this->assertTrue($di->equals(DateInterval::fromDuration(Str::create("P3Y6M4DT12H30M5S"))));
        $this->assertTrue(DateInterval::fromDays(2)->equals(DateInterval::fromDateString("2 day")));
    }

    /**
     * @return array<string, array{string}>
     */
    public static function differentUnitProvider(): array
    {
        return [
            'years'   => ["P2Y2M2DT2H2M3S"],
            'months'  => ["P2Y3M2DT2H2M2S"],
            'days'    => ["P2Y2M3DT2H2M2S"],
            'hours'   => ["P2Y2M2DT3H2M2S"],
            'minutes' => ["P2Y2M2DT2H3M2S"],
            'seconds' => ["P2Y2M2DT2H2M3S"],
        ];
    }

    /**
     * @dataProvider differentUnitProvider
     */
    public function testEqualsIsFalseWhenOneUnitDiffers(string $duration): void
    {
        $di = DateInterval::fromDuration(Str::create("P2Y2M2DT2H2M2S"));

        $this->assertFalse($di->equals(DateInterval::fromDuration(Str::create($duration))));
    }

    public function testEqualsIsFalseForADifferentSign(): void
    {
        $this->assertFalse(DateInterval::fromDays(2)->equals(DateInterval::fromDays(-2)));
    }

    public function testEqualsComparesTheUnitsNotTheTotalDuration(): void
    {
        $this->assertFalse(DateInterval::fromDays(1)->equals(DateInterval::fromHours(24)));
    }

    public function testEqualsComparesTheMicroseconds(): void
    {
        $di = DateInterval::fromSeconds(1);
        $other = DateInterval::fromSeconds(1);
        $other->f = 0.5;

        $this->assertFalse($di->equals($other));
    }
}
