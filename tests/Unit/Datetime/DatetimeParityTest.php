<?php

declare(strict_types=1);

namespace HraDigital\Tests\Datatypes\Unit\Datetime;

use HraDigital\Datatypes\Datetime\DateInterval;
use HraDigital\Datatypes\Datetime\DateTime;
use HraDigital\Datatypes\Datetime\DatetimeContract;
use HraDigital\Datatypes\Datetime\DateTimeImmutable;
use HraDigital\Tests\Datatypes\AbstractBaseTestCase;
use ReflectionClass;
use ReflectionMethod;
use function array_diff;
use function array_map;
use function array_values;
use function sort;

/**
 * Parity between DateTime and DateTimeImmutable.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 */
class DatetimeParityTest extends AbstractBaseTestCase
{
    const DATETIME = '2024-02-15 10:11:12.123456';

    /**
     * @param  class-string $class
     * @return list<string>
     */
    private function publicMethods(string $class): array
    {
        $methods = array_map(
            static fn (ReflectionMethod $method): string => $method->getName(),
            (new ReflectionClass($class))->getMethods(ReflectionMethod::IS_PUBLIC)
        );
        sort($methods);

        return $methods;
    }

    public function testBothClassesHaveTheSamePublicMethodsExceptTheSiblingConversion(): void
    {
        $mutable = array_diff($this->publicMethods(DateTime::class), ['toImmutable']);
        $immutable = array_diff($this->publicMethods(DateTimeImmutable::class), ['toMutable']);

        $this->assertEquals(array_values($mutable), array_values($immutable));
    }

    /**
     * @return array<string, array{callable(DatetimeContract): mixed}>
     */
    public static function operationProvider(): array
    {
        return [
            'string'        => [static fn (DatetimeContract $dt): string => (string) $dt],
            'json'          => [static fn (DatetimeContract $dt): string => $dt->jsonSerialize()],
            'ATOM'          => [static fn (DatetimeContract $dt): string => (string) $dt->toATOM()],
            'RFC3339 ext'   => [static fn (DatetimeContract $dt): string => (string) $dt->toRFC3339Extended()],
            'timestamp'     => [static fn (DatetimeContract $dt): int => $dt->getTimestamp()],
            'microsecond'   => [static fn (DatetimeContract $dt): int => $dt->getMicrosecond()],
            'day of week'   => [static fn (DatetimeContract $dt): int => $dt->getDayOfWeek()],
            'quarter'       => [static fn (DatetimeContract $dt): int => $dt->getQuarter()],
            'add days'      => [static fn (DatetimeContract $dt): string => (string) $dt->addDays(20)],
            'sub months'    => [static fn (DatetimeContract $dt): string => (string) $dt->subMonths(3)],
            'add interval'  => [static fn (DatetimeContract $dt): string => (string) $dt->add(DateInterval::fromHours(30))],
            'end of month'  => [static fn (DatetimeContract $dt): string => $dt->endOfMonth()->format('Y-m-d H:i:s.u')],
            'start of year' => [static fn (DatetimeContract $dt): string => $dt->startOfYear()->format('Y-m-d H:i:s.u')],
            'diff'          => [
                static fn (DatetimeContract $dt): string => (string) $dt->diff(DateTime::fromString('2025-01-01'))->toDuration(),
            ],
        ];
    }

    /**
     * @dataProvider operationProvider
     *
     * @param callable(DatetimeContract): mixed $operation
     */
    public function testSameInputGivesSameOutput(callable $operation): void
    {
        $this->assertEquals(
            $operation(DateTimeImmutable::fromString(self::DATETIME)),
            $operation(DateTime::fromString(self::DATETIME))
        );
    }

    public function testInstancesOfTheSameInstantAreEqualAcrossClasses(): void
    {
        $mutable = DateTime::fromString(self::DATETIME);
        $immutable = DateTimeImmutable::fromString(self::DATETIME);

        $this->assertTrue($mutable->equals($immutable));
        $this->assertTrue($immutable->equals($mutable));
        $this->assertEquals(0, $mutable->compare($immutable));
    }

    public function testChangingMethodChangesTheMutableAndLeavesTheImmutableUntouched(): void
    {
        $mutable = DateTime::fromString(self::DATETIME);
        $immutable = DateTimeImmutable::fromString(self::DATETIME);

        $mutable->addDays(1);
        $immutable->addDays(1);

        $this->assertEquals('2024-02-16 10:11:12', (string) $mutable);
        $this->assertEquals('2024-02-15 10:11:12', (string) $immutable);
    }
}
