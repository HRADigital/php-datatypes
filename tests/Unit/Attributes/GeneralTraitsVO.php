<?php

declare(strict_types=1);

namespace HraDigital\Tests\Datatypes\Unit\Attributes;

use HraDigital\Datatypes\Traits\Entities\CanProcessOnUpdateEventsTrait;
use HraDigital\Datatypes\Attributes\General\HasActiveTrait;
use HraDigital\Datatypes\Attributes\General\HasAliasTrait;
use HraDigital\Datatypes\Attributes\General\HasCreatedAtTrait;
use HraDigital\Datatypes\Attributes\General\HasDeletedAtTrait;
use HraDigital\Datatypes\Attributes\General\HasEmailTrait;
use HraDigital\Datatypes\Attributes\General\HasFeatureTrait;
use HraDigital\Datatypes\Attributes\General\HasHitsTrait;
use HraDigital\Datatypes\Attributes\General\HasNameTrait;
use HraDigital\Datatypes\Attributes\General\HasOrderingTrait;
use HraDigital\Datatypes\Attributes\General\HasPasswordTrait;
use HraDigital\Datatypes\Attributes\General\HasPositiveIntegerIDTrait;
use HraDigital\Datatypes\Attributes\General\HasPublishedTrait;
use HraDigital\Datatypes\Attributes\General\HasSeoFieldsTrait;
use HraDigital\Datatypes\Attributes\General\HasTitleTrait;
use HraDigital\Datatypes\Attributes\General\HasUpdatableUpdatedAtTrait;
use HraDigital\Datatypes\Attributes\General\HasUuidTrait;
use HraDigital\Datatypes\Attributes\General\HasSurnameTrait;
use HraDigital\Datatypes\ValueObjects\AbstractValueObject;

/**
 * Testing Value Object for General Entity Traits.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
class GeneralTraitsVO extends AbstractValueObject
{
    use HasActiveTrait,
        HasAliasTrait,
        HasCreatedAtTrait,
        HasDeletedAtTrait,
        HasEmailTrait,
        HasFeatureTrait,
        HasHitsTrait,
        HasNameTrait,
        HasOrderingTrait,
        HasPasswordTrait,
        HasPositiveIntegerIDTrait,
        HasPublishedTrait,
        HasSeoFieldsTrait,
        HasTitleTrait,
        HasUpdatableUpdatedAtTrait,
        HasUuidTrait,
        HasSurnameTrait,
        CanProcessOnUpdateEventsTrait;

    public function simulateUpdate(): void
    {
        $this->triggerOnUpdate();
    }
}
