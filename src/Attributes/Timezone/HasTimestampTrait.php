<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Attributes\Timezone;

/**
 * Trait for an Entity's Timestamp attribute.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
trait HasTimestampTrait
{
    /** @var int $timestamp - Instance's Unix timestamp. */
    protected int $timestamp = 0;

    /**
     * Setter method for UNIX Timestamp.
     *
     * @param  int $timestamp - Unix timestamp.
     * @return void
     */
    protected function castTimestamp(int $timestamp): void
    {
        $this->timestamp = $timestamp;
    }

    /**
     * Returns the Instance's Unix timestamp.
     *
     * @return int
     */
    public function getTimestamp(): int
    {
        return $this->timestamp;
    }
}
