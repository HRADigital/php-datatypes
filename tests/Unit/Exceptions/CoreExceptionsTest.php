<?php

declare(strict_types=1);

namespace HraDigital\Tests\Datatypes\Unit\Exceptions;

use HraDigital\Datatypes\Exceptions\ConflictException;
use HraDigital\Datatypes\Exceptions\DeniedAccessException;
use HraDigital\Datatypes\Exceptions\ExpectationFailedException;
use HraDigital\Datatypes\Exceptions\FailedDependencyException;
use HraDigital\Datatypes\Exceptions\ForbiddenException;
use HraDigital\Datatypes\Exceptions\GoneException;
use HraDigital\Datatypes\Exceptions\MethodNotAllowedException;
use HraDigital\Datatypes\Exceptions\NotAcceptableException;
use HraDigital\Datatypes\Exceptions\NotFoundException;
use HraDigital\Datatypes\Exceptions\PreconditionFailedException;
use HraDigital\Datatypes\Exceptions\PreconditionRequiredException;
use HraDigital\Datatypes\Exceptions\RequestedRangeNotSatisfiableException;
use HraDigital\Datatypes\Exceptions\TooManyRequestsException;
use HraDigital\Datatypes\Exceptions\UnprocessableEntityException;
use HraDigital\Datatypes\Exceptions\UnsupportedMediaTypeException;
use HraDigital\Tests\Datatypes\AbstractBaseTestCase;

/**
 * Unit testing for all base Exception's classes.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
class CoreExceptionsTest extends AbstractBaseTestCase
{
    public function testConflictExceptionIsProperlyInitialized(): void
    {
        $exception = new ConflictException();

        $this->assertGreaterThan(0, \strlen($exception->getMessage()));
        $this->assertEquals(409, $exception->getCode());
    }

    public function testDeniedAccessExceptionIsProperlyInitialized(): void
    {
        $exception = new DeniedAccessException();

        $this->assertGreaterThan(0, \strlen($exception->getMessage()));
        $this->assertEquals(401, $exception->getCode());
    }

    public function testExpectationFailedExceptionIsProperlyInitialized(): void
    {
        $exception = new ExpectationFailedException();

        $this->assertGreaterThan(0, \strlen($exception->getMessage()));
        $this->assertEquals(417, $exception->getCode());
    }

    public function testFailedDependencyExceptionIsProperlyInitialized(): void
    {
        $exception = new FailedDependencyException();

        $this->assertGreaterThan(0, \strlen($exception->getMessage()));
        $this->assertEquals(424, $exception->getCode());
    }

    public function testForbiddenExceptionIsProperlyInitialized(): void
    {
        $exception = new ForbiddenException();

        $this->assertGreaterThan(0, \strlen($exception->getMessage()));
        $this->assertEquals(403, $exception->getCode());
    }

    public function testGoneExceptionIsProperlyInitialized(): void
    {
        $exception = new GoneException();
        $static = GoneException::withId(123);

        $this->assertGreaterThan(0, \strlen($exception->getMessage()));
        $this->assertGreaterThan(0, \strlen($static->getMessage()));
        $this->assertEquals(410, $exception->getCode());
        $this->assertNotEquals($exception->getMessage(), $static->getMessage());
        $this->assertStringContainsString('123', $static->getMessage());
    }

    public function testMethodNotAllowedExceptionIsProperlyInitialized(): void
    {
        $exception = new MethodNotAllowedException();

        $this->assertGreaterThan(0, \strlen($exception->getMessage()));
        $this->assertEquals(405, $exception->getCode());
    }

    public function testNotAcceptableExceptionIsProperlyInitialized(): void
    {
        $exception = new NotAcceptableException();

        $this->assertGreaterThan(0, \strlen($exception->getMessage()));
        $this->assertEquals(406, $exception->getCode());
    }

    public function testNotFoundExceptionIsProperlyInitialized(): void
    {
        $exception = new NotFoundException();
        $static = NotFoundException::withId(12345);

        $this->assertGreaterThan(0, \strlen($exception->getMessage()));
        $this->assertGreaterThan(0, \strlen($static->getMessage()));
        $this->assertEquals(404, $exception->getCode());
        $this->assertNotEquals($exception->getMessage(), $static->getMessage());
        $this->assertStringContainsString('12345', $static->getMessage());
    }

    public function testPreconditionFailedExceptionIsProperlyInitialized(): void
    {
        $exception = new PreconditionFailedException();

        $this->assertGreaterThan(0, \strlen($exception->getMessage()));
        $this->assertEquals(412, $exception->getCode());
    }

    public function testPreconditionRequiredExceptionIsProperlyInitialized(): void
    {
        $exception = new PreconditionRequiredException();

        $this->assertGreaterThan(0, \strlen($exception->getMessage()));
        $this->assertEquals(428, $exception->getCode());
    }

    public function testRequestedRangeNotSatisfiableExceptionIsProperlyInitialized(): void
    {
        $exception = new RequestedRangeNotSatisfiableException();

        $this->assertGreaterThan(0, \strlen($exception->getMessage()));
        $this->assertEquals(416, $exception->getCode());
    }

    public function testTooManyRequestsExceptionIsProperlyInitialized(): void
    {
        $exception = new TooManyRequestsException();

        $this->assertGreaterThan(0, \strlen($exception->getMessage()));
        $this->assertEquals(429, $exception->getCode());
    }

    public function testUnprocessableEntityExceptionIsProperlyInitialized(): void
    {
        $exception = new UnprocessableEntityException();
        $static = UnprocessableEntityException::withName('SomeField');

        $this->assertGreaterThan(0, \strlen($exception->getMessage()));
        $this->assertGreaterThan(0, \strlen($static->getMessage()));
        $this->assertEquals(422, $exception->getCode());
        $this->assertNotEquals($exception->getMessage(), $static->getMessage());
        $this->assertStringContainsString('SomeField', $static->getMessage());
    }

    public function testUnsupportedMediaTypeExceptionIsProperlyInitialized(): void
    {
        $exception = new UnsupportedMediaTypeException();
        $static = UnsupportedMediaTypeException::withName('MediaType');

        $this->assertGreaterThan(0, \strlen($exception->getMessage()));
        $this->assertGreaterThan(0, \strlen($static->getMessage()));
        $this->assertEquals(415, $exception->getCode());
        $this->assertNotEquals($exception->getMessage(), $static->getMessage());
        $this->assertStringContainsString('MediaType', $static->getMessage());
    }
}
