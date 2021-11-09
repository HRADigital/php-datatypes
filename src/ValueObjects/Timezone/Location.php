<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\ValueObjects\Timezone;

use HraDigital\Datatypes\Scalar\Str;
use HraDigital\Datatypes\Traits\Entities\Location\HasCountryCodeTrait;
use HraDigital\Datatypes\Traits\Entities\Location\HasLatitudeTrait;
use HraDigital\Datatypes\Traits\Entities\Location\HasLongitudeTrait;
use HraDigital\Datatypes\ValueObjects\AbstractValueObject;

/**
 * Timezone Location Value Object class.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 * @link      https://www.php.net/manual/en/datetimezone.getlocation.php
 */
class Location extends AbstractValueObject
{
    use HasCountryCodeTrait,
        HasLatitudeTrait,
        HasLongitudeTrait;

    protected ?Str $comments = null;

    /** @inheritDoc */
    protected array $required = [
        'countryCode',
        'latitude',
        'longitude',
    ];

    protected function castComments(?string $comments): void
    {
        $this->comments = ($comments ? Str::create($comments) : null);
    }

    public function comments(): ?Str
    {
        return $this->comments;
    }
}
