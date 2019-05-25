<?php
namespace Hradigital\Tests\Datatypes\Unit\Scalar;

use Hradigital\Datatypes\Scalar\AbstractReadFloat;
use Hradigital\Datatypes\Scalar\ImmutableInteger;
use Hradigital\Datatypes\Scalar\ImmutableString;
use Hradigital\Datatypes\Scalar\ImmutableFloat;
use Hradigital\Datatypes\Scalar\MutableFloat;
use Hradigital\Tests\Datatypes\AbstractBaseTestCase;

/**
 * Immutable Float Unit testing.
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
class ImmutableFloatTest extends AbstractBaseTestCase
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
        $this->assertFalse(
            ($original === $other),
            'Instances are not meant to match.'
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
            ImmutableFloat::class,
            $instance,
            'Instance type, does not match ImmutableFloat.'
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
     * @return ImmutableFloat
     */
    protected function initializeInstance(string $initialValue)
    {
        return ImmutableFloat::fromString($initialValue);
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
        $original = $this->initializeInstance(123.0);
        $other    = $original->toMutable();

        // Performs assertions.
        $this->assertInstanceOf(
            MutableFloat::class,
            $other,
            'Instance type, does not match MutableFloat.'
        );
        $this->assertEquals(
            $original->value(),
            $other->value(),
            'Instance values do not match.'
        );
        $this->checkInstances($original, $other);
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
        $original = $this->initializeInstance(123.0);
        $integer  = $original->toInteger();

        // Performs assertions.
        $this->assertInstanceOf(
            ImmutableInteger::class,
            $integer,
            'Instance type, does not match ImmutableInteger.'
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
        $original = $this->initializeInstance(123.0);
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
        ImmutableFloat::fromString('');
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
        $instance = ImmutableFloat::fromString('123.0');

        // Performs assertions.
        $this->assertEquals(
            123.0,
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
        $instance = ImmutableFloat::fromFloat(123.0);

        // Performs assertions.
        $this->assertEquals(
            123.0,
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
        $original = $this->initializeInstance(123.0);
        $other    = $original->add($this->initializeInstance(2.0));

        // Performs assertions.
        $this->assertEquals(
            125.0,
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
        $original = $this->initializeInstance(123.0);
        $other    = $original->add($this->initializeInstance(-3.0));

        // Performs assertions.
        $this->assertEquals(
            120.0,
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
        $original = $this->initializeInstance(123.0);
        $other    = $original->subtract($this->initializeInstance(3.0));

        // Performs assertions.
        $this->assertEquals(
            120.0,
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
        $original = $this->initializeInstance(123.0);
        $other    = $original->subtract($this->initializeInstance(-2.0));

        // Performs assertions.
        $this->assertEquals(
            125.0,
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
        $original = $this->initializeInstance(123.0);
        $other    = $original->multiply($this->initializeInstance(2.0));

        // Performs assertions.
        $this->assertEquals(
            246.0,
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
        $original = $this->initializeInstance(123.0);
        $other    = $original->multiply($this->initializeInstance(-2.0));

        // Performs assertions.
        $this->assertEquals(
            -246.0,
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
        $original = $this->initializeInstance(40.0);
        $other    = $original->divide($this->initializeInstance(2.0));

        // Performs assertions.
        $this->assertEquals(
            20.0,
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
        $original = $this->initializeInstance(40.0);
        $other    = $original->divide($this->initializeInstance(-2.0));

        // Performs assertions.
        $this->assertEquals(
            -20.0,
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
            ImmutableString::class,
            $formated,
            'Instance type, does not match ImmutableString.'
        );
    }
}
