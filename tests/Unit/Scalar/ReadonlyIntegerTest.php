<?php
namespace Hradigital\Tests\Datatypes\Unit\Scalar;

use Hradigital\Datatypes\Scalar\AbstractReadInteger;
use Hradigital\Datatypes\Scalar\ReadonlyFloat;
use Hradigital\Datatypes\Scalar\ReadonlyInteger;
use Hradigital\Datatypes\Scalar\ReadonlyString;
use Hradigital\Tests\Datatypes\AbstractBaseTestCase;
use Hradigital\Datatypes\Scalar\ReadonlyBoolean;

/**
 * Readonly Integer Unit testing.
 *
 * @package   Hradigital\Datatypes
 * @copyright Hugo Rafael Azevedo <github@hradigital.com>
 * @author    Hugo Rafael Azevedo <github@hradigital.com>
 * @license   MIT
 * @since     1.0.0
 */
class ReadonlyIntegerTest extends AbstractBaseTestCase
{
    /**
     * Performs various shared instance's tests.
     *
     * @param  AbstractReadInteger $instance - Instance to perform tests on.
     *
     * @since  1.0.0
     * @return void
     */
    protected function instanceChecks(AbstractReadInteger $instance): void
    {
        $this->assertInstanceOf(
            ReadonlyInteger::class,
            $instance,
            "Loaded instance doesn't seam to be from a ReadonlyInteger type."
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
            PHP_INT_MAX,
            ReadonlyInteger::max(),
            'Values do not match.'
        );
        $this->assertEquals(
            PHP_INT_MIN,
            ReadonlyInteger::min(),
            'Values do not match.'
        );
    }

