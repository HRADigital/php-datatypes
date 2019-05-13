<?php
namespace Hradigital\Tests\Datatypes\Unit\Scalar;

use Hradigital\Datatypes\Scalar\AbstractReadFloat;
use Hradigital\Datatypes\Scalar\ReadonlyFloat;
use Hradigital\Datatypes\Scalar\ReadonlyInteger;
use Hradigital\Datatypes\Scalar\ReadonlyString;
use Hradigital\Tests\Datatypes\AbstractBaseTestCase;

/**
 * Readonly Float Unit testing.
 *
 * @package   Hradigital\Datatypes
 * @copyright Hugo Rafael Azevedo <github@hradigital.com>
 * @author    Hugo Rafael Azevedo <github@hradigital.com>
 * @license   MIT
 * @since     1.0.0
 */
class ReadonlyFloatTest extends AbstractBaseTestCase
{
    /**
     * Performs various shared instance's tests.
     *
     * @param  AbstractReadFloat $instance - Instance to perform tests on.
     *
     * @since  1.0.0
     * @return void
     */
    protected function instanceChecks(AbstractReadFloat $instance): void
    {
        $this->assertInstanceOf(
            ReadonlyFloat::class,
            $instance,
            "Loaded instance doesn't seam to be from a ReadonlyFloat type."
        );
    }

    /**
     * Assert can collect maximum and minimum values.
     *
     * @since  1.0.0
     * @return void
     */
    public function testCanRetrieveMaximumAndMinimumAllowedValues(): void
    {
        $this->assertEquals(
            PHP_FLOAT_MAX,
            ReadonlyFloat::max(),
            'Values do not match.'
        );
        $this->assertEquals(
            PHP_FLOAT_MIN,
            ReadonlyFloat::min(),
            'Values do not match.'
        );
    }

    /**
     * Tests that a filled float can be loaded successfully.
     *
     * @since  1.0.0
     * @return void
     */
    public function testCanSuccessfullyLoadFilledFloat(): void
    {
        // Performs test.
        $test  = 123.0;
        $value = ReadonlyFloat::fromFloat($test);

        // Performs assertions.
        $this->assertEquals(
            $test,
            \intval($value->__toString()),
            'Float value does not seam to match.'
        );
        $this->instanceChecks($value);
    }

    /**
     * Tests that a filled string can be loaded successfully.
     *
     * @since  1.0.0
     * @return void
     */
    public function testCanSuccessfullyLoadFilledString(): void
    {
        // Performs test.
        $test  = "123.1";
        $value = ReadonlyFloat::fromString($test);

        // Performs assertions.
        $this->assertEquals(
            $test,
            $value->__toString(),
            'Float value does not seam to match.'
        );
        $this->instanceChecks($value);
    }

    /**
     * Tests that an empty string cannot be loaded successfully.
     *
     * @since  1.0.0
     * @return void
     */
    public function testCanNotLoadSuccessfullyEmptyString(): void
    {
        // Creates expectation.
        $this->expectException(\InvalidArgumentException::class);

        // Performs test.
        ReadonlyFloat::fromString("");
    }

    /**
     * Tests can perform comparisons.
     *
     * @since  1.0.0
     * @return void
     */
    public function testCanCompareTwoEqualInstances(): void
    {
        // Performs test.
        $test  = 123.0;
        $value = ReadonlyFloat::fromFloat($test);

        // Performs assertions.
        $this->assertTrue(
            $value->equals(ReadonlyFloat::fromFloat($test)),
            'Float values should have been equal.'
        );
        $this->instanceChecks($value);
    }

    /**
     * Tests can perform comparisons.
     *
     * @since  1.0.0
     * @return void
     */
    public function testCanCompareTwoUnequalInstances(): void
    {
        // Performs test.
        $test  = 123.0;
        $value = ReadonlyFloat::fromFloat($test);

        // Performs assertions.
        $this->assertFalse(
            $value->equals(ReadonlyFloat::fromFloat(++$test)),
            'Float values should be unequal.'
        );
        $this->instanceChecks($value);
    }

    /**
     * Tests can perform comparisons.
     *
     * @since  1.0.0
     * @return void
     */
    public function testCanCompareTwoEqualValues(): void
    {
        // Performs test.
        $test  = 123.0;
        $value = ReadonlyFloat::fromFloat($test);

        // Performs assertions.
        $this->assertTrue(
            $value->equalsNative($test),
            'Float values should have been equal.'
        );
        $this->instanceChecks($value);
    }

    /**
     * Tests can perform comparisons.
     *
     * @since  1.0.0
     * @return void
     */
    public function testCanCompareTwoUnequalValues(): void
    {
        // Performs test.
        $test  = 123.0;
        $value = ReadonlyFloat::fromFloat($test);

        // Performs assertions.
        $this->assertFalse(
            $value->equalsNative(++$test),
            'Float values should be unequal.'
        );
        $this->instanceChecks($value);
    }

    /**
     * Tests can perform comparisons.
     *
     * @since  1.0.0
     * @return void
     */
    public function testCanValidateIsBiggerInstance(): void
    {
        // Performs test.
        $test  = 123.0;
        $value = ReadonlyFloat::fromFloat($test);

        // Performs assertions.
        $this->assertTrue(
            $value->isBigger(ReadonlyFloat::fromFloat(--$test)),
            'Float should have been bigger.'
        );
        $this->instanceChecks($value);
    }

    /**
     * Tests can perform comparisons.
     *
     * @since  1.0.0
     * @return void
     */
    public function testCanValidateIsBiggerValue(): void
    {
        // Performs test.
        $test  = 123.0;
        $value = ReadonlyFloat::fromFloat($test);

        // Performs assertions.
        $this->assertTrue(
            $value->isBiggerNative(--$test),
            'Float should have been bigger.'
        );
        $this->instanceChecks($value);
    }

