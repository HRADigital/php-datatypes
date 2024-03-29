<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Datetime;

trait HasStaticFactoryMethodsTrait
{
    public static function now(): Datetime
    {
        return new Datetime("now");
    }

    public static function today(): Datetime
    {
        return new Datetime("today");
    }

    public static function tomorrow(): Datetime
    {
        return new Datetime("tomorrow");
    }

    public static function yesterday(): Datetime
    {
        return new Datetime("yesterday");
    }

    public static function fromString(?string $datetime = null, ?DateTimeZone $timezone = null): Datetime
    {
        return new Datetime($datetime ?? "now", $timezone);
    }

    public static function fromTimestamp(int $timestamp): Datetime
    {
        $dt = new \Datetime("now");
        $dt = $dt->setTimestamp($timestamp);

        return new Datetime(
            $dt->format(\Datetime::W3C)
        );
    }

    public static function fromUnits(
        int $years,
        int $months,
        int $days,
        int $hours = 0,
        int $minutes = 0,
        int $seconds = 0,
        ?DateTimeZone $timezone = null
    ): Datetime {
        return new Datetime(
            \sprintf(
                "%d-%d-%dT%d:%d:%d%s",
                $years,
                $months,
                $days,
                $hours,
                $minutes,
                $seconds,
                ((string) $timezone ?? '+00:00')
            )
        );
    }
}
