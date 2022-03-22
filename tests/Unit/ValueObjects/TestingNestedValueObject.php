<?php

declare(strict_types=1);

namespace HraDigital\Tests\Datatypes\Unit\ValueObjects;

use HraDigital\Datatypes\Datetime\Datetime;
use HraDigital\Datatypes\Scalar\Str;
use HraDigital\Datatypes\Traits\Entities\CanMassAssignStateTrait;
use HraDigital\Datatypes\Traits\Entities\CanProcessEntityStateTrait;
use HraDigital\Datatypes\Traits\Entities\CanProcessOnUpdateEventsTrait;
use HraDigital\Datatypes\Attributes\General\HasActiveTrait;
use HraDigital\Datatypes\Attributes\General\HasTitleTrait;
use HraDigital\Datatypes\Attributes\General\HasUpdatableUpdatedAtTrait;
use HraDigital\Datatypes\ValueObjects\AbstractValueObject;

/**
 * Nested Value Object for testing.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
class TestingNestedValueObject extends AbstractValueObject
{
    use HasActiveTrait,
        CanMassAssignStateTrait,
        CanProcessEntityStateTrait,
        CanProcessOnUpdateEventsTrait,
        HasTitleTrait,
        HasUpdatableUpdatedAtTrait;

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
