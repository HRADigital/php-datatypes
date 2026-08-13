<?php

declare(strict_types=1);

namespace HraDigital\Tests\Datatypes\Unit\Financial;

use HraDigital\Datatypes\Financial\Currency;
use HraDigital\Tests\Datatypes\AbstractBaseTestCase;
use function sprintf;

/**
 * Currency Unit testing.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 */
class CurrencyTest extends AbstractBaseTestCase
{
    public function testEuroValue(): void
    {
        $this->assertSame('EUR', Currency::EUR->value);
    }

    public function testFromValueReturnsCorrectCase(): void
    {
        $this->assertSame(Currency::USD, Currency::from('USD'));
    }

    public function testGetCodeReturnsBackingValue(): void
    {
        $this->assertSame('GBP', Currency::GBP->getCode());
    }

    public function testMinorUnitsDefaultToTwoDecimalPlaces(): void
    {
        $this->assertSame(2, Currency::EUR->minorUnits());
        $this->assertSame(2, Currency::USD->minorUnits());
    }

    public function testMinorUnitsAreZeroForYen(): void
    {
        $this->assertSame(0, Currency::JPY->minorUnits());
    }

    public function testAllCasesHaveNonEmptyValues(): void
    {
        foreach (Currency::cases() as $case) {
            $this->assertNotEmpty($case->value, sprintf('Case %s has empty value.', $case->name));
        }
    }
}
