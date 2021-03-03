<?php declare(strict_types=1);

namespace Hradigital\Tests\Datatypes\Unit\Scalar;

use Hradigital\Datatypes\Scalar\AbstractBaseString;
use Hradigital\Datatypes\Scalar\ImmutableString;
use Hradigital\Datatypes\Scalar\MutableString;

/**
 * Mutable String Unit testing.
 *
 * Protected method in this class, are available for override parent class.
 *
 * ImmutableString and MutableString classes have similar behavior, therefore,
 * this test case extends the parent for the other type of String, overriding only the necessary
 * tests, which shouldn't be too many.
 *
 * This way, we can testboth types of objects, without repeating the same code/tests.
 *
 * @package   Hradigital\Datatypes
 * @license   MIT
 */
class MutableStringTest extends ImmutableStringTest
{
    /**
     * Asserts that 2 string instances match.
     *
     * @param  AbstractBaseString $original - Original String instance.
     * @param  AbstractBaseString $other    - Second instance for comparison.
     *
     * @return void
     */
    protected function checkInstances(AbstractBaseString $original, AbstractBaseString $other): void
    {
        $this->assertTrue(
            ($original === $other),
            'Instances are meant to match.'
        );
    }

    /**
     * Asserts that the supplied instance, is from the correct type.
     *
     * @param  AbstractBaseString $instance - Instance to be validated.
     *
     * @return void
     */
    protected function checkCorrectInstanceType(AbstractBaseString $instance): void
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
     * @return AbstractBaseString
     */
    protected function getInstance(string $initialValue): AbstractBaseString
    {
        return MutableString::fromString($initialValue);
    }

    /**
     * Checks instance can be cloned.
     *
     * @return void
     */
    public function testCanCloneObject(): void
    {
        // Performs test.
        $original = $this->getInstance("Immutable string.");
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
