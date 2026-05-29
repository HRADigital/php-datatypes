<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\ValueObjects;

/**
 * Postal address value object.
 *
 * Immutable, primitive-typed. Designed to be expanded/compressed at persistence
 * boundaries: a caller stores the four parts as four columns and rehydrates an
 * Address on read. Validation is intentionally minimal — callers enforce field
 * rules (length, required) at their own boundary.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
class Address implements \JsonSerializable
{
    public function __construct(
        public readonly string $street,
        public readonly string $postalCode,
        public readonly string $city,
        public readonly string $country,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            street:     (string) ($data['street'] ?? ''),
            postalCode: (string) ($data['postal_code'] ?? ''),
            city:       (string) ($data['city'] ?? ''),
            country:    (string) ($data['country'] ?? ''),
        );
    }

    public function getStreet(): string
    {
        return $this->street;
    }

    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function isEmpty(): bool
    {
        return $this->street === ''
            && $this->postalCode === ''
            && $this->city === ''
            && $this->country === '';
    }

    public function equals(self $other): bool
    {
        return $this->street === $other->street
            && $this->postalCode === $other->postalCode
            && $this->city === $other->city
            && $this->country === $other->country;
    }

    /**
     * @return array{street: string, postal_code: string, city: string, country: string}
     */
    public function toArray(): array
    {
        return [
            'street'      => $this->street,
            'postal_code' => $this->postalCode,
            'city'        => $this->city,
            'country'     => $this->country,
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
