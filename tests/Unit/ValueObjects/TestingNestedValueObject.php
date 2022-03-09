<?php

declare(strict_types=1);

namespace HraDigital\Tests\Datatypes\Unit\ValueObjects;

use HraDigital\Datatypes\Datetime\Datetime;
use HraDigital\Datatypes\Scalar\Str;
use HraDigital\Datatypes\Traits\Entities\CanProcessEntityStateTrait;
use HraDigital\Datatypes\Traits\Entities\CanProcessOnUpdateEventsTrait;
use HraDigital\Datatypes\Traits\Entities\General\HasActiveTrait;
use HraDigital\Datatypes\Traits\Entities\General\HasEmailTrait;
use HraDigital\Datatypes\Traits\Entities\General\HasTitleTrait;
use HraDigital\Datatypes\Traits\Entities\General\HasUpdatableUpdatedAtTrait;
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
        HasTitleTrait,
        HasUpdatableUpdatedAtTrait,
        CanProcessEntityStateTrait,
        CanProcessOnUpdateEventsTrait;

    /** @var array $guarded - List of fields that should not be serializable into JSON. */
    protected array $guarded = ['active'];

    protected function ruleSetUpdatedAtIfMissing(array $fields): array
    {
        if (!isset($fields['updated_at'])) {
            $fields['updated_at'] = (string) Datetime::now()->addHours(-1);
        }

        return $fields;
    }

    public function activate(): void
    {
        $this->active = true;
        $this->triggerOnUpdate();
    }

    public function changeTitle(Str $title): void
    {
        $this->title = $title;
        $this->triggerOnUpdate();
    }
}
