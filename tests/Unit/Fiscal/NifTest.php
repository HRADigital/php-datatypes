<?php

declare(strict_types=1);

namespace HraDigital\Tests\Datatypes\Unit\Fiscal;

use HraDigital\Datatypes\Exceptions\Datatypes\InvalidNifException;
use HraDigital\Datatypes\Fiscal\Nif;
use HraDigital\Datatypes\Fiscal\NifType;
use HraDigital\Tests\Datatypes\AbstractBaseTestCase;
use Error;

/**
 * Nif Unit testing.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 */
class NifTest extends AbstractBaseTestCase
{
    public function testCreatesFromValidNif(): void
    {
        $nif = Nif::create('123456789');

        $this->assertInstanceOf(Nif::class, $nif);
        $this->assertSame('123456789', (string) $nif);
    }

    public function testRemovesAllWhitespaceBeforeValidation(): void
    {
        $nif = Nif::create(" 123 456\t78\n9 ");

        $this->assertSame('123456789', (string) $nif);
    }

    public function testAcceptsCheckDigitZeroWhenRemainderIsZero(): void
    {
        $this->assertSame('130000000', (string) Nif::create('130000000'));
    }

    public function testAcceptsCheckDigitZeroWhenRemainderIsOne(): void
    {
        $this->assertSame('500000000', (string) Nif::create('500000000'));
    }

    public function testEqualsReturnsTrueForIdenticalValues(): void
    {
        $this->assertTrue(Nif::create('123456789')->equals(Nif::create('123 456 789')));
    }

    public function testEqualsReturnsFalseForDifferentValues(): void
    {
        $this->assertFalse(Nif::create('123456789')->equals(Nif::create('500000000')));
    }

    /**
     * @return array<string, array{string, NifType}>
     */
    public static function typeProvider(): array
    {
        return [
            'prefix 1'  => ['123456789', NifType::NATURAL_PERSON],
            'prefix 2'  => ['200000004', NifType::NATURAL_PERSON],
            'prefix 3'  => ['300000006', NifType::NATURAL_PERSON],
            'prefix 45' => ['450000001', NifType::NATURAL_PERSON],
            'prefix 40' => ['400000008', NifType::LEGAL_PERSON],
            'prefix 5'  => ['500000000', NifType::LEGAL_PERSON],
            'prefix 6'  => ['600000001', NifType::LEGAL_PERSON],
        ];
    }

    /** @dataProvider typeProvider */
    public function testGetTypeFollowsTheLeadingDigits(string $value, NifType $expected): void
    {
        $this->assertSame($expected, Nif::create($value)->getType());
    }

    /**
     * @return array<string, array{string}>
     */
    public static function invalidProvider(): array
    {
        return [
            'empty'              => [''],
            'whitespace only'    => ['   '],
            'wrong check digit'  => ['123456788'],
            'eight digits'       => ['12345678'],
            'ten digits'         => ['1234567890'],
            'letter'             => ['12345678A'],
            'dashes'             => ['123-456-789'],
            'non-ascii digit'    => ['12345678٩'],
        ];
    }

    /** @dataProvider invalidProvider */
    public function testThrowsInvalidNifExceptionForInvalidValue(string $value): void
    {
        $this->expectException(InvalidNifException::class);

        Nif::create($value);
    }

    public function testRefusesToAcceptADynamicProperty(): void
    {
        $nif = Nif::create('123456789');

        $this->expectException(Error::class);

        /** @phpstan-ignore property.notFound */
        $nif->prefix = 'other';
    }
}
