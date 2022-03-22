<?php

declare(strict_types=1);

namespace HraDigital\Tests\Datatypes\Unit\ValueObjects;

use HraDigital\Datatypes\Datetime\Datetime;
use HraDigital\Datatypes\Scalar\Str;
use HraDigital\Datatypes\Traits\Entities\CanMassAssignStateTrait;
use HraDigital\Datatypes\Traits\Entities\CanProcessEntityStateTrait;
use HraDigital\Datatypes\Traits\Entities\CanProcessOnUpdateEventsTrait;
use HraDigital\Datatypes\Traits\Entities\General\HasActiveTrait;
use HraDigital\Datatypes\Traits\Entities\General\HasEmailTrait;
use HraDigital\Datatypes\Traits\Entities\General\HasPositiveIntegerIDTrait;
use HraDigital\Datatypes\Traits\Entities\General\HasTitleTrait;
use HraDigital\Datatypes\Traits\Entities\General\HasUpdatableUpdatedAtTrait;
use HraDigital\Datatypes\ValueObjects\AbstractValueObject;

/**
 * Abstract Base Value Object for testing.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
class TestingValueObject extends AbstractValueObject
{
    const DATA = [
        'id' => 123,
        'is_active' => false,
        'address' => 'user@domain.tld',
        'title' => 'my title',
        'inner' => [
            'active' => false,
            'title' => 'My Inner Title',
        ],
    ];

    use HasPositiveIntegerIDTrait,
        HasActiveTrait,
        CanMassAssignStateTrait,
        CanProcessEntityStateTrait,
        CanProcessOnUpdateEventsTrait,
        HasEmailTrait,
        HasTitleTrait,
        HasUpdatableUpdatedAtTrait;

    /** @var array $guarded - List of fields that should not be serializable into JSON. */
    protected array $guarded = ['email'];

    protected array $maps = [
        'is_active' => 'active',
        'address' => 'email',
    ];

    protected array $required = [
        'active',
    ];

    protected TestingNestedValueObject $inner;

    protected function castInner(array $inner): void
    {
        $this->inner = new TestingNestedValueObject($inner);
    }

    public function getInner(): TestingNestedValueObject
    {
        return $this->inner;
    }

    /**
     * Initial Rule's testing method.
     *
     * @param  array $fields - Original fields being loaded into the Value Object.
     * @return array
     */
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
        $this->title = Str::create('My ' . (string) $title);
        $this->inner->changeTitle($this->title->replace('My ', 'My Other '));

        $this->triggerOnUpdate();
    }
}
