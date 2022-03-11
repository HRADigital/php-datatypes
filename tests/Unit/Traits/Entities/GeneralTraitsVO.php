<?php

declare(strict_types=1);

namespace HraDigital\Tests\Datatypes\Unit\Traits\Entities;

use HraDigital\Datatypes\Traits\Entities\CanProcessOnUpdateEventsTrait;
use HraDigital\Datatypes\Traits\Entities\General\HasActiveTrait;
use HraDigital\Datatypes\Traits\Entities\General\HasAliasTrait;
use HraDigital\Datatypes\Traits\Entities\General\HasCreatedAtTrait;
use HraDigital\Datatypes\Traits\Entities\General\HasDeletedAtTrait;
use HraDigital\Datatypes\Traits\Entities\General\HasEmailTrait;
use HraDigital\Datatypes\Traits\Entities\General\HasFeatureTrait;
use HraDigital\Datatypes\Traits\Entities\General\HasHitsTrait;
use HraDigital\Datatypes\Traits\Entities\General\HasNameTrait;
use HraDigital\Datatypes\Traits\Entities\General\HasOrderingTrait;
use HraDigital\Datatypes\Traits\Entities\General\HasPasswordTrait;
use HraDigital\Datatypes\Traits\Entities\General\HasPositiveIntegerIDTrait;
use HraDigital\Datatypes\Traits\Entities\General\HasPublishedTrait;
use HraDigital\Datatypes\Traits\Entities\General\HasSeoFieldsTrait;
use HraDigital\Datatypes\Traits\Entities\General\HasTitleTrait;
use HraDigital\Datatypes\Traits\Entities\General\HasUpdatableUpdatedAtTrait;
use HraDigital\Datatypes\Traits\Entities\General\HasUuidTrait;
use HraDigital\Datatypes\Traits\Entities\General\HasSurnameTrait;
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
