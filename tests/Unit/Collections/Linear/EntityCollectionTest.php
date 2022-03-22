<?php

declare(strict_types=1);

namespace Hradigital\Tests\Datatypes\Unit\Collections\Linear;

use HraDigital\Datatypes\Collections\Linear\EntityCollection;
use HraDigital\Datatypes\Exceptions\Collections\DuplicatedEntryException;
use HraDigital\Datatypes\Exceptions\Datatypes\ParameterOutOfRangeException;
use HraDigital\Datatypes\Exceptions\Datatypes\PositiveIntegerException;
use HraDigital\Tests\Datatypes\AbstractBaseTestCase;
use HraDigital\Tests\Datatypes\Unit\ValueObjects\TestingValueObject;

/**
 * Entity Collection's Unit testing.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
class EntityCollectionTest extends AbstractBaseTestCase
{
    public function testLoadsSuccessfullyAndCanRetrieveSerializedData(): void
    {
        $collection = new EntityCollection();
        $this->assertEquals(0, $collection->count());

        $data = TestingValueObject::DATA;
        $data['id'] = 1;
        $collection->add(
            new TestingValueObject($data)
        );
        $data['id'] = 2;
        $collection->add(
            new TestingValueObject($data)
        );
        $data['id'] = 3;
        $collection->add(
            new TestingValueObject($data)
        );

        $array = $collection->all();
        $json = $collection->jsonSerialize();
        $ids = $collection->ids();

        $this->assertEquals(3, $collection->count());

        $this->assertCount(3, $array);
        $this->assertCount(3, $json);
        $this->assertCount(3, $ids);

        $this->assertContains(1, $ids);
        $this->assertContains(2, $ids);
        $this->assertContains(3, $ids);

        $entity = $collection->get(2);
        $this->assertEquals(2, $entity->{'getId'}());
    }

    public function testCanManageEntriesInCollection(): void
    {
        $collection = new EntityCollection();
        $this->assertEquals(0, $collection->count());
        $this->assertFalse($collection->valid());
        $this->assertNull($collection->current());
        $this->assertNull($collection->key());

        $data = TestingValueObject::DATA;
        $data['id'] = 1;
        $collection->add(
            new TestingValueObject($data)
        );
        $data['id'] = 2;
        $collection->add(
            new TestingValueObject($data)
        );
        $data['id'] = 3;
        $collection->add(
            new TestingValueObject($data)
        );

        $this->assertEquals(3, $collection->count());
        $this->assertTrue($collection->valid());
        $this->assertTrue($collection->has(1));
        $this->assertTrue($collection->has(2));
        $this->assertTrue($collection->has(3));
        $this->assertNotNull($collection->current());

        $this->assertEquals(1, $collection->key());
        $collection->next();
        $collection->next();
        $this->assertEquals(3, $collection->key());

        $collection->remove(2);
        $collection->rewind();
        $this->assertEquals(1, $collection->key());
        $this->assertEquals(2, $collection->count());
        $this->assertCount(2, $collection->ids());
        $this->assertCount(2, $collection->all());
        $this->assertTrue($collection->has(1));
        $this->assertFalse($collection->has(2));
        $this->assertTrue($collection->has(3));

        $collection->clear();
        $this->assertEquals(0, $collection->count());
    }

    public function testBreaksIfCheckingHasNonPositiveId(): void
    {
        $this->expectException(PositiveIntegerException::class);

        $collection = new EntityCollection();
        $collection->has(0);
    }

    public function testBreaksIfCheckingGetNonPositiveId(): void
    {
        $this->expectException(PositiveIntegerException::class);

        $collection = new EntityCollection();
        $collection->get(0);
    }

    public function testBreaksIfCheckingGetUnexistingId(): void
    {
        $this->expectException(ParameterOutOfRangeException::class);

        $collection = new EntityCollection();
        $collection->get(1);
    }

    public function testBreaksIfAttemptToAddTwoObjectsWithSameId(): void
    {
        $this->expectException(DuplicatedEntryException::class);

        $collection = new EntityCollection();
        $collection->add(
            new TestingValueObject(TestingValueObject::DATA)
        );
        $collection->add(
            new TestingValueObject(TestingValueObject::DATA)
        );
    }

    public function testBreaksIfAttemptsRemovingNonPositiveId(): void
    {
        $this->expectException(PositiveIntegerException::class);

        $collection = new EntityCollection();
        $collection->remove(0);
    }

    public function testBreaksIfAttemptsRemovingUnexistingId(): void
    {
        $this->expectException(ParameterOutOfRangeException::class);

        $collection = new EntityCollection();
        $collection->remove(1);
    }
}
