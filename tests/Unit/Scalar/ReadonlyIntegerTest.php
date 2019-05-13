<?php
namespace Hradigital\Tests\Datatypes\Unit\Scalar;

use Hradigital\Datatypes\Scalar\AbstractReadInteger;
use Hradigital\Datatypes\Scalar\ReadonlyFloat;
use Hradigital\Datatypes\Scalar\ReadonlyInteger;
use Hradigital\Datatypes\Scalar\ReadonlyString;
use Hradigital\Tests\Datatypes\AbstractBaseTestCase;

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
            $value->value(),
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
        $this->assertEquals(
            \intval($test),
            $value->value(),
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
}
