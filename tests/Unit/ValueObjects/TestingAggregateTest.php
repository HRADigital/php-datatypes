<?php

declare(strict_types=1);

namespace HraDigital\Tests\Datatypes\Unit\ValueObjects;

use HraDigital\Datatypes\Datetime\Datetime;
use HraDigital\Datatypes\Scalar\Str;
use HraDigital\Tests\Datatypes\AbstractBaseTestCase;

/**
 * JSON Serializable Aggeregate Unit testing.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
class TestingAggregateTest extends AbstractBaseTestCase
{
    public function testLoadsSuccessfully(): void
    {
        $aggregate = new TestingAggregate(
            Str::create('String Object'),
            Datetime::fromString('2022-02-02 10:00:00'),
            new TestingValueObject(
                TestingValueObject::DATA
            ),
            true
        );

        $array = json_decode(
            json_encode($aggregate),
            true
        );

        // Tests field mapping and onLoad events work.
        $this->assertIsArray($array);
        $this->assertArrayHasKey('string', $array);
        $this->assertArrayHasKey('datetime', $array);
        $this->assertArrayHasKey('vo', $array);
        $this->assertArrayHasKey('boolean', $array);
    }
}
