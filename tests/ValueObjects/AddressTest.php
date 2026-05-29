<?php

declare(strict_types=1);

namespace HraDigital\Tests\Datatypes\ValueObjects;

use HraDigital\Datatypes\ValueObjects\Address;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversClass(Address::class)]
class AddressTest extends TestCase
{
    #[Test]
    public function testConstructorAssignsFields(): void
    {
        $address = new Address('Main St 1', '12345', 'Springfield', 'USA');

        $this->assertSame('Main St 1', $address->street);
        $this->assertSame('12345', $address->postalCode);
        $this->assertSame('Springfield', $address->city);
        $this->assertSame('USA', $address->country);
    }

    #[Test]
    public function testFromArrayCoercesAndDefaultsMissingKeys(): void
    {
        $address = Address::fromArray(['street' => 'Main', 'postal_code' => '1']);

        $this->assertSame('Main', $address->street);
        $this->assertSame('1', $address->postalCode);
        $this->assertSame('', $address->city);
        $this->assertSame('', $address->country);
    }

    #[Test]
    public function testIsEmptyReturnsTrueOnlyWhenAllFieldsBlank(): void
    {
        $this->assertTrue((new Address('', '', '', ''))->isEmpty());
        $this->assertFalse((new Address('s', '', '', ''))->isEmpty());
    }

    #[Test]
    public function testEqualsComparesAllFields(): void
    {
        $a = new Address('s', 'p', 'c', 'co');
        $b = new Address('s', 'p', 'c', 'co');
        $c = new Address('s', 'p', 'c', 'CO');

        $this->assertTrue($a->equals($b));
        $this->assertFalse($a->equals($c));
    }

    #[Test]
    public function testToArrayReturnsSnakeCaseKeys(): void
    {
        $address = new Address('s', 'p', 'c', 'co');

        $this->assertSame(
            ['street' => 's', 'postal_code' => 'p', 'city' => 'c', 'country' => 'co'],
            $address->toArray(),
        );
    }

    #[Test]
    public function testJsonSerializeReturnsSameAsToArray(): void
    {
        $address = new Address('s', 'p', 'c', 'co');

        $this->assertSame($address->toArray(), $address->jsonSerialize());
    }
}