    /**
     * Tests can perform comparisons.
     *
     * @since  1.0.0
     * @return void
     */
    public function testCanValidateIsNotBiggerInstance(): void
    {
        // Performs test.
        $test  = 123.0;
        $value = ReadonlyFloat::fromFloat($test);

        // Performs assertions.
        $this->assertFalse(
            $value->isBigger(ReadonlyFloat::fromFloat(++$test)),
            'Float should have been smaller.'
        );
        $this->instanceChecks($value);
    }

    /**
     * Tests can perform comparisons.
     *
     * @since  1.0.0
     * @return void
     */
    public function testCanValidateIsNotBiggerValue(): void
    {
        // Performs test.
        $test  = 123.0;
        $value = ReadonlyFloat::fromFloat($test);

        // Performs assertions.
        $this->assertFalse(
            $value->isBiggerNative($test),
            'Float should have been smaller.'
        );
        $this->instanceChecks($value);
    }

    /**
     * Tests can perform comparisons.
     *
     * @since  1.0.0
     * @return void
     */
    public function testCanValidateIsSmallerInstance(): void
    {
        // Performs test.
        $test  = 123.0;
        $value = ReadonlyFloat::fromFloat($test);

        // Performs assertions.
        $this->assertTrue(
            $value->isSmaller(ReadonlyFloat::fromFloat(++$test)),
            'Float should have been smaller.'
        );
        $this->instanceChecks($value);
    }

    /**
     * Tests can perform comparisons.
     *
     * @since  1.0.0
     * @return void
     */
    public function testCanValidateIsSmallerValue(): void
    {
        // Performs test.
        $test  = 123.0;
        $value = ReadonlyFloat::fromFloat($test);

        // Performs assertions.
        $this->assertTrue(
            $value->isSmallerNative(++$test),
            'Float should have been smaller.'
        );
        $this->instanceChecks($value);
    }

    /**
     * Tests can perform comparisons.
     *
     * @since  1.0.0
     * @return void
     */
    public function testCanValidateIsNotSmallerInstance(): void
    {
        // Performs test.
        $test  = 123.0;
        $value = ReadonlyFloat::fromFloat($test);

        // Performs assertions.
        $this->assertFalse(
            $value->isSmaller(ReadonlyFloat::fromFloat(--$test)),
            'Float should have been smaller.'
        );
        $this->instanceChecks($value);
    }

    /**
     * Tests can perform comparisons.
     *
     * @since  1.0.0
     * @return void
     */
    public function testCanValidateIsNotSmallerValue(): void
    {
        // Performs test.
        $test  = 123.0;
        $value = ReadonlyFloat::fromFloat($test);

        // Performs assertions.
        $this->assertFalse(
            $value->isSmallerNative($test),
            'Float should have been smaller.'
        );
        $this->instanceChecks($value);
    }

    /**
     * Tests can identify positive and negative integers.
     *
     * @since  1.0.0
     * @return void
     */
    public function testCanValidateNegativeValue(): void
    {
        // Performs test.
        $test  = -123.0;
        $value = ReadonlyFloat::fromFloat($test);

        // Performs assertions.
        $this->assertTrue(
            $value->isNegative(),
            'Float should have been negative.'
        );
        $this->instanceChecks($value);
    }

    /**
     * Tests can identify positive and negative integers.
     *
     * @since  1.0.0
     * @return void
     */
    public function testCanValidatePositiveValue(): void
    {
        // Performs test.
        $test  = 123.0;
        $value = ReadonlyFloat::fromFloat($test);

        // Performs assertions.
        $this->assertFalse(
            $value->isNegative(),
            'Float should have been positive.'
        );
        $this->instanceChecks($value);
    }

    /**
     * Tests the integer can be correctly formatted.
     *
     * @since  1.0.0
     * @return void
     */
    public function testCanFormatFloat(): void
    {
        // Performs test.
        $value = ReadonlyFloat::fromString("1234560.1");
        $text  = $value->format(
            \NumberFormatter::create('en_US', \NumberFormatter::DECIMAL)
        );

        // Performs assertions.
        $this->assertEquals(
            "1,234,560.1",
            $text->__toString(),
            "The float wasn't formatted correctly."
        );
        $this->assertInstanceOf(
            ReadonlyString::class,
            $text,
            "Returned instance should have been of type ReadonlyString."
        );
    }

    /**
     * Tests the integer can be converted to a string.
     *
     * @since  1.0.0
     * @return void
     */
    public function testCanConvertToString(): void
    {
        // Performs test.
        $value  = ReadonlyFloat::fromString("123456.1");
        $string = $value->toString();

        // Performs assertions.
        $this->assertEquals(
            "123456.1",
            $string->__toString(),
            "The float wasn't converted to string correctly."
        );
        $this->assertInstanceOf(
            ReadonlyString::class,
            $string,
            "Returned instance should have been of type ReadonlyString."
        );
    }

    /**
     * Tests the integer can be converted to a float.
     *
     * @since  1.0.0
     * @return void
     */
    public function testCanConvertToInteger(): void
    {
        // Performs test.
        $value   = ReadonlyFloat::fromString("123456.0");
        $integer = $value->toInteger();

        // Performs assertions.
        $this->assertEquals(
            "123456",
            $integer->__toString(),
            "The float wasn't converted to integer correctly."
        );
        $this->assertInstanceOf(
            ReadonlyInteger::class,
            $integer,
            "Returned instance should have been of type ReadonlyInteger."
        );
    }
}
