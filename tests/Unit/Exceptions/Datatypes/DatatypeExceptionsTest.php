<?php

declare(strict_types=1);

namespace HraDigital\Tests\Datatypes\Unit\Exceptions\Datatypes;

use HraDigital\Datatypes\Exceptions\Datatypes\InvalidDateIntervalException;
use HraDigital\Datatypes\Exceptions\Datatypes\InvalidEmailException;
use HraDigital\Datatypes\Exceptions\Datatypes\InvalidStringLengthException;
use HraDigital\Datatypes\Exceptions\Datatypes\NonEmptyStringException;
use HraDigital\Datatypes\Exceptions\Datatypes\NonNegativeNumberException;
use HraDigital\Datatypes\Exceptions\Datatypes\ParameterOutOfRangeException;
use HraDigital\Datatypes\Exceptions\Datatypes\PositiveIntegerException;
use HraDigital\Tests\Datatypes\AbstractBaseTestCase;

/**
 * Unit testing for all Datatype base Exception's classes.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
class DatatypeExceptionsTest extends AbstractBaseTestCase
{
    public function testInvalidDateIntervalExceptionIsProperlyInitialized(): void
    {
        $exception = new InvalidDateIntervalException();
        $static = InvalidDateIntervalException::withName('SomeField');

        $this->assertGreaterThan(0, \strlen($exception->getMessage()));
        $this->assertGreaterThan(0, \strlen($static->getMessage()));
        $this->assertEquals(422, $exception->getCode());
        $this->assertNotEquals($exception->getMessage(), $static->getMessage());
        $this->assertStringContainsString('SomeField', $static->getMessage());
    }

    public function testInvalidEmailExceptionIsProperlyInitialized(): void
    {
        $exception = new InvalidEmailException();
        $static = InvalidEmailException::withName('SomeField');

        $this->assertGreaterThan(0, \strlen($exception->getMessage()));
        $this->assertGreaterThan(0, \strlen($static->getMessage()));
        $this->assertEquals(422, $exception->getCode());
        $this->assertNotEquals($exception->getMessage(), $static->getMessage());
        $this->assertStringContainsString('SomeField', $static->getMessage());
    }

    public function testInvalidStringLengthExceptionIsProperlyInitialized(): void
    {
        $exception = new InvalidStringLengthException();
        $static = InvalidStringLengthException::withName('SomeField');
        $staticWithLength = InvalidStringLengthException::withNameAndLength('SomeField', 150);

        $this->assertGreaterThan(0, \strlen($exception->getMessage()));
        $this->assertGreaterThan(0, \strlen($static->getMessage()));
        $this->assertGreaterThan(0, \strlen($staticWithLength->getMessage()));
        $this->assertEquals(422, $exception->getCode());
        $this->assertNotEquals($exception->getMessage(), $static->getMessage());
        $this->assertNotEquals($exception->getMessage(), $staticWithLength->getMessage());
        $this->assertNotEquals($static->getMessage(), $staticWithLength->getMessage());
        $this->assertStringContainsString('SomeField', $static->getMessage());
        $this->assertStringContainsString('SomeField', $staticWithLength->getMessage());
        $this->assertStringContainsString('150', $staticWithLength->getMessage());
    }

    public function testNonEmptyStringExceptionIsProperlyInitialized(): void
    {
        $exception = new NonEmptyStringException();
        $static = NonEmptyStringException::withName('SomeField');

        $this->assertGreaterThan(0, \strlen($exception->getMessage()));
        $this->assertGreaterThan(0, \strlen($static->getMessage()));
        $this->assertEquals(422, $exception->getCode());
        $this->assertNotEquals($exception->getMessage(), $static->getMessage());
        $this->assertStringContainsString('SomeField', $static->getMessage());
    }

    public function testNonNegativeNumberExceptionIsProperlyInitialized(): void
    {
        $exception = new NonNegativeNumberException();
        $static = NonNegativeNumberException::withName('SomeField');

        $this->assertGreaterThan(0, \strlen($exception->getMessage()));
        $this->assertGreaterThan(0, \strlen($static->getMessage()));
        $this->assertEquals(422, $exception->getCode());
        $this->assertNotEquals($exception->getMessage(), $static->getMessage());
        $this->assertStringContainsString('SomeField', $static->getMessage());
    }

    public function testParameterOutOfRangeExceptionIsProperlyInitialized(): void
    {
        $exception = new ParameterOutOfRangeException();
        $static = ParameterOutOfRangeException::withName('SomeField');

        $this->assertGreaterThan(0, \strlen($exception->getMessage()));
        $this->assertGreaterThan(0, \strlen($static->getMessage()));
        $this->assertEquals(422, $exception->getCode());
        $this->assertNotEquals($exception->getMessage(), $static->getMessage());
        $this->assertStringContainsString('SomeField', $static->getMessage());
    }

    public function testPositiveIntegerExceptionIsProperlyInitialized(): void
    {
        $exception = new PositiveIntegerException();
        $static = PositiveIntegerException::withName('SomeField');

        $this->assertGreaterThan(0, \strlen($exception->getMessage()));
        $this->assertGreaterThan(0, \strlen($static->getMessage()));
        $this->assertEquals(422, $exception->getCode());
        $this->assertNotEquals($exception->getMessage(), $static->getMessage());
        $this->assertStringContainsString('SomeField', $static->getMessage());
    }
}
