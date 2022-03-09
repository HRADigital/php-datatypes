<?php

declare(strict_types=1);

namespace HraDigital\Tests\Datatypes\Unit\ValueObjects;

use HraDigital\Datatypes\Exceptions\Entities\RequiredEntityValueMissingException;
use HraDigital\Datatypes\Scalar\Str;
use HraDigital\Tests\Datatypes\AbstractBaseTestCase;

/**
 * Abstract Value Object Unit testing.
 *
 * @package   Hradigital\Datatypes
 * @copyright Hradigital\Datatypes
 * @license   MIT
 */
class AbstractValueObjectTest extends AbstractBaseTestCase
{
    public function testLoadsSuccessfully(): void
    {
        $valueObject = new TestingValueObject(
            TestingValueObject::DATA
        );

        // Tests field mapping and onLoad events work.
        $this->assertFalse(TestingValueObject::DATA['is_active']);
        $this->assertFalse($valueObject->isActive());

        // Test Rule's processing works.
        $this->assertEquals(
            'MY TITLE',
            (string) $valueObject->getTitle()->toUpper()
        );

        // Test field casting works.
        $this->assertInstanceOf(Str::class, $valueObject->getTitle());
    }

    public function testBreaksIfRequiredFieldIsMissing(): void
    {
        $data = TestingValueObject::DATA;
        unset($data['is_active']);

        $this->expectException(RequiredEntityValueMissingException::class);

        new TestingValueObject($data);
    }

    public function testCanRetrieveFirstLevelAttributes(): void
    {
        $valueObject = new TestingValueObject(
            TestingValueObject::DATA
        );
        $attributes = $valueObject->getAttributes();

        $this->assertArrayHasKey('active', $attributes);
        $this->assertArrayHasKey('email', $attributes);
        $this->assertArrayHasKey('title', $attributes);
        $this->assertArrayNotHasKey('inner', $attributes);
    }

    public function testCanConvertToJsonWhileGuardingCertainAttributes(): void
    {
        $valueObject = new TestingValueObject(
            TestingValueObject::DATA
        );
        $json = \json_decode(
            \json_encode($valueObject),
            true
        );

        $this->assertArrayHasKey('active', $json);
        $this->assertArrayNotHasKey('email', $json);
        $this->assertArrayHasKey('title', $json);
        $this->assertArrayHasKey('inner', $json);

        $this->assertArrayHasKey('title', $json['inner']);
        $this->assertArrayNotHasKey('active', $json['inner']);
    }

    public function testCanConvertToArray(): void
    {
        $valueObject = new TestingValueObject(
            TestingValueObject::DATA
        );
        $array = $valueObject->toArray();

        $this->assertArrayHasKey('active', $array);
        $this->assertArrayHasKey('email', $array);
        $this->assertArrayHasKey('title', $array);
        $this->assertArrayHasKey('inner', $array);

        $this->assertArrayHasKey('title', $array['inner']);
        $this->assertArrayHasKey('active', $array['inner']);
    }

    public function testCanSerializeAndUnserialize(): void
    {
        $valueObject = new TestingValueObject(
            TestingValueObject::DATA
        );

        $serialized = \serialize($valueObject);
        $unserialized = \unserialize($serialized);

        $this->assertInstanceOf(TestingValueObject::class, $valueObject);
        $this->assertInstanceOf(TestingValueObject::class, $unserialized);
        $this->assertEquals(
            $valueObject->isActive(),
            $unserialized->isActive()
        );
        $this->assertEquals(
            (string) $valueObject->getTitle(),
            (string) $unserialized->getTitle()
        );
    }

    public function testCanCallDebugInfoInValueObject(): void
    {
        $valueObject = new TestingValueObject(
            TestingValueObject::DATA
        );
        $array = $valueObject->__debugInfo();

        $this->assertArrayHasKey('active', $array);
        $this->assertArrayHasKey('email', $array);
        $this->assertArrayHasKey('title', $array);
        $this->assertArrayHasKey('inner', $array);

        $this->assertArrayHasKey('title', $array['inner']);
        $this->assertArrayHasKey('active', $array['inner']);
    }

    public function testCanChangeAndTrackState(): void
    {
        $valueObject = new TestingValueObject(
            TestingValueObject::DATA
        );

        // Checks initially loaded state.
        $this->assertFalse($valueObject->isActive());
        $this->assertFalse($valueObject->getInner()->isActive());
        $mainUpdatedAt = $valueObject->getUpdatedAt();
        $innerUpdatedAt = $valueObject->getInner()->getUpdatedAt();

        // Perform state change operations on Aggregate.
        $valueObject->activate();
        $valueObject->changeTitle(Str::create('Main Title'));

        // Checks it's now marked as Dirty
        $this->assertTrue($valueObject->isActive());
        $this->assertFalse($valueObject->getInner()->isActive());
        $this->assertTrue($valueObject->isDirty());
        $dirty = $valueObject->getDirty(true);

        // Checks Dirty array contains only fields that have changed.
        $this->assertArrayHasKey('active', $dirty);
        $this->assertArrayNotHasKey('email', $dirty);
        $this->assertArrayHasKey('title', $dirty);
        $this->assertArrayHasKey('inner', $dirty);

        $this->assertArrayHasKey('title', $dirty['inner']);
        $this->assertArrayNotHasKey('active', $dirty['inner']);

        // Asserts that UpdatedAt DateTimes have updated with calls.
        $this->assertNotEquals(
            (string) $mainUpdatedAt->toDatetimeString(),
            (string) $valueObject->getUpdatedAt()->toDatetimeString()
        );
        $this->assertNotEquals(
            (string) $innerUpdatedAt->toDatetimeString(),
            (string) $valueObject->getInner()->getUpdatedAt()->toDatetimeString()
        );
    }
}
