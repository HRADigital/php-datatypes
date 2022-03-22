<?php

declare(strict_types=1);

namespace HraDigital\Tests\Datatypes\Unit\Attributes;

use HraDigital\Datatypes\Attributes\Timezone\HasTimestampTrait;
use HraDigital\Datatypes\ValueObjects\AbstractValueObject;

/**
 * Testing Value Object for Timezone Entity Traits.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
class TimezoneTraitsVO extends AbstractValueObject
{
    use HasTimestampTrait;
}
