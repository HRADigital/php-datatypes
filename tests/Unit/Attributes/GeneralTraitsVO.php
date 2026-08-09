<?php

declare(strict_types=1);

namespace HraDigital\Tests\Datatypes\Unit\Attributes;

use HraDigital\Datatypes\Attributes\General\HasActiveTrait;
use HraDigital\Datatypes\Attributes\General\HasAliasTrait;
use HraDigital\Datatypes\Attributes\General\HasDeletedAtTrait;
use HraDigital\Datatypes\Attributes\General\HasEmailTrait;
use HraDigital\Datatypes\Attributes\General\HasFeatureTrait;
use HraDigital\Datatypes\Attributes\General\HasHitsTrait;
use HraDigital\Datatypes\Attributes\General\HasNameTrait;
use HraDigital\Datatypes\Attributes\General\HasOrderingTrait;
use HraDigital\Datatypes\Attributes\General\HasPasswordTrait;
use HraDigital\Datatypes\Attributes\General\HasPositiveIntegerIDTrait;
use HraDigital\Datatypes\Attributes\General\HasPublishedTimestampsTrait;
use HraDigital\Datatypes\Attributes\General\HasPublishedTrait;
use HraDigital\Datatypes\Attributes\General\HasSeoFieldsTrait;
use HraDigital\Datatypes\Attributes\General\HasSurnameTrait;
use HraDigital\Datatypes\Attributes\General\HasTimestampsTrait;
use HraDigital\Datatypes\Attributes\General\HasTitleTrait;
use HraDigital\Datatypes\Attributes\General\HasUpdatableUpdatedAtTrait;
use HraDigital\Datatypes\Attributes\General\HasUuidTrait;
use HraDigital\Datatypes\ValueObjects\AbstractValueObject;
use HraDigital\Datatypes\ValueObjects\Traits\CanProcessOnUpdateEventsTrait;

/**
 * Testing Value Object for General Entity Traits.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 */
class GeneralTraitsVO extends AbstractValueObject
{
    use HasActiveTrait,
        HasAliasTrait,
        HasDeletedAtTrait,
        HasEmailTrait,
        HasFeatureTrait,
        HasHitsTrait,
        HasNameTrait,
        HasOrderingTrait,
        HasPasswordTrait,
        HasPositiveIntegerIDTrait,
        HasPublishedTimestampsTrait,
        HasPublishedTrait,
        HasSeoFieldsTrait,
        HasTimestampsTrait,
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