    /**
     * Tests that a filled integer can be loaded successfully.
     *
     * @since  1.0.0
     * @return void
     */
    public function testCanSuccessfullyLoadFilledInteger(): void
    {
        // Performs test.
        $test  = 123;
        $value = ReadonlyInteger::fromInteger($test);

        // Performs assertions.
        $this->assertEquals(
            $test,
            \intval($value->__toString()),
            'Integer value does not seam to match.'
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
        $test  = "123";
        $value = ReadonlyInteger::fromString($test);

        // Performs assertions.
        $this->assertEquals(
            $test,
            $value->__toString(),
            'Integer value does not seam to match.'
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
        ReadonlyInteger::fromString("");
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
        $test  = 123;
        $value = ReadonlyInteger::fromInteger($test);

        // Performs assertions.
        $this->assertTrue(
            $value->equals(ReadonlyInteger::fromInteger($test)),
            'Integer values should have been equal.'
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
        $test  = 123;
        $value = ReadonlyInteger::fromInteger($test);

        // Performs assertions.
        $this->assertFalse(
            $value->equals(ReadonlyInteger::fromInteger(++$test)),
            'Integer values should be unequal.'
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
        $test  = 123;
        $value = ReadonlyInteger::fromInteger($test);

        // Performs assertions.
        $this->assertTrue(
            $value->equalsNative($test),
            'Integer values should have been equal.'
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
        $test  = 123;
        $value = ReadonlyInteger::fromInteger($test);

        // Performs assertions.
        $this->assertFalse(
            $value->equalsNative(++$test),
            'Integer values should be unequal.'
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
        $test  = 123;
        $value = ReadonlyInteger::fromInteger($test);

        // Performs assertions.
        $this->assertTrue(
            $value->isBigger(ReadonlyInteger::fromInteger(--$test)),
            'Integer should have been bigger.'
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
        $test  = 123;
        $value = ReadonlyInteger::fromInteger($test);

        // Performs assertions.
        $this->assertTrue(
            $value->isBiggerNative(--$test),
            'Integer should have been bigger.'
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
        $test  = 123;
        $value = ReadonlyInteger::fromInteger($test);

        // Performs assertions.
        $this->assertFalse(
            $value->isBigger(ReadonlyInteger::fromInteger(++$test)),
            'Integer should have been smaller.'
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
        $test  = 123;
        $value = ReadonlyInteger::fromInteger($test);

        // Performs assertions.
        $this->assertFalse(
            $value->isBiggerNative($test),
            'Integer should have been smaller.'
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
        $test  = 123;
        $value = ReadonlyInteger::fromInteger($test);

        // Performs assertions.
        $this->assertTrue(
            $value->isSmaller(ReadonlyInteger::fromInteger(++$test)),
            'Integer should have been smaller.'
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
        $test  = 123;
        $value = ReadonlyInteger::fromInteger($test);

        // Performs assertions.
        $this->assertTrue(
            $value->isSmallerNative(++$test),
            'Integer should have been smaller.'
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
        $test  = 123;
        $value = ReadonlyInteger::fromInteger($test);

        // Performs assertions.
        $this->assertFalse(
            $value->isSmaller(ReadonlyInteger::fromInteger(--$test)),
            'Integer should have been smaller.'
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
        $test  = 123;
        $value = ReadonlyInteger::fromInteger($test);

        // Performs assertions.
        $this->assertFalse(
            $value->isSmallerNative($test),
            'Integer should have been smaller.'
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
        $test  = -123;
        $value = ReadonlyInteger::fromInteger($test);

        // Performs assertions.
        $this->assertTrue(
            $value->isNegative(),
            'Integer should have been negative.'
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
        $test  = 123;
        $value = ReadonlyInteger::fromInteger($test);

        // Performs assertions.
        $this->assertFalse(
            $value->isNegative(),
            'Integer should have been positive.'
        );
        $this->instanceChecks($value);
    }

    /**
     * Tests the integer can be correctly formatted.
     *
     * @since  1.0.0
     * @return void
     */
    public function testCanFormatAnInteger(): void
    {
        // Performs test.
        $value = ReadonlyInteger::fromString("123456");
        $text  = $value->format(\NumberFormatter::create('en_US', \NumberFormatter::DEFAULT_STYLE));

        // Performs assertions.
        $this->assertEquals(
            "123,456",
            $text->__toString(),
            "The integer wasn't formatted correctly."
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
        $value  = ReadonlyInteger::fromString("123456");
        $string = $value->toString();

        // Performs assertions.
        $this->assertEquals(
            "123456",
            $string->__toString(),
            "The integer wasn't converted to string correctly."
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
    public function testCanConvertToFloat(): void
    {
        // Performs test.
        $value = ReadonlyInteger::fromString("123456");
        $float = $value->toFloat();

        // Performs assertions.
        $this->assertEquals(
            123456.0,
            $float->value(),
            "The integer wasn't converted to float correctly."
        );
        $this->assertInstanceOf(
            ReadonlyFloat::class,
            $float,
            "Returned instance should have been of type ReadonlyFloat."
        );
    }

    /**
     * Tests that the instance can be converted to a Boolean.
     *
     * @since  1.0.0
     * @return void
     */
    public function testCanConvertInstanceToBoolean(): void
    {
        // Performs test.
        $true  = ReadonlyInteger::fromInteger(123);
        $false = ReadonlyInteger::fromInteger(0);
        $trueBoolean  = $true->toBoolean();
        $falseBoolean = $false->toBoolean();

        // Performs assertions.
        $this->assertInstanceOf(
            ReadonlyBoolean::class,
            $trueBoolean,
            'Instance type, does not match ReadonlyBoolean.'
        );
        $this->assertEquals(
            'True',
            $trueBoolean->toString(),
            'Instance value is not correct.'
        );
        $this->assertInstanceOf(
            ReadonlyBoolean::class,
            $falseBoolean,
            'Instance type, does not match ReadonlyBoolean.'
        );
        $this->assertEquals(
            'False',
            $falseBoolean->toString(),
            'Instance value is not correct.'
        );
    }
}
