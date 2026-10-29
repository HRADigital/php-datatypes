<?php declare(strict_types=1);

namespace HraDigital\Tests\Datatypes\Unit\Financial;

use HraDigital\Datatypes\Financial\Currency;
use HraDigital\Datatypes\Financial\Money;
use HraDigital\Tests\Datatypes\AbstractBaseTestCase;
use Error;
use InvalidArgumentException;

/**
 * Money Value Object Unit testing.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 */
class MoneyTest extends AbstractBaseTestCase
{
    /**
     * Tests the constructor assigns all fields.
     */
    public function testConstructorAssignsFields(): void
    {
        $money = new Money(1234, Currency::EUR);

        $this->assertSame(1234, $money->amount);
        $this->assertSame(Currency::EUR, $money->currency);
    }

    /**
     * Tests the accessor methods return each individual field.
     */
    public function testGettersReturnEachField(): void
    {
        $money = new Money(1234, Currency::EUR);

        $this->assertSame(1234, $money->getAmount());
        $this->assertSame(Currency::EUR, $money->getCurrency());
        $this->assertSame('EUR', $money->getCurrencyCode());
    }

    /**
     * Tests the named constructor rehydrates from the two persisted scalars.
     */
    public function testFromScalarsRehydratesStoredColumns(): void
    {
        $money = Money::fromScalars(-500, 'USD');

        $this->assertSame(-500, $money->amount);
        $this->assertSame(Currency::USD, $money->currency);
    }

    /**
     * Tests the named constructor coerces values and defaults a missing amount.
     */
    public function testFromArrayCoercesAndDefaultsMissingAmount(): void
    {
        $money = Money::fromArray(['currency' => 'GBP']);

        $this->assertSame(0, $money->amount);
        $this->assertSame(Currency::GBP, $money->currency);
    }

    /**
     * Tests a decimal representation is converted into minor units.
     */
    public function testFromDecimalConvertsIntoMinorUnits(): void
    {
        $this->assertSame(1234, Money::fromDecimal('12.34', Currency::EUR)->amount);
        $this->assertSame(1200, Money::fromDecimal('12', Currency::EUR)->amount);
        $this->assertSame(-1234, Money::fromDecimal('-12.34', Currency::EUR)->amount);
        $this->assertSame(1230, Money::fromDecimal('12.3', Currency::EUR)->amount);
    }

    /**
     * Tests extra decimal places are truncated, and zero decimal currencies drop them all.
     */
    public function testFromDecimalTruncatesExtraDecimalPlaces(): void
    {
        $this->assertSame(1239, Money::fromDecimal('12.3999', Currency::EUR)->amount);
        $this->assertSame(120, Money::fromDecimal('120.99', Currency::JPY)->amount);
    }

    /**
     * Tests a malformed decimal representation is rejected.
     */
    public function testFromDecimalRejectsMalformedValue(): void
    {
        $this->expectException(InvalidArgumentException::class);

        Money::fromDecimal('12,34', Currency::EUR);
    }

    /**
     * Tests a float amount is converted into minor units without rounding artifacts.
     */
    public function testFromFloatConvertsIntoMinorUnits(): void
    {
        $this->assertSame(1234, Money::fromFloat(12.34, Currency::EUR)->amount);
        $this->assertSame(1200, Money::fromFloat(12.0, Currency::EUR)->amount);
        $this->assertSame(-1234, Money::fromFloat(-12.34, Currency::EUR)->amount);
        $this->assertSame(120, Money::fromFloat(120.0, Currency::JPY)->amount);
    }

    /**
     * Tests the minor units are emitted back as a decimal representation.
     */
    public function testToDecimalEmitsDecimalRepresentation(): void
    {
        $this->assertSame('12.34', (new Money(1234, Currency::EUR))->toDecimal());
        $this->assertSame('0.05', (new Money(5, Currency::EUR))->toDecimal());
        $this->assertSame('-12.34', (new Money(-1234, Currency::EUR))->toDecimal());
        $this->assertSame('0.00', (new Money(0, Currency::EUR))->toDecimal());
        $this->assertSame('120', (new Money(120, Currency::JPY))->toDecimal());
    }

    /**
     * Tests isEmpty() only returns true on a zero amount.
     */
    public function testIsEmptyReturnsTrueOnlyOnZeroAmount(): void
    {
        $this->assertTrue((new Money(0, Currency::EUR))->isEmpty());
        $this->assertFalse((new Money(1, Currency::EUR))->isEmpty());
    }

    /**
     * Tests equals() compares both the amount and the currency.
     */
    public function testEqualsComparesAmountAndCurrency(): void
    {
        $a = new Money(100, Currency::EUR);
        $b = new Money(100, Currency::EUR);
        $c = new Money(100, Currency::USD);
        $d = new Money(101, Currency::EUR);

        $this->assertTrue($a->equals($b));
        $this->assertFalse($a->equals($c));
        $this->assertFalse($a->equals($d));
    }

    /**
     * Tests toArray() returns the two persisted scalars.
     */
    public function testToArrayReturnsStorableScalars(): void
    {
        $money = new Money(1234, Currency::EUR);

        $this->assertSame(
            ['amount' => 1234, 'currency' => 'EUR'],
            $money->toArray()
        );
    }

    /**
     * Tests jsonSerialize() mirrors toArray().
     */
    public function testJsonSerializeReturnsSameAsToArray(): void
    {
        $money = new Money(1234, Currency::EUR);

        $this->assertSame($money->toArray(), $money->jsonSerialize());
    }

    /**
     * Tests the class is readonly, therefore an already initialized property cannot be overwritten.
     */
    public function testRefusesToOverwriteAnInitializedProperty(): void
    {
        $money = new Money(1234, Currency::EUR);

        $this->expectException(Error::class);

        /** @phpstan-ignore property.readOnlyAssignOutOfClass */
        $money->amount = 1;
    }

    /**
     * Tests the class is readonly, therefore no dynamic property can be added to an instance.
     */
    public function testRefusesToAcceptADynamicProperty(): void
    {
        $money = new Money(1234, Currency::EUR);

        $this->expectException(Error::class);

        /** @phpstan-ignore property.notFound */
        $money->rate = 1;
    }
}
