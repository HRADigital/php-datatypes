<?php
namespace Hradigital\Tests\Datatypes\Unit\Scalar;

use Hradigital\Datatypes\Scalar\AbstractReadInteger;
use Hradigital\Datatypes\Scalar\ImmutableInteger;
use Hradigital\Datatypes\Scalar\ImmutableString;
use Hradigital\Datatypes\Scalar\ImmutableFloat;
use Hradigital\Datatypes\Scalar\MutableInteger;
use Hradigital\Tests\Datatypes\AbstractBaseTestCase;

/**
 * Immutable Integer Unit testing.
 *
 * Protected method in this class, are available for override in child classes.
 *
 * <i>ImmutableInteger</i> and <i>MutableInteger</i> classes have similar behavior, therefore,
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
class ImmutableIntegerTest extends AbstractBaseTestCase
{
    /**
     * Asserts that 2 integer instances do not match.
     *
     * @param  AbstractReadInteger $original - Original Integer instance.
     * @param  AbstractReadInteger $other    - Second instance for comparison.
     *
     * @since  1.0.0
     * @return void
     */
    protected function checkInstances(AbstractReadInteger $original, AbstractReadInteger $other): void
    {
        $this->assertFalse(
            ($original === $other),
            'Instances are not meant to match.'
        );
    }

    /**
     * Asserts that the supplied instance, is from the correct type.
     *
     * @param  AbstractReadInteger $instance - Instance to be validated.
     *
     * @since  1.0.0
     * @return void
     */
    protected function checkCorrectInstanceType(AbstractReadInteger $instance): void
    {
        $this->assertInstanceOf(
            ImmutableInteger::class,
            $instance,
            'Instance type, does not match ImmutableInteger.'
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
     * @return ImmutableInteger
     */
    protected function initializeInstance(string $initialValue)
    {
        return ImmutableInteger::fromString($initialValue);
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
        $other    = $original->toMuttable();

        // Performs assertions.
        $this->assertInstanceOf(
            MutableInteger::class,
            $other,
            'Instance type, does not match MutableInteger.'
        );
        $this->assertEquals(
            $original->value(),
            $other->value(),
            'Instance values do not match.'
        );
        $this->checkInstances($original, $other);
    }

    /**
     * Tests that the instance can be converted to a Float.
     *
     * @since  1.0.0
     * @return void
     */
    public function testCanConvertInstanceToFloat(): void
    {
        // Performs test.
        $original = $this->initializeInstance(123);
        $float    = $original->toFloat();

        // Performs assertions.
        $this->assertInstanceOf(
            ImmutableFloat::class,
            $float,
            'Instance type, does not match ImmutableFloat.'
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
            ImmutableString::class,
            $string,
            'Instance type, does not match ImmutableString.'
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
        ImmutableInteger::fromString('');
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
        $instance = ImmutableInteger::fromString('123');

        // Performs assertions.
        $this->assertEquals(
            123,
            $instance->value(),
            'Instance value does not match.'
        );
    }

    /**
     * Test that an instance can be created from an Integer.
     *
     * @since  1.0.0
     * @return void
     */
    public function testCanCreateNewInstanceFromInteger(): void
    {
        // Performs test.
        $instance = ImmutableInteger::fromInteger(123);

        // Performs assertions.
        $this->assertEquals(
            123,
            $instance->value(),
            'Instance value does not match.'
        );
    }

    /**
     * Tests a value can be added to the instance.
     *
     * @since  1.0.0
     * @return void
     */
    public function testCanAddPositiveValue(): void
    {
        // Performs test.
        $original = $this->initializeInstance(123);
        $other    = $original->add($this->initializeInstance(2));

        // Performs assertions.
        $this->assertEquals(
            125,
            $other->value(),
            'Instance value does not match.'
        );
        $this->checkInstances($original, $other);
    }

    /**
     * Tests a value can be added to the instance.
     *
     * @since  1.0.0
     * @return void
     */
    public function testCanAddNegativeValue(): void
    {
        // Performs test.
        $original = $this->initializeInstance(123);
        $other    = $original->add($this->initializeInstance(-3));

        // Performs assertions.
        $this->assertEquals(
            120,
            $other->value(),
            'Instance value does not match.'
        );
        $this->checkInstances($original, $other);
    }

    /**
     * Tests a value can be subtracted to the instance.
     *
     * @since  1.0.0
     * @return void
     */
    public function testCanSubtractPositiveValue(): void
    {
        // Performs test.
        $original = $this->initializeInstance(123);
        $other    = $original->subtract($this->initializeInstance(3));

        // Performs assertions.
        $this->assertEquals(
            120,
            $other->value(),
            'Instance value does not match.'
        );
        $this->checkInstances($original, $other);
    }

    /**
     * Tests a value can be subtracted to the instance.
     *
     * @since  1.0.0
     * @return void
     */
    public function testCanSubtractNegativeValue(): void
    {
        // Performs test.
        $original = $this->initializeInstance(123);
        $other    = $original->subtract($this->initializeInstance(-2));

        // Performs assertions.
        $this->assertEquals(
            125,
            $other->value(),
            'Instance value does not match.'
        );
        $this->checkInstances($original, $other);
    }

    /**
     * Tests a value can be multiply to the instance.
     *
     * @since  1.0.0
     * @return void
     */
    public function testCanMultiplyPositiveValue(): void
    {
        // Performs test.
        $original = $this->initializeInstance(123);
        $other    = $original->multiply($this->initializeInstance(2));

        // Performs assertions.
        $this->assertEquals(
            246,
            $other->value(),
            'Instance value does not match.'
        );
        $this->checkInstances($original, $other);
    }

    /**
     * Tests a value can be multiply to the instance.
     *
     * @since  1.0.0
     * @return void
     */
    public function testCanMultiplyNegativeValue(): void
    {
        // Performs test.
        $original = $this->initializeInstance(123);
        $other    = $original->multiply($this->initializeInstance(-2));

        // Performs assertions.
        $this->assertEquals(
            -246,
            $other->value(),
            'Instance value does not match.'
        );
        $this->checkInstances($original, $other);
    }

    /**
     * Tests a value can be divide to the instance.
     *
     * @since  1.0.0
     * @return void
     */
    public function testCanDividePositiveValue(): void
    {
        // Performs test.
        $original = $this->initializeInstance(40);
        $other    = $original->divide($this->initializeInstance(2));

        // Performs assertions.
        $this->assertEquals(
            20,
            $other->value(),
            'Instance value does not match.'
        );
        $this->checkInstances($original, $other);
    }

    /**
     * Tests a value can be divide to the instance.
     *
     * @since  1.0.0
     * @return void
     */
    public function testCanDivideNegativeValue(): void
    {
        // Performs test.
        $original = $this->initializeInstance(40);
        $other    = $original->divide($this->initializeInstance(-2));

        // Performs assertions.
        $this->assertEquals(
            -20,
            $other->value(),
            'Instance value does not match.'
        );
        $this->checkInstances($original, $other);
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
        $original = $this->initializeInstance(4000);
        $formated = $original->format(
            \NumberFormatter::create('en_US', \NumberFormatter::DEFAULT_STYLE)
        );

        // Performs assertions.
        $this->assertEquals(
            '4,000',
            $formated->__toString(),
            'Formatted number does not seam to match.'
        );
        $this->assertInstanceOf(
            ImmutableString::class,
            $formated,
            'Instance type, does not match ImmutableString.'
        );
    }
}
