<?php

declare(strict_types=1);

namespace Hradigital\Tests\Datatypes\Unit\Collections\Linear;

use HraDigital\Datatypes\Collections\Linear\Queue;
use HraDigital\Datatypes\Exceptions\Datatypes\NonEmptyStringException;
use HraDigital\Datatypes\Exceptions\Datatypes\ParameterOutOfRangeException;
use HraDigital\Datatypes\Exceptions\Datatypes\PositiveIntegerException;
use HraDigital\Tests\Datatypes\AbstractBaseTestCase;

/**
 * Queue's Unit testing.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
class QueueTest extends AbstractBaseTestCase
{
    public function testCanLoadInstanceCorrectlyAndCopyIt(): void
    {
        $queue = new Queue();
        $newQueue = $queue->clone();

        $this->assertEquals(0, $queue->count());
        $this->assertTrue($queue->isEmpty());

        $this->assertEquals(0, $newQueue->count());
        $this->assertTrue($newQueue->isEmpty());

        $this->assertFalse($queue === $newQueue);
        $this->assertNull($queue->peek());
        $this->assertNull($queue->pop());
        $this->assertNull($queue->getCapacity());
        $this->assertFalse($queue->hasMaxCapacity());
    }

    public function testCanPushPeekAndPopElements(): void
    {
        $element1 = 'element1';
        $element2 = 'element2';
        $element3 = 'element3';

        $queue = new Queue([
            $element1,
            $element2,
        ]);

        $this->assertEquals(2, $queue->count());
        $this->assertEquals($element1, (string) $queue->peek());
        $this->assertFalse($queue->isEmpty());

        $queue->push($element3);
        $this->assertEquals(3, $queue->count());
        $this->assertEquals($element1, (string) $queue->peek());

        $popElement1 = $queue->pop();
        $this->assertEquals($element1, (string) $popElement1);
        $popElement2 = $queue->pop();
        $this->assertEquals($element2, (string) $popElement2);
        $this->assertEquals(1, $queue->count());
        $this->assertCount(1, $queue->jsonSerialize());
    }

    public function testBreaksIfEmptyStringIsPushed(): void
    {
        $this->expectException(NonEmptyStringException::class);

        $queue = new Queue();
        $queue->push('');
    }

    public function testCanClearQueue(): void
    {
        $queue = new Queue([
            'element1',
            'element2',
            'element3',
        ]);

        $this->assertEquals(3, $queue->count());
        $queue->clear();
        $this->assertEquals(0, $queue->count());
    }

    public function testAllocatedCapacityBehavior(): void
    {
        $queue = new Queue();
        $this->assertEquals(0, $queue->count());
        $this->assertNull($queue->getCapacity());
        $this->assertFalse($queue->hasMaxCapacity());

        $queue->allocateCapacity(2);
        $this->assertTrue($queue->hasMaxCapacity());
        $this->assertEquals(0, $queue->count());
        $this->assertEquals(2, $queue->getCapacity());

        $this->expectException(ParameterOutOfRangeException::class);

        $queue->push('element1');
        $queue->push('element2');
        $queue->push('element3');
    }

    public function testBreaksIfAllocatedCapacityIsNotPositive(): void
    {
        $this->expectException(PositiveIntegerException::class);

        $queue = new Queue();
        $queue->allocateCapacity(-1);
    }

    public function testBreaksIfAllocatedCapacityIsLessThenCount(): void
    {
        $this->expectException(ParameterOutOfRangeException::class);

        $queue = new Queue();
        $queue->push('element1');
        $queue->push('element2');
        $queue->push('element3');

        $queue->allocateCapacity(2);
    }
}
