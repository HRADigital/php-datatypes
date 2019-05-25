<?php
namespace Hradigital\Tests\Datatypes\Unit\Scalar;

use Hradigital\Datatypes\Scalar\AbstractReadString;
use Hradigital\Datatypes\Scalar\ImmutableString;
use Hradigital\Datatypes\Scalar\MutableString;

/**
 * Mutable String Unit testing.
 *
 * Protected method in this class, are available for override parent class.
 *
 * <i>ImmutableString</i> and <i>MutableString</i> classes have similar behavior, therefore,
 * this test case extends the parent for the other type of String, overriding only the necessary
 * tests, which shouldn't be too many.
 *
 * This way, we can testboth types of objects, without repeating the same code/tests.
 *
 * @package   Hradigital\Datatypes
 * @copyright Hugo Rafael Azevedo <github@hradigital.com>
 * @author    Hugo Rafael Azevedo <github@hradigital.com>
 * @license   MIT
 * @since     1.0.0
 */
class MutableStringTest extends ImmutableStringTest
{
    /**
     * Asserts that 2 string instances match.
     *
     * @param  AbstractReadString $original - Original String instance.
     * @param  AbstractReadString $other    - Second instance for comparison.
     *
     * @since  1.0.0
     * @return void
     */
    protected function checkInstances(AbstractReadString $original, AbstractReadString $other): void
    {
        $this->assertTrue(
            ($original === $other),
            'Instances are meant to match.'
        );
    }

    /**
     * Asserts that the supplied instance, is from the correct type.
     *
     * @param  AbstractReadString $instance - Instance to be validated.
     *
     * @since  1.0.0
     * @return void
     */
    protected function checkCorrectInstanceType(AbstractReadString $instance): void
    {
        $this->assertInstanceOf(
            MutableString::class,
            $instance,
            'Instance type, does not match MutableString.'
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
     * @return MutableString
     */
    protected function initializeInstance(string $initialValue)
    {
        return MutableString::fromString($initialValue);
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
        $original = $this->initializeInstance("Immutable string.");
        $other    = $original->toImmutable();

        // Performs assertions.
        $this->assertInstanceOf(
            ImmutableString::class,
            $other,
            'Instance type, does not match ImmutableString.'
        );
        $this->assertEquals(
            $original->__toString(),
            $other->__toString(),
            'Instance values do not match.'
        );
        $this->assertFalse(
            ($original === $other),
            'Instances are meant to match.'
        );
    }
}
