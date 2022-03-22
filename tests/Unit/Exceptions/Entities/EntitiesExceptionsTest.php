<?php

declare(strict_types=1);

namespace HraDigital\Tests\Datatypes\Unit\Exceptions\Entities;

use HraDigital\Datatypes\Exceptions\Entities\RequiredEntityValueMissingException;
use HraDigital\Datatypes\Exceptions\Entities\UnexpectedEntityValueException;
use HraDigital\Tests\Datatypes\AbstractBaseTestCase;

/**
 * Unit testing for all Entity's base Exception classes.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
class EntitiesExceptionsTest extends AbstractBaseTestCase
{
    public function testRequiredEntityValueMissingExceptionIsProperlyInitialized(): void
    {
        $exception = new RequiredEntityValueMissingException();
        $static = RequiredEntityValueMissingException::withName('SomeField');

        $this->assertGreaterThan(0, \strlen($exception->getMessage()));
        $this->assertGreaterThan(0, \strlen($static->getMessage()));
        $this->assertEquals(422, $exception->getCode());
        $this->assertNotEquals($exception->getMessage(), $static->getMessage());
        $this->assertStringContainsString('SomeField', $static->getMessage());
    }

    public function testUnexpectedEntityValueExceptionIsProperlyInitialized(): void
    {
        $exception = new UnexpectedEntityValueException();
        $static = UnexpectedEntityValueException::withName('SomeField');

        $this->assertGreaterThan(0, \strlen($exception->getMessage()));
        $this->assertGreaterThan(0, \strlen($static->getMessage()));
        $this->assertEquals(422, $exception->getCode());
        $this->assertNotEquals($exception->getMessage(), $static->getMessage());
        $this->assertStringContainsString('SomeField', $static->getMessage());
    }
}
