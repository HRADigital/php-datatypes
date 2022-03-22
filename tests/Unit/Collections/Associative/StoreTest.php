<?php

declare(strict_types=1);

namespace Hradigital\Tests\Datatypes\Unit\Collections\Associative;

use HraDigital\Datatypes\Collections\Associative\Store;
use HraDigital\Datatypes\Exceptions\Datatypes\NonEmptyStringException;
use HraDigital\Tests\Datatypes\AbstractBaseTestCase;

/**
 * Store's Unit testing.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
class StoreTest extends AbstractBaseTestCase
{
    public function testCanLoadInstanceCorrectly(): void
    {
        $store = new Store();

        $this->assertEquals(0, $store->count());
    }

    public function testCanSetAndGetValues(): void
    {
        $key = 'testKey';
        $value = 'TestValue';

        $store = new Store();

        // Tries aditing a value before setting it.
        $editedBefore = $store->edit($key, 'New Value');
        $this->assertEquals(0, $store->count());
        $this->assertCount(0, $store->jsonSerialize());
        $this->assertFalse($editedBefore);

        // Sets value directly.
        $store->set($key, $value);
        $this->assertTrue($store->has($key));
        $this->assertEquals($value, $store->get($key));
        $this->assertEquals(1, $store->count());

        // Now edits existing value.
        $edited = $store->edit($key, 'New Value');
        $this->assertNotEquals($value, $store->get($key));
        $this->assertTrue($edited);

        // Unsuccessfully tries adding a value as a new.
        $addedAfter = $store->add($key, 'Tries adding new Value to existing key');
        $this->assertFalse($addedAfter);
        $this->assertEquals(1, $store->count());

        // Forces/overrides setting value.
        $store->set($key, $value);
        $this->assertEquals($value, $store->get($key));
        $this->assertEquals(1, $store->count());
        $this->assertCount(1, $store->jsonSerialize());
    }

    public function testAddingValueAndThenDeletingIt(): void
    {
        $key = 'testKey';
        $value = 'TestValue';

        $store = new Store('Context');
        $deletedBefore = $store->delete($key);
        $this->assertFalse($deletedBefore);
        $this->assertEquals(0, $store->count());
        $this->assertEquals('Unexisting', $store->get($key, 'Unexisting'));

        // First adds a new value to the Store.
        $added = $store->add($key, $value);
        $this->assertTrue($added);
        $this->assertTrue($store->has($key));
        $this->assertEquals($value, $store->get($key, 'Unexisting'));
        $this->assertEquals(1, $store->count());

        // Now deletes the same value.
        $deletedAfter = $store->delete($key);
        $this->assertTrue($deletedAfter);
        $this->assertFalse($store->has($key));
        $this->assertEquals(0, $store->count());
    }

    public function testBreaksIfContextIsEmpty(): void
    {
        $this->expectException(NonEmptyStringException::class);

        new Store('');
    }

    public function testBreaksIfTryingToSetEmptyKey(): void
    {
        $this->expectException(NonEmptyStringException::class);

        $store = new Store('Context');
        $store->set('', '');
    }

    public function testBreaksIfTryingToGetEmptyKey(): void
    {
        $this->expectException(NonEmptyStringException::class);

        $store = new Store('Context');
        $store->get('');
    }

    public function testBreaksIfTryingToAddEmptyKey(): void
    {
        $this->expectException(NonEmptyStringException::class);

        $store = new Store('Context');
        $store->add('', '');
    }

    public function testBreaksIfTryingToEditEmptyKey(): void
    {
        $this->expectException(NonEmptyStringException::class);

        $store = new Store('Context');
        $store->edit('', '');
    }

    public function testBreaksIfTryingToDeleteEmptyKey(): void
    {
        $this->expectException(NonEmptyStringException::class);

        $store = new Store('Context');
        $store->delete('');
    }
}
