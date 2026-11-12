<?php

declare(strict_types=1);

namespace HraDigital\Tests\Datatypes\Unit\ValueObjects;

use HraDigital\Datatypes\Exceptions\Datatypes\InvalidUuidException;
use HraDigital\Datatypes\ValueObjects\RecordId;
use HraDigital\Tests\Datatypes\AbstractBaseTestCase;
use Ramsey\Uuid\Rfc4122\FieldsInterface;
use Ramsey\Uuid\Uuid;
use function bin2hex;
use function str_repeat;
use function strlen;

/**
 * RecordId Unit testing.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 */
class RecordIdTest extends AbstractBaseTestCase
{
    private const UUID = '0190B5A2-7C3E-7A1B-8C2D-3E4F5A6B7C8D';

    private const NIL = '00000000-0000-0000-0000-000000000000';

    private const MAX = 'ffffffff-ffff-ffff-ffff-ffffffffffff';

    // Version 7 nibble, but variant bits 0xx (NCS) instead of the RFC 4122 10xx.
    private const WRONG_VARIANT = '0190b5a2-7c3e-7a1b-0c2d-3e4f5a6b7c8d';

    public function testGeneratesValidV7Uuid(): void
    {
        $id = RecordId::generate();
        $fields = Uuid::fromString((string) $id)->getFields();

        $this->assertInstanceOf(FieldsInterface::class, $fields);
        $this->assertSame(7, $fields->getVersion());
    }

    public function testFromStringKeepsValidValueInLowerCase(): void
    {
        $id = RecordId::fromString(self::UUID);

        $this->assertSame('0190b5a2-7c3e-7a1b-8c2d-3e4f5a6b7c8d', (string) $id);
    }

    public function testFromStringThrowsOnInvalidValue(): void
    {
        $this->expectException(InvalidUuidException::class);

        RecordId::fromString('not-a-uuid');
    }

    public function testSubclassFactoriesReturnSubclass(): void
    {
        $this->assertInstanceOf(TestingRecordId::class, TestingRecordId::generate());
        $this->assertInstanceOf(TestingRecordId::class, TestingRecordId::fromString(self::UUID));
    }

    public function testEqualsIsTrueForSameClassAndValue(): void
    {
        $this->assertTrue(RecordId::fromString(self::UUID)->equals(RecordId::fromString(self::UUID)));
    }

    public function testEqualsIsFalseForDifferentValue(): void
    {
        $this->assertFalse(RecordId::fromString(self::UUID)->equals(RecordId::generate()));
    }

    public function testEqualsIsFalseForDifferentClass(): void
    {
        $this->assertFalse(RecordId::fromString(self::UUID)->equals(TestingRecordId::fromString(self::UUID)));
    }

    public function testFromStringThrowsOnV4Uuid(): void
    {
        $this->expectException(InvalidUuidException::class);

        RecordId::fromString(Uuid::uuid4()->toString());
    }

    public function testFromStringThrowsOnNilUuid(): void
    {
        $this->expectException(InvalidUuidException::class);

        RecordId::fromString(self::NIL);
    }

    public function testFromStringThrowsOnMaxUuid(): void
    {
        $this->expectException(InvalidUuidException::class);

        RecordId::fromString(self::MAX);
    }

    public function testFromStringThrowsOnWrongVariant(): void
    {
        $this->expectException(InvalidUuidException::class);

        RecordId::fromString(self::WRONG_VARIANT);
    }

    public function testFromBytesRoundTripsToBytes(): void
    {
        $id = RecordId::generate();

        $this->assertTrue(RecordId::fromBytes($id->toBytes())->equals($id));
    }

    public function testToBytesReturnsTheSixteenBytesOfTheUuid(): void
    {
        $id = RecordId::fromString(self::UUID);
        $bytes = $id->toBytes();

        $this->assertSame(RecordId::BYTES_LENGTH, strlen($bytes));
        $this->assertSame(Uuid::fromString((string) $id)->getBytes(), $bytes);
    }

    public function testFromBytesThrowsOnFifteenBytes(): void
    {
        $this->expectException(InvalidUuidException::class);

        RecordId::fromBytes(str_repeat("\x01", 15));
    }

    public function testFromBytesThrowsOnSeventeenBytes(): void
    {
        $this->expectException(InvalidUuidException::class);

        RecordId::fromBytes(str_repeat("\x01", 17));
    }

    public function testFromBytesThrowsOnV4Bytes(): void
    {
        $this->expectException(InvalidUuidException::class);

        RecordId::fromBytes(Uuid::uuid4()->getBytes());
    }

    public function testFromBytesThrowsOnWrongVariant(): void
    {
        $this->expectException(InvalidUuidException::class);

        RecordId::fromBytes(Uuid::fromString(self::WRONG_VARIANT)->getBytes());
    }

    public function testFromBytesMessageCarriesTheHexForm(): void
    {
        $bytes = str_repeat("\xff", 15);

        $this->expectException(InvalidUuidException::class);
        $this->expectExceptionMessage("'" . bin2hex($bytes) . "'");

        RecordId::fromBytes($bytes);
    }

    public function testSubclassFromBytesReturnsSubclass(): void
    {
        $bytes = RecordId::fromString(self::UUID)->toBytes();

        $this->assertInstanceOf(TestingRecordId::class, TestingRecordId::fromBytes($bytes));
    }
}
