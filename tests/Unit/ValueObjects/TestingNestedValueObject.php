<?php

declare(strict_types=1);

namespace HraDigital\Tests\Datatypes\Unit\ValueObjects;

use HraDigital\Datatypes\Traits\Entities\General\HasActiveTrait;
use HraDigital\Datatypes\Traits\Entities\General\HasEmailTrait;
use HraDigital\Datatypes\Traits\Entities\General\HasTitleTrait;
use HraDigital\Datatypes\ValueObjects\AbstractValueObject;

/**
 * Nested Value Object for testing.
 *
 * @package   Hradigital\Datatypes
 * @copyright Hradigital\Datatypes
 * @license   MIT
 */
class TestingNestedValueObject extends AbstractValueObject
{
    use HasActiveTrait,
        HasTitleTrait;

    /** @var array $guarded - List of fields that should not be serializable into JSON. */
    protected array $guarded = ['active'];
}
