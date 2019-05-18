<?php
namespace Hradigital\Tests\Datatypes\Unit\Scalar;

use Hradigital\Datatypes\Scalar\AbstractReadFloat;
use Hradigital\Datatypes\Scalar\ImmutableFloat;
use Hradigital\Datatypes\Scalar\MutableFloat;
use Hradigital\Datatypes\Scalar\MutableInteger;
use Hradigital\Datatypes\Scalar\MutableString;

/**
 * Mutable Float Unit testing.
 *
 * Protected method in this class, are available for override in child classes.
 *
 * <i>ImmutableFloat</i> and <i>MutableFloat</i> classes have similar behavior, therefore,
 * you should extend this test case for the other type of String, overriding only the necessary
 * tests, which shouldn't be too many.
 *
 * This way, we can test both types of objects, without repeating the same code/tests.
 *
 * @package   Hradigital\Datatypes
 * @copyright Hugo Rafael Azevedo <github@hradigital.com>
 * @author    Hugo Rafael Azevedo <github@hradigital.com>
 * @license   MIT
 * @since     1.0.0
 */
class MutableFloatTest extends ImmutableFloatTest
{
    /**
     * Asserts that 2 integer instances do not match.
     *
     * @param  AbstractReadFloat $original - Original Float instance.
     * @param  AbstractReadFloat $other    - Second instance for comparison.
     *
     * @since  1.0.0
     * @return void
     */
    protected function checkInstances(AbstractReadFloat $original, AbstractReadFloat $other): void
    {
        $this->assertTrue(
            ($original === $other),
            'Instances are meant to match.'
        );
    }

    /**
     * Asserts that the supplied instance, is from the correct type.
     *
     * @param  AbstractReadFloat $instance - Instance to be validated.
     *
     * @since  1.0.0
     * @return void
     */
    protected function checkCorrectInstanceType(AbstractReadFloat $instance): void
    {
        $this->assertInstanceOf(
            MutableFloat::class,
            $instance,
            'Instance type, does not match MutableFloat.'
        );
    }

    /**
     * Initializes and returns a new instance for testing.
     *
     * This method has no return value, due to inheritance overriding.
     *
     * @param  string $initialValue - Instance's initial value.
     *
     * @since  1.0.0
     * @return MutableInteger
     */
    protected function initializeInstance(string $initialValue)
    {
        return MutableFloat::fromString($initialValue);
    }

    /**
     * Checks instance can be cloned.
     *
     * @since  1.0.0
     * @return void
     */
    public function testCanCloneObject(): void
    {
        // Performs test.
        $original = $this->initializeInstance(123);
        $other    = $original->toImmutable();

        // Performs assertions.
        $this->assertInstanceOf(
            ImmutableFloat::class,
            $other,
            'Instance type, does not match ImmutableFloat.'
        );
        $this->assertEquals(
            $original->value(),
            $other->value(),
            'Instance values do not match.'
        );
        $this->assertFalse(
            ($original === $other),
            'Instances are not meant to match.'
        );
    }

    /**
     * Tests that the instance can be converted to an Integer.
     *
     * @since  1.0.0
     * @return void
     */
    public function testCanConvertInstanceToInteger(): void
    {
        // Performs test.
        $original = $this->initializeInstance(123);
        $integer  = $original->toInteger();

        // Performs assertions.
        $this->assertInstanceOf(
            MutableInteger::class,
            $integer,
            'Instance type, does not match MutableInteger.'
        );
    }

    /**
     * Tests that the instance can be converted to a String.
     *
     * @since  1.0.0
     * @return void
     */
    public function testCanConvertInstanceToString(): void
    {
        // Performs test.
        $original = $this->initializeInstance(123);
        $string   = $original->toString();

        // Performs assertions.
        $this->assertInstanceOf(
            MutableString::class,
            $string,
            'Instance type, does not match MutableString.'
        );
    }

    /**
     * Tests that trying to create a new Instance from an empty string breaks.
     *
     * @since  1.0.0
     * @return void
     */
    public function testCreatingNewInstanceFromStringBreaksWithEmptyString(): void
    {
        // Creates expectation.
        $this->expectException(\InvalidArgumentException::class);

        // Performs test.
        MutableFloat::fromString('');
    }

    /**
     * Test that an instance can be created from a String.
     *
     * @since  1.0.0
     * @return void
     */
    public function testCanCreateNewInstanceFromString(): void
    {
        // Performs test.
        $instance = MutableFloat::fromString('123.1');

        // Performs assertions.
        $this->assertEquals(
            123.1,
            $instance->value(),
            'Instance value does not match.'
        );
    }

    /**
     * Test that an instance can be created from a Float.
     *
     * @since  1.0.0
     * @return void
     */
    public function testCanCreateNewInstanceFromFloat(): void
    {
        // Performs test.
        $instance = MutableFloat::fromFloat(123);

        // Performs assertions.
        $this->assertEquals(
            123,
            $instance->value(),
            'Instance value does not match.'
        );
    }

    /**
     * Tests that the number can be formatted correctly.
     *
     * @since  1.0.0
     * @return void
     */
    public function testCanFormatTheInstance(): void
    {
        // Performs test.
        $original = $this->initializeInstance(4000.1);
        $formated = $original->format(
            \NumberFormatter::create('en_US', \NumberFormatter::DECIMAL)
        );

        // Performs assertions.
        $this->assertEquals(
            '4,000.1',
            $formated->__toString(),
            'Formatted number does not seam to match.'
        );
        $this->assertInstanceOf(
            MutableString::class,
            $formated,
            'Instance type, does not match MutableString.'
        );
    }
}
