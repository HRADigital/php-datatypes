<?php

declare(strict_types=1);

namespace HraDigital\Tests\Datatypes\Unit\ValueObjects;

use HraDigital\Datatypes\Exceptions\Datatypes\InvalidUuidException;
use HraDigital\Datatypes\ValueObjects\RecordId;
use HraDigital\Tests\Datatypes\AbstractBaseTestCase;
use Ramsey\Uuid\Rfc4122\FieldsInterface;
use Ramsey\Uuid\Uuid;

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
}
