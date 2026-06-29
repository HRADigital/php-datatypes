<?php declare(strict_types=1);

namespace HraDigital\Tests\Datatypes\Unit\ValueObjects;

use HraDigital\Datatypes\ValueObjects\Address;
use HraDigital\Tests\Datatypes\AbstractBaseTestCase;

/**
 * Address Value Object Unit testing.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
class AddressTest extends AbstractBaseTestCase
{
    /**
     * Tests the constructor assigns all fields.
     *
     * @return void
     */
    public function testConstructorAssignsFields(): void
    {
        $address = new Address('Main St 1', '12345', 'Springfield', 'USA');

        $this->assertSame('Main St 1', $address->street);
        $this->assertSame('12345', $address->postalCode);
        $this->assertSame('Springfield', $address->city);
        $this->assertSame('USA', $address->country);
    }

    /**
     * Tests the accessor methods return each individual field.
     *
     * @return void
     */
    public function testGettersReturnEachField(): void
    {
        $address = new Address('Main St 1', '12345', 'Springfield', 'USA');

        $this->assertSame('Main St 1', $address->getStreet());
        $this->assertSame('12345', $address->getPostalCode());
        $this->assertSame('Springfield', $address->getCity());
        $this->assertSame('USA', $address->getCountry());
    }

    /**
     * Tests the named constructor coerces values and defaults missing keys.
     *
     * @return void
     */
    public function testFromArrayCoercesAndDefaultsMissingKeys(): void
    {
        $address = Address::fromArray(['street' => 'Main', 'postal_code' => '1']);

        $this->assertSame('Main', $address->street);
        $this->assertSame('1', $address->postalCode);
        $this->assertSame('', $address->city);
        $this->assertSame('', $address->country);
    }

    /**
     * Tests isEmpty() only returns true when every field is blank.
     *
     * @return void
     */
    public function testIsEmptyReturnsTrueOnlyWhenAllFieldsBlank(): void
    {
        $this->assertTrue((new Address('', '', '', ''))->isEmpty());
        $this->assertFalse((new Address('s', '', '', ''))->isEmpty());
    }

    /**
     * Tests equals() compares all fields and is case sensitive.
     *
     * @return void
     */
    public function testEqualsComparesAllFields(): void
    {
        $a = new Address('s', 'p', 'c', 'co');
        $b = new Address('s', 'p', 'c', 'co');
        $c = new Address('s', 'p', 'c', 'CO');

        $this->assertTrue($a->equals($b));
        $this->assertFalse($a->equals($c));
    }

    /**
     * Tests toArray() returns snake_case keys.
     *
     * @return void
     */
    public function testToArrayReturnsSnakeCaseKeys(): void
    {
        $address = new Address('s', 'p', 'c', 'co');

        $this->assertSame(
            ['street' => 's', 'postal_code' => 'p', 'city' => 'c', 'country' => 'co'],
            $address->toArray()
        );
    }

    /**
     * Tests jsonSerialize() mirrors toArray().
     *
     * @return void
     */
    public function testJsonSerializeReturnsSameAsToArray(): void
    {
        $address = new Address('s', 'p', 'c', 'co');

        $this->assertSame($address->toArray(), $address->jsonSerialize());
    }
}
