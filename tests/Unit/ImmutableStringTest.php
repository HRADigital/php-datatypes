<?php
namespace Hradigital\Tests\Datatypes\Unit;

use Hradigital\Datatypes\ImmutableString;
use Hradigital\Datatypes\MutableString;
use Hradigital\Datatypes\ReadonlyString;
use Hradigital\Tests\Datatypes\AbstractBaseTestCase;

/**
 * Immutable String Unit testing.
 *
 * Protected method in this class, are available for override in child classes.
 *
 * <i>ImmutableString</i> and <i>MutableString</i> classes have similar behavior, therefore,
 * you should extend this test case for the other type of String, overriding only the necessary
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
class ImmutableStringTest extends AbstractBaseTestCase
{
    /**
     * Asserts that 2 string instances do not match.
     *
     * @param  ReadonlyString $original - Original String instance.
     * @param  ReadonlyString $other    - Second instance for comparison.
     *
     * @since  1.0.0
     * @return void
     */
    protected function checkInstances(ReadonlyString $original, ReadonlyString $other): void
    {
        $this->assertFalse(
            ($original === $other),
            'Instances are not meant to match.'
        );
    }

    /**
     * Asserts that the supplied instance, is from the correct type.
     *
     * @param  ReadonlyString $instance - Instance to be validated.
     *
     * @since  1.0.0
     * @return void
     */
    protected function checkCorrectInstanceType(ReadonlyString $instance): void
    {
        $this->assertInstanceOf(
            ImmutableString::class,
            $instance,
            'Instance type, does not match ImmutableString.'
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
     * @return ImmutableString
     */
    protected function initializeInstance(string $initialValue)
    {
        return new ImmutableString($initialValue);
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
        $other    = $original->toMutable();

        // Performs assertions.
        $this->assertInstanceOf(
            MutableString::class,
            $other,
            'Instance type, does not match ImmutableString.'
        );
        $this->assertEquals(
            $original->__toString(),
            $other->__toString(),
            'Instance values do not match.'
        );
        $this->checkInstances($original, $other);
    }

    /**
     * Tests that a string can be trimmed.
     *
     * @since  1.0.0
     * @return void
     */
    public function testCanTrimString(): void
    {
        // Performs test.
        $original = $this->initializeInstance("  Immutable string.  ");
        $other    = $original->trim();

        // Performs assertions.
        $this->assertEquals(
            'Immutable string.',
            $other->__toString(),
            'Instance values do not match.'
        );
        $this->checkCorrectInstanceType($other);
        $this->checkInstances($original, $other);
    }

    /**
     * Tests that a string can be trimmed only on the left.
     *
     * @since  1.0.0
     * @return void
     */
    public function testCanLeftTrimString(): void
    {
        // Performs test.
        $original = $this->initializeInstance("  Immutable string.  ");
        $other    = $original->trimLeft();

        // Performs assertions.
        $this->assertEquals(
            'Immutable string.  ',
            $other->__toString(),
            'Instance values do not match.'
        );
        $this->checkCorrectInstanceType($other);
        $this->checkInstances($original, $other);
    }

    /**
     * Tests that a string can be trimmed only on the right.
     *
     * @since  1.0.0
     * @return void
     */
    public function testCanRightTrimString(): void
    {
        // Performs test.
        $original = $this->initializeInstance("  Immutable string.  ");
        $other    = $original->trimRight();

        // Performs assertions.
        $this->assertEquals(
            '  Immutable string.',
            $other->__toString(),
            'Instance values do not match.'
        );
        $this->checkCorrectInstanceType($other);
        $this->checkInstances($original, $other);
    }

    /**
     * Tests that a string can be converted to UPPER case.
     *
     * @since  1.0.0
     * @return void
     */
    public function testCanUpperCaseString(): void
    {
        // Performs test.
        $original = $this->initializeInstance("Immutable string.");
        $other    = $original->toUpper();

        // Performs assertions.
        $this->assertEquals(
            'IMMUTABLE STRING.',
            $other->__toString(),
            'Instance values do not match.'
        );
        $this->checkCorrectInstanceType($other);
        $this->checkInstances($original, $other);
    }

    /**
     * Tests that a string can be converted to UPPER case.
     *
     * @since  1.0.0
     * @return void
     */
    public function testCanUpperCaseFirst(): void
    {
        // Performs test.
        $original = $this->initializeInstance("immutable string.");
        $other    = $original->toUpperFirst();

        // Performs assertions.
        $this->assertEquals(
            'Immutable string.',
            $other->__toString(),
            'Instance values do not match.'
        );
        $this->checkCorrectInstanceType($other);
        $this->checkInstances($original, $other);
    }

    /**
     * Tests that a string can be convert to UPPER case, all words.
     *
     * @since  1.0.0
     * @return void
     */
    public function testCanUpperCaseWords(): void
    {
        // Performs test.
        $original = $this->initializeInstance("immutable string.");
        $other    = $original->toUpperWords();

        // Performs assertions.
        $this->assertEquals(
            'Immutable String.',
            $other->__toString(),
            'Instance values do not match.'
        );
        $this->checkCorrectInstanceType($other);
        $this->checkInstances($original, $other);
    }

    /**
     * Tests that a string can be converted to LOWER case.
     *
     * @since  1.0.0
     * @return void
     */
    public function testCanLowerCaseString(): void
    {
        // Performs test.
        $original = $this->initializeInstance("Immutable String.");
        $other    = $original->toLower();

        // Performs assertions.
        $this->assertEquals(
            'immutable string.',
            $other->__toString(),
            'Instance values do not match.'
        );
        $this->checkCorrectInstanceType($other);
        $this->checkInstances($original, $other);
    }

    /**
     * Tests that a string can be converted to LOWER case.
     *
     * @since  1.0.0
     * @return void
     */
    public function testCanLowerCaseFirst(): void
    {
        // Performs test.
        $original = $this->initializeInstance("Immutable String.");
        $other    = $original->toLowerFirst();

        // Performs assertions.
        $this->assertEquals(
            'immutable String.',
            $other->__toString(),
            'Instance values do not match.'
        );
        $this->checkCorrectInstanceType($other);
        $this->checkInstances($original, $other);
    }

    /**
     * Tests that a string can be padded on the left.
     *
     * @since  1.0.0
     * @return void
     */
    public function testCanPadOnTheLeft(): void
    {
        // Performs test.
        $original = $this->initializeInstance("Immutable String.");
        $other    = $original->padLeft(2);

        // Performs assertions.
        $this->assertEquals(
            '  Immutable String.',
            $other->__toString(),
            'Instance values do not match.'
        );
        $this->checkCorrectInstanceType($other);
        $this->checkInstances($original, $other);
    }

    /**
     * Tests that padding breaks.
     *
     * @since  1.0.0
     * @return void
     */
    public function testCanPaddingOnTheLeftBreaksWithInvalidLength(): void
    {
        // Creates expectation.
        $this->expectException(\InvalidArgumentException::class);

        // Performs test.
        $original = $this->initializeInstance("Immutable String.");
        $original->padLeft(0);
    }

    /**
     * Tests that padding breaks.
     *
     * @since  1.0.0
     * @return void
     */
    public function testCanPaddingOnTheLeftBreaksWithInvalidPadString(): void
    {
        // Creates expectation.
        $this->expectException(\InvalidArgumentException::class);

        // Performs test.
        $original = $this->initializeInstance("Immutable String.");
        $original->padLeft(2, '');
    }

    /**
     * Tests that a string can be padded on the left.
     *
     * @since  1.0.0
     * @return void
     */
    public function testCanPadOnTheLeftWidthCharacter(): void
    {
        // Performs test.
        $original = $this->initializeInstance("Immutable String.");
        $other    = $original->padLeft(2, '_');

        // Performs assertions.
        $this->assertEquals(
            '__Immutable String.',
            $other->__toString(),
            'Instance values do not match.'
        );
        $this->checkCorrectInstanceType($other);
        $this->checkInstances($original, $other);
    }

    /**
     * Tests that a string can be padded on the right.
     *
     * @since  1.0.0
     * @return void
     */
    public function testCanPadOnTheRight(): void
    {
        // Performs test.
        $original = $this->initializeInstance("Immutable String.");
        $other    = $original->padRight(2);

        // Performs assertions.
        $this->assertEquals(
            'Immutable String.  ',
            $other->__toString(),
            'Instance values do not match.'
        );
        $this->checkCorrectInstanceType($other);
        $this->checkInstances($original, $other);
    }

    /**
     * Tests that padding breaks.
     *
     * @since  1.0.0
     * @return void
     */
    public function testCanPadOnTheRightBreaksWithInvalidLength(): void
    {
        // Creates expectation.
        $this->expectException(\InvalidArgumentException::class);

        // Performs test.
        $original = $this->initializeInstance("Immutable String.");
        $original->padRight(0);
    }

    /**
     * Tests that padding breaks.
     *
     * @since  1.0.0
     * @return void
     */
    public function testCanPadOnTheRightBreaksWithInvalidPadString(): void
    {
        // Creates expectation.
        $this->expectException(\InvalidArgumentException::class);

        // Performs test.
        $original = $this->initializeInstance("Immutable String.");
        $original->padRight(2, '');
    }

    /**
     * Tests that a string can be padded on the right.
     *
     * @since  1.0.0
     * @return void
     */
    public function testCanPadOnTheRightWidthCharacter(): void
    {
        // Performs test.
        $original = $this->initializeInstance("Immutable String.");
        $other    = $original->padRight(2, '_');

        // Performs assertions.
        $this->assertEquals(
            'Immutable String.__',
            $other->__toString(),
            'Instance values do not match.'
        );
        $this->checkCorrectInstanceType($other);
        $this->checkInstances($original, $other);
    }

    /**
     * Tests that a simple substring can be retrieved.
     *
     * @since  1.0.0
     * @return void
     */
    public function testSubStringCanBeRetrieved(): void
    {
        // Performs test.
        $original = $this->initializeInstance("Immutable String.");
        $other    = $original->subString(10);

        // Performs assertions.
        $this->assertEquals(
            'String.',
            $other->__toString(),
            'Instance values do not match.'
        );
        $this->checkCorrectInstanceType($other);
        $this->checkInstances($original, $other);
    }

    /**
     * Tests that a simple substring can be retrieved.
     *
     * @since  1.0.0
     * @return void
     */
    public function testSubStringCanBeRetrievedWithNegativeStart(): void
    {
        // Performs test.
        $original = $this->initializeInstance("Immutable String.");
        $other    = $original->subString(-7);

        // Performs assertions.
        $this->assertEquals(
            'String.',
            $other->__toString(),
            'Instance values do not match.'
        );
        $this->checkCorrectInstanceType($other);
        $this->checkInstances($original, $other);
    }

    /**
     * Tests that a simple substring can be retrieved.
     *
     * @since  1.0.0
     * @return void
     */
    public function testSubStringCanBeRetrievedWithLength(): void
    {
        // Performs test.
        $original = $this->initializeInstance("Immutable String.");
        $other    = $original->subString(2, 7);

        // Performs assertions.
        $this->assertEquals(
            'mutable',
            $other->__toString(),
            'Instance values do not match.'
        );
        $this->checkCorrectInstanceType($other);
        $this->checkInstances($original, $other);
    }

    /**
     * Tests that a simple substring can be retrieved.
     *
     * @since  1.0.0
     * @return void
     */
    public function testSubStringCanBeRetrievedWithNegativeLength(): void
    {
        // Performs test.
        $original = $this->initializeInstance("Immutable String.");
        $other    = $original->subString(2, -8);

        // Performs assertions.
        $this->assertEquals(
            'mutable',
            $other->__toString(),
            'Instance values do not match.'
        );
        $this->checkCorrectInstanceType($other);
        $this->checkInstances($original, $other);
    }

    /**
     * Tests that substring breaks.
     *
     * @since  1.0.0
     * @return void
     */
    public function testSubStringBreaksWithShortStart(): void
    {
        // Creates expectation.
        $this->expectException(\OutOfRangeException::class);

        // Performs test.
        $original = $this->initializeInstance("Immutable String.");
        $original->subString(-30);
    }

    /**
     * Tests that substring breaks.
     *
     * @since  1.0.0
     * @return void
     */
    public function testSubStringBreaksWithLongStart(): void
    {
        // Creates expectation.
        $this->expectException(\OutOfRangeException::class);

        // Performs test.
        $original = $this->initializeInstance("Immutable String.");
        $original->subString(30);
    }

    /**
     * Tests that substring breaks.
     *
     * @since  1.0.0
     * @return void
     */
    public function testSubStringBreaksWithShortLength(): void
    {
        // Creates expectation.
        $this->expectException(\OutOfRangeException::class);

        // Performs test.
        $original = $this->initializeInstance("Immutable String.");
        $original->subString(0, -30);
    }

    /**
     * Tests that substring breaks.
     *
     * @since  1.0.0
     * @return void
     */
    public function testSubStringBreaksWithLongLength(): void
    {
        // Creates expectation.
        $this->expectException(\OutOfRangeException::class);

        // Performs test.
        $original = $this->initializeInstance("Immutable String.");
        $original->subString(0, 30);
    }

    /**
     * Tests that a simple subLeft can be retrieved.
     *
     * @since  1.0.0
     * @return void
     */
    public function testSubStringLeftCanBeRetrieved(): void
    {
        // Performs test.
        $original = $this->initializeInstance("Immutable String.");
        $other    = $original->subLeft(10);

        // Performs assertions.
        $this->assertEquals(
            'Immutable ',
            $other->__toString(),
            'Instance values do not match.'
        );
        $this->checkCorrectInstanceType($other);
        $this->checkInstances($original, $other);
    }

    /**
     * Tests that subLeft() breaks.
     *
     * @since  1.0.0
     * @return void
     */
    public function testSubStringLeftBreaksWithShortLength(): void
    {
        // Creates expectation.
        $this->expectException(\InvalidArgumentException::class);

        // Performs test.
        $original = $this->initializeInstance("Immutable String.");
        $original->subLeft(-1);
    }

    /**
     * Tests that subLeft() breaks.
     *
     * @since  1.0.0
     * @return void
     */
    public function testSubStringLeftBreaksWithLongLength(): void
    {
        // Creates expectation.
        $this->expectException(\OutOfRangeException::class);

        // Performs test.
        $original = $this->initializeInstance("Immutable String.");
        $original->subLeft(30);
    }

    /**
     * Tests that a simple subRight() can be retrieved.
     *
     * @since  1.0.0
     * @return void
     */
    public function testSubStringRightCanBeRetrieved(): void
    {
        // Performs test.
        $original = $this->initializeInstance("Immutable String.");
        $other    = $original->subRight(10);

        // Performs assertions.
        $this->assertEquals(
            'le String.',
            $other->__toString(),
            'Instance values do not match.'
        );
        $this->checkCorrectInstanceType($other);
        $this->checkInstances($original, $other);
    }

    /**
     * Tests that subRight() breaks.
     *
     * @since  1.0.0
     * @return void
     */
    public function testSubStringRightBreaksWithShortLength(): void
    {
        // Creates expectation.
        $this->expectException(\InvalidArgumentException::class);

        // Performs test.
        $original = $this->initializeInstance("Immutable String.");
        $original->subRight(-1);
    }

    /**
     * Tests that subRight() breaks.
     *
     * @since  1.0.0
     * @return void
     */
    public function testSubStringRightBreaksWithLongLength(): void
    {
        // Creates expectation.
        $this->expectException(\OutOfRangeException::class);

        // Performs test.
        $original = $this->initializeInstance("Immutable String.");
        $original->subRight(30);
    }

    /**
     * Tests that a string can be reversed.
     *
     * @since  1.0.0
     * @return void
     */
    public function testStringCanBeReversed(): void
    {
        // Performs test.
        $original = $this->initializeInstance("Immutable String.");
        $other    = $original->reverse();

        // Performs assertions.
        $this->assertEquals(
            '.gnirtS elbatummI',
            $other->__toString(),
            'Instance values do not match.'
        );
        $this->checkCorrectInstanceType($other);
        $this->checkInstances($original, $other);
    }

    /**
     * Tests that text can be replaced in the String.
     *
     * @since  1.0.0
     * @return void
     */
    public function testTextCanBeReplacedInString(): void
    {
        // Performs test.
        $original = $this->initializeInstance("Immutable String.");
        $other    = $original->replace('String', 'Object');

        // Performs assertions.
        $this->assertEquals(
            'Immutable Object.',
            $other->__toString(),
            'Instance values do not match.'
        );
        $this->checkCorrectInstanceType($other);
        $this->checkInstances($original, $other);
    }

    /**
     * Tests that text is not replaced if search is not found.
     *
     * @since  1.0.0
     * @return void
     */
    public function testTextIsNotReplacedIfSearchNotFound(): void
    {
        // Performs test.
        $original = $this->initializeInstance("Immutable String.");
        $other    = $original->replace('None', 'Object');

        // Performs assertions.
        $this->assertEquals(
            $original->__toString(),
            $other->__toString(),
            'Instance values do not match.'
        );
        $this->checkCorrectInstanceType($other);
        $this->checkInstances($original, $other);
    }

    /**
     * Tests that text replace breaks.
     *
     * @since  1.0.0
     * @return void
     */
    public function testTextReplaceBreaksIfSearchIsEmpty(): void
    {
        // Creates expectation.
        $this->expectException(\InvalidArgumentException::class);

        // Performs test.
        $original = $this->initializeInstance("Immutable String.");
        $original->replace('', 'Object');
    }
}
