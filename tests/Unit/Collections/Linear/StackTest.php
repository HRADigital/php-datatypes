<?php

declare(strict_types=1);

namespace Hradigital\Tests\Datatypes\Unit\Collections\Linear;

use HraDigital\Datatypes\Collections\Linear\Stack;
use HraDigital\Datatypes\Exceptions\Datatypes\NonEmptyStringException;
use HraDigital\Datatypes\Exceptions\Datatypes\ParameterOutOfRangeException;
use HraDigital\Datatypes\Exceptions\Datatypes\PositiveIntegerException;
use HraDigital\Tests\Datatypes\AbstractBaseTestCase;

/**
 * Stack's Unit testing.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
class StackTest extends AbstractBaseTestCase
{
    public function testCanLoadInstanceCorrectlyAndCopyIt(): void
    {
        $stack = new Stack();
        $newStack = $stack->clone();

        $this->assertEquals(0, $stack->count());
        $this->assertTrue($stack->isEmpty());

        $this->assertEquals(0, $newStack->count());
        $this->assertTrue($newStack->isEmpty());

        $this->assertFalse($stack === $newStack);
        $this->assertNull($stack->peek());
        $this->assertNull($stack->pop());
        $this->assertNull($stack->getCapacity());
        $this->assertFalse($stack->hasMaxCapacity());
    }

    public function testCanPushPeekAndPopElements(): void
    {
        $element1 = 'element1';
        $element2 = 'element2';
        $element3 = 'element3';

        $stack = new Stack([
            $element1,
            $element2,
        ]);

        $this->assertEquals(2, $stack->count());
        $this->assertEquals($element2, (string) $stack->peek());
        $this->assertFalse($stack->isEmpty());

        $stack->push($element3);
        $this->assertEquals(3, $stack->count());
        $this->assertEquals($element3, (string) $stack->peek());

        $popElement3 = $stack->pop();
        $this->assertEquals($element3, (string) $popElement3);
        $popElement2 = $stack->pop();
        $this->assertEquals($element2, (string) $popElement2);
        $this->assertEquals(1, $stack->count());
        $this->assertCount(1, $stack->jsonSerialize());
    }

    public function testBreaksIfEmptyStringIsPushed(): void
    {
        $this->expectException(NonEmptyStringException::class);

        $stack = new Stack();
        $stack->push('');
    }

    public function testCanClearStack(): void
    {
        $stack = new Stack([
            'element1',
            'element2',
            'element3',
        ]);

        $this->assertEquals(3, $stack->count());
        $stack->clear();
        $this->assertEquals(0, $stack->count());
    }

    public function testAllocatedCapacityBehavior(): void
    {
        $stack = new Stack();
        $this->assertEquals(0, $stack->count());
        $this->assertNull($stack->getCapacity());
        $this->assertFalse($stack->hasMaxCapacity());

        $stack->allocateCapacity(2);
        $this->assertTrue($stack->hasMaxCapacity());
        $this->assertEquals(0, $stack->count());
        $this->assertEquals(2, $stack->getCapacity());

        $this->expectException(ParameterOutOfRangeException::class);

        $stack->push('element1');
        $stack->push('element2');
        $stack->push('element3');
    }

    public function testBreaksIfAllocatedCapacityIsNotPositive(): void
    {
        $this->expectException(PositiveIntegerException::class);

        $queue = new Stack();
        $queue->allocateCapacity(-1);
    }

    public function testBreaksIfAllocatedCapacityIsLessThenCount(): void
    {
        $this->expectException(ParameterOutOfRangeException::class);

        $queue = new Stack();
        $queue->push('element1');
        $queue->push('element2');
        $queue->push('element3');

        $queue->allocateCapacity(2);
    }
}
