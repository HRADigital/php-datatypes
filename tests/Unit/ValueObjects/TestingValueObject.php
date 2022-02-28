<?php

declare(strict_types=1);

namespace HraDigital\Tests\Datatypes\Unit\ValueObjects;

use HraDigital\Datatypes\Traits\Entities\General\HasActiveTrait;
use HraDigital\Datatypes\Traits\Entities\General\HasEmailTrait;
use HraDigital\Datatypes\Traits\Entities\General\HasTitleTrait;
use HraDigital\Datatypes\ValueObjects\AbstractValueObject;

/**
 * Abstract Base Value Object for testing.
 *
 * @package   Hradigital\Datatypes
 * @copyright Hradigital\Datatypes
 * @license   MIT
 */
class TestingValueObject extends AbstractValueObject
{
    const DATA = [
        'is_active' => false,
        'address' => 'user@domain.tld',
        'title' => 'my title',
        'inner' => [
            'active' => true,
            'title' => 'My Inner Title',
        ],
    ];

    use HasActiveTrait,
        HasEmailTrait,
        HasTitleTrait;

    /** @var array $guarded - List of fields that should not be serializable into JSON. */
    protected array $guarded = ['email'];

    protected array $maps = [
        'is_active' => 'active',
        'address' => 'email',
    ];

    protected array $required = [
        'active',
        'email',
        'title',
    ];

    protected TestingNestedValueObject $inner;

    protected function castInner(array $inner): void
    {
        $this->inner = new TestingNestedValueObject($inner);
    }

    protected function getInner(): TestingNestedValueObject
    {
        return $this->inner;
    }

    /**
     * Initial Rule's testing method.
     *
     * @param  array $fields - Original fields being loaded into the Value Object.
     * @return array
     */
    protected function ruleTestingMethod(array $fields): array
    {
        $fields['title'] = 'My Outter Title';

        return $fields;
    }

    /**
     * onLoad's testing handler.
     *
     * @return void
     */
    protected function onLoadActivateValueObjectHandler(): void
    {
        $this->active = true;
    }
}
