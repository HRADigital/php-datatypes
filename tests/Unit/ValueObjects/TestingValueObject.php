<?php

declare(strict_types=1);

namespace HraDigital\Tests\Datatypes\Unit\ValueObjects;

use HraDigital\Datatypes\Datetime\Datetime;
use HraDigital\Datatypes\Scalar\Str;
use HraDigital\Datatypes\ValueObjects\Traits\CanMassAssignStateTrait;
use HraDigital\Datatypes\ValueObjects\Traits\CanProcessEntityStateTrait;
use HraDigital\Datatypes\ValueObjects\Traits\CanProcessOnUpdateEventsTrait;
use HraDigital\Datatypes\Attributes\General\HasActiveTrait;
use HraDigital\Datatypes\Attributes\General\HasEmailTrait;
use HraDigital\Datatypes\Attributes\General\HasPositiveIntegerIDTrait;
use HraDigital\Datatypes\Attributes\General\HasTitleTrait;
use HraDigital\Datatypes\Attributes\General\HasUpdatableUpdatedAtTrait;
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
        'native' => [
            'active' => false,
            'title' => 'Some random native object',
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
    protected \stdClass $native;

    protected function castInner(array $inner): void
    {
        $this->inner = new TestingNestedValueObject($inner);
    }

    protected function castNative(array $native): void
    {
        $this->native = (object) $native;
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
