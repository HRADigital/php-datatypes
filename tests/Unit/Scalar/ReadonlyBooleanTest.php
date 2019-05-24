<?php
namespace Hradigital\Tests\Datatypes\Unit\Scalar;

use Hradigital\Datatypes\Scalar\AbstractReadBoolean;
use Hradigital\Datatypes\Scalar\ReadonlyBoolean;
use Hradigital\Tests\Datatypes\AbstractBaseTestCase;

/**
 * Readonly Boolean Unit testing.
 *
 * @package   Hradigital\Datatypes
 * @copyright Hugo Rafael Azevedo <github@hradigital.com>
 * @author    Hugo Rafael Azevedo <github@hradigital.com>
 * @license   MIT
 * @since     1.0.0
 */
class ReadonlyBooleanTest extends AbstractBaseTestCase
{
    /**
     * Performs various shared instance's tests.
     *
     * @param  AbstractReadBoolean $instance - Instance to perform tests on.
     *
     * @since  1.0.0
     * @return void
     */
    protected function instanceChecks(AbstractReadBoolean $instance): void
    {
        $this->assertInstanceOf(
            ReadonlyBoolean::class,
            $instance,
            "Loaded instance doesn't seam to be from a ReadonlyBoolean type."
        );
    }

    /**
     * Tests loading from an empty string breaks.
     *
     * @since  1.0.0
     * @return void
     */
    public function testBreaksIfLoadedWithEmptyString(): void
    {
        // Creates expectation.
        $this->expectException(\InvalidArgumentException::class);

        // Performs test.
        ReadonlyBoolean::fromString('');
    }

    /**
     * Tests that a filled boolean can be loaded successfully.
     *
     * @since  1.0.0
     * @return void
     */
    public function testCanSuccessfullyLoadPositiveFloat(): void
    {
        // Performs test.
        $value = ReadonlyBoolean::fromFloat(1.0);

        // Performs assertions.
        $this->assertEquals(
            'True',
            $value->toString(),
            'Boolean value does not seam to match.'
        );
        $this->instanceChecks($value);
    }

    /**
     * Tests that a filled boolean can be loaded successfully.
     *
     * @since  1.0.0
     * @return void
     */
    public function testCanSuccessfullyLoadNegativeFloat(): void
    {
        // Performs test.
        $test  = -1;
        $value = ReadonlyBoolean::fromFloat($test);

        // Performs assertions.
        $this->assertEquals(
            'False',
            $value->toString(),
            'Boolean value does not seam to match.'
        );
        $this->instanceChecks($value);
    }

    /**
     * Tests that Yes/No strings can be loaded as booleans.
     *
     * @since  1.0.0
     * @return void
     */
    public function testCanSuccessfullyLoadYesNoString(): void
    {
        // Perform test.
        $yes = ReadonlyBoolean::fromString('Yes');
        $no  = ReadonlyBoolean::fromString('No');

        // Performs assertions.
        $this->assertEquals(
            'True',
            $yes->toString(),
            'Boolean value does not seam to match.'
        );
        $this->assertEquals(
            'False',
            $no->toString(),
            'Boolean value does not seam to match.'
        );
        $this->instanceChecks($yes);
        $this->instanceChecks($no);
    }

    /**
     * Tests that True/False strings can be loaded as booleans.
     *
     * @since  1.0.0
     * @return void
     */
    public function testCanSuccessfullyLoadTrueFalseString(): void
    {
        // Perform test.
        $true  = ReadonlyBoolean::fromString('True');
        $false = ReadonlyBoolean::fromString('False');

        // Performs assertions.
        $this->assertEquals(
            'True',
            $true->toString(),
            'Boolean value does not seam to match.'
        );
        $this->assertEquals(
            'False',
            $false->toString(),
            'Boolean value does not seam to match.'
        );
        $this->instanceChecks($true);
        $this->instanceChecks($false);
    }

