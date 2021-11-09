<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\ValueObjects\Timezone;

use HraDigital\Datatypes\Datetime\Datetime;
use HraDigital\Datatypes\Scalar\Str;
use HraDigital\Datatypes\Traits\Entities\Timezone\HasTimestampTrait;
use HraDigital\Datatypes\ValueObjects\AbstractValueObject;

/**
 * Timezone Transition Value Object class.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 * @link      https://www.php.net/manual/en/datetimezone.gettransitions.php
 */
class Transition extends AbstractValueObject
{
    use HasTimestampTrait;

    protected Datetime $dateTime;
    protected int $offset;
    protected bool $isDayLightSavingActive;
    protected Str $abbreviation;

    /** @inheritDoc */
    protected array $required = [
        'timestamp',
        'dateTime',
        'offset',
        'isDayLightSavingActive',
        'abbreviation',
    ];

    /** @inheritDoc */
    protected array $maps = [
        'ts' => 'timestamp',
        'time'   => 'dateTime',
        'offSet' => 'offset',
        'isdst'  => 'isDayLightSavingActive',
        'abbr'   => 'abbreviation',
    ];

    protected function castDateTime(string $time): void
    {
        $this->dateTime = Datetime::fromString($time);
    }

    protected function castOffset(int $offset): void
    {
        $this->offset = $offset;
    }

    protected function castIsDayLightSavingActive(int $isActive): void
    {
        $this->isDayLightSavingActive = (bool) $isActive;
    }

    protected function castAbbreviation(string $abbreviation): void
    {
        $this->abbreviation = Str::create($abbreviation);
    }

    public function dateTime(): Datetime
    {
        return $this->dateTime;
    }

    public function offset(): int
    {
        return $this->offset;
    }

    public function isDayLightSavingActive(): bool
    {
        return $this->isDayLightSavingActive;
    }

    public function abbreviation(): Str
    {
        return $this->abbreviation;
    }
}
