<?php

declare(strict_types=1);

namespace HraDigital\Tests\Datatypes\Unit\ValueObjects;

use HraDigital\Datatypes\Datetime\Datetime;
use HraDigital\Datatypes\Scalar\Str;
use HraDigital\Datatypes\Traits\ValueObjects\CanSerializeAllToJsonTrait;

/**
 * Test for JSON Serializable Object.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
class TestingAggregate implements \JsonSerializable
{
    use CanSerializeAllToJsonTrait;

    protected Str $string;
    protected Datetime $datetime;
    protected TestingValueObject $vo;
    protected bool $boolean;

    public function __construct(Str $string, Datetime $datetime, TestingValueObject $vo, bool $boolean)
    {
        $this->string = $string;
        $this->datetime = $datetime;
        $this->vo = $vo;
        $this->boolean = $boolean;
    }
}
