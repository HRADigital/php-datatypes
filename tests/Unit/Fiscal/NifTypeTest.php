<?php

declare(strict_types=1);

namespace HraDigital\Tests\Datatypes\Unit\Fiscal;

use HraDigital\Datatypes\Fiscal\NifType;
use HraDigital\Tests\Datatypes\AbstractBaseTestCase;

/**
 * NifType Unit testing.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 */
class NifTypeTest extends AbstractBaseTestCase
{
    public function testBackingValues(): void
    {
        $this->assertSame('natural_person', NifType::NATURAL_PERSON->value);
        $this->assertSame('legal_person', NifType::LEGAL_PERSON->value);
    }

    public function testFromValueReturnsCorrectCase(): void
    {
        $this->assertSame(NifType::LEGAL_PERSON, NifType::from('legal_person'));
    }

    public function testHasExactlyTwoCases(): void
    {
        $this->assertCount(2, NifType::cases());
    }
}
