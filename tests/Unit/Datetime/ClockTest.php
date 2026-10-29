<?php

declare(strict_types=1);

namespace HraDigital\Tests\Datatypes\Unit\Datetime;

use DateTimeImmutable as NativeDateTimeImmutable;
use HraDigital\Datatypes\Datetime\Clock;
use HraDigital\Datatypes\Datetime\DateTime;
use HraDigital\Datatypes\Datetime\DateTimeImmutable;
use HraDigital\Datatypes\Datetime\FrozenClock;
use HraDigital\Datatypes\Datetime\SystemClock;
use HraDigital\Tests\Datatypes\AbstractBaseTestCase;
use Psr\Clock\ClockInterface;

/**
 * Clock's Unit testing.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 */
class ClockTest extends AbstractBaseTestCase
{
    protected function tearDown(): void
    {
        Clock::reset();

        parent::tearDown();
    }

    public function testClocksArePsr20Clocks(): void
    {
        $this->assertInstanceOf(ClockInterface::class, new SystemClock());
        $this->assertInstanceOf(ClockInterface::class, new FrozenClock(new NativeDateTimeImmutable()));
    }

    public function testSystemClockReadsTheSystemTime(): void
    {
        $before = new NativeDateTimeImmutable();
        $now = (new SystemClock())->now();
        $after = new NativeDateTimeImmutable();

        $this->assertGreaterThanOrEqual($before, $now);
        $this->assertLessThanOrEqual($after, $now);
    }

    public function testFrozenClockAlwaysGivesTheSameInstant(): void
    {
        $instant = new NativeDateTimeImmutable('2020-01-02 03:04:05');
        $clock = new FrozenClock($instant);

        $first = $clock->now();
        $second = $clock->now();

        $this->assertSame($instant, $first);
        $this->assertSame($instant, $second);
    }

    public function testDefaultsToTheSystemClock(): void
    {
        $before = new NativeDateTimeImmutable();
        $now = Clock::now();

        $this->assertGreaterThanOrEqual($before, $now);
        $this->assertLessThanOrEqual(new NativeDateTimeImmutable(), $now);
    }

    public function testFrozenClockGivesAFixedNow(): void
    {
        $instant = new NativeDateTimeImmutable('2020-01-02 03:04:05');
        Clock::set(new FrozenClock($instant));

        $this->assertSame($instant, Clock::now());
        $this->assertEquals('2020-01-02 03:04:05', (string) DateTimeImmutable::now());
        $this->assertEquals('2020-01-02 03:04:05', (string) DateTime::now());
    }

    public function testResetGoesBackToTheSystemClock(): void
    {
        Clock::set(new FrozenClock(new NativeDateTimeImmutable('2020-01-02 03:04:05')));
        Clock::reset();

        $this->assertNotEquals('2020-01-02', (string) DateTimeImmutable::now()->toDateString());
    }
}