    /**
     * Tests that 1/0 strings can be loaded as booleans.
     *
     * @since  1.0.0
     * @return void
     */
    public function testCanSuccessfullyLoadOneZeroStrings(): void
    {
        // Perform test.
        $one  = ReadonlyBoolean::fromString('1');
        $zero = ReadonlyBoolean::fromString('0');

        // Performs assertions.
        $this->assertEquals(
            'True',
            $one->toString(),
            'Boolean value does not seam to match.'
        );
        $this->assertEquals(
            'False',
            $zero->toString(),
            'Boolean value does not seam to match.'
        );
        $this->instanceChecks($one);
        $this->instanceChecks($zero);
    }

    /**
     * Tests that 1/0 integers can be loaded as booleans.
     *
     * @since  1.0.0
     * @return void
     */
    public function testCanSuccessfullyLoadOneZeroIntegers(): void
    {
        // Perform test.
        $one  = ReadonlyBoolean::fromInteger(1);
        $zero = ReadonlyBoolean::fromInteger(0);

        // Performs assertions.
        $this->assertEquals(
            'True',
            $one->toString(),
            'Boolean value does not seam to match.'
        );
        $this->assertEquals(
            'False',
            $zero->toString(),
            'Boolean value does not seam to match.'
        );
        $this->instanceChecks($one);
        $this->instanceChecks($zero);
    }

    /**
     * Tests the integer can be converted to a float.
     *
     * @since  1.0.0
     * @return void
     */
    public function testCanConvertToInteger(): void
    {
        // Perform test.
        $one  = ReadonlyBoolean::fromString('1');
        $zero = ReadonlyBoolean::fromString('0');

        // Performs assertions.
        $this->assertEquals(
            '1',
            $one->toInteger()->toString(),
            'Boolean value does not seam to match.'
        );
        $this->assertEquals(
            '0',
            $zero->toInteger()->toString(),
            'Boolean value does not seam to match.'
        );
        $this->instanceChecks($one);
        $this->instanceChecks($zero);
    }

    /**
     * Tests that can be successfully converted to a String.
     *
     * @since  1.0.0
     * @return void
     */
    public function testCanSuccessfullyEchoToString(): void
    {
        // Perform test.
        $true = ReadonlyBoolean::fromString('True');

        // Performs assertions.
        $this->assertEquals(
            'True',
            $true->toString(),
            'Boolean value does not seam to match.'
        );
        $this->assertEquals(
            'true',
            $true->__toString(),
            'Boolean value does not seam to match.'
        );
        $this->instanceChecks($true);
    }

    /**
     * Tests that instances can be compared.
     *
     * @since  1.0.0
     * @return void
     */
    public function testCanCompareEqualInstances(): void
    {
        // Perform test.
        $string = ReadonlyBoolean::fromString('True');
        $number = ReadonlyBoolean::fromString('1');

        // Performs assertions.
        $this->assertTrue(
            $string->equals($number),
            'Boolean value does not seam to match.'
        );
        $this->instanceChecks($string);
        $this->instanceChecks($number);
    }

    /**
     * Tests that instances can be compared.
     *
     * @since  1.0.0
     * @return void
     */
    public function testCanCompareUnequalInstances(): void
    {
        // Perform test.
        $string = ReadonlyBoolean::fromString('True');
        $number = ReadonlyBoolean::fromString('False');

        // Performs assertions.
        $this->assertFalse(
            $string->equals($number),
            'Boolean values seam to match.'
        );
        $this->instanceChecks($string);
        $this->instanceChecks($number);
    }

    /**
     * Tests that instances can be compared.
     *
     * @since  1.0.0
     * @return void
     */
    public function testCanCompareEqualNatives(): void
    {
        // Perform test.
        $string = ReadonlyBoolean::fromString('True');
        $native = true;

        // Performs assertions.
        $this->assertTrue(
            $string->equalsNative($native),
            'Boolean value does not seam to match.'
        );
        $this->instanceChecks($string);
    }

    /**
     * Tests that instances can be compared.
     *
     * @since  1.0.0
     * @return void
     */
    public function testCanCompareUnequalNatives(): void
    {
        // Perform test.
        $string = ReadonlyBoolean::fromString('True');
        $native = false;

        // Performs assertions.
        $this->assertFalse(
            $string->equalsNative($native),
            'Boolean values seam to match.'
        );
        $this->instanceChecks($string);
    }
}
