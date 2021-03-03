<?php declare(strict_types=1);

namespace Hradigital\Tests\Datatypes\Unit\Scalar;

use Hradigital\Datatypes\Scalar\AbstractBaseString;
use Hradigital\Datatypes\Scalar\ImmutableString;
use Hradigital\Tests\Datatypes\AbstractBaseTestCase;

/**
 * Immutable String Unit testing.
 *
 * Protected method in this class, are available for override in child classes.
 *
 * ImmutableString and MutableString classes have similar behavior, therefore,
 * you should extend this test case for the other type of String, overriding only the necessary
 * tests, which shouldn't be too many.
 *
 * This way, we can test both types of objects, without repeating the same code/tests.
 *
 * @package   Hradigital\Datatypes
 * @license   MIT
 */
class ImmutableStringTest extends AbstractBaseTestCase
{
    /**
     * Asserts that 2 string instances do not match.
     *
     * @param  AbstractBaseString $original - Original String instance.
     * @param  AbstractBaseString $other    - Second instance for comparison.
     *
     * @return void
     */
    protected function checkInstances(AbstractBaseString $original, AbstractBaseString $other): void
    {
        $this->assertFalse(
            ($original === $other),
            'Instances are not meant to match.'
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
     * @return AbstractBaseString
     */
    protected function getInstance(string $initialValue): AbstractBaseString
    {
        return ImmutableString::fromString($initialValue);
    }

    /**
     * Checks Equality of two distinct strings.
     *
     * @return void
     */
    public function testCanCheckEquality(): void
    {
        // Performs test.
        $original = $this->getInstance("  Immutable string.  ");
        $other    = $this->getInstance("  Immutable string.  ");

        // Performs assertions.
        $this->assertTrue(
            $original->equals($other),
            'Instance values do not match.'
        );
        $this->checkCorrectInstanceType($original);
        $this->checkCorrectInstanceType($other);
    }

    /**
     * Tests that we can check of String contains a text portion.
     *
     * @return void
     */
    public function testCanCheckIfStringContainsPortion(): void
    {
        // Performs test.
        $original = $this->getInstance("Immutable string.");

        // Performs assertions.
        $this->assertTrue(
            $original->contains('muta'),
            'Instance values do not match.'
        );
        $this->checkCorrectInstanceType($original);
    }

    /**
     * Tests that method breaks if invalid parameters are passed.
     *
     * @return void
     */
    public function testBreaksWhileCheckingIfStringContainsPortion(): void
    {
        // Performs test.
        $original = $this->getInstance("Immutable string.");

        // Create expectations.
        $this->expectException(\InvalidArgumentException::class);

        // Performs test.
        $original->contains('');
    }

    /**
     * Tests that a string can be trimmed.
     *
     * @return void
     */
    public function testCanTrimString(): void
    {
        // Performs test.
        $original = $this->getInstance("  Immutable string.  ");
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
     * @return void
     */
    public function testCanLeftTrimString(): void
    {
        // Performs test.
        $original = $this->getInstance("  Immutable string.  ");
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
     * @return void
     */
    public function testCanRightTrimString(): void
    {
        // Performs test.
        $original = $this->getInstance("  Immutable string.  ");
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
     * @return void
     */
    public function testCanUpperCaseString(): void
    {
        // Performs test.
        $original = $this->getInstance("Immutable string.");
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
     * @return void
     */
    public function testCanUpperCaseFirst(): void
    {
        // Performs test.
        $original = $this->getInstance("immutable string.");
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
     * @return void
     */
    public function testCanUpperCaseWords(): void
    {
        // Performs test.
        $original = $this->getInstance("immutable string.");
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
     * @return void
     */
    public function testCanLowerCaseString(): void
    {
        // Performs test.
        $original = $this->getInstance("Immutable String.");
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
     * @return void
     */
    public function testCanLowerCaseFirst(): void
    {
        // Performs test.
        $original = $this->getInstance("Immutable String.");
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
     * @return void
     */
    public function testCanPadOnTheLeft(): void
    {
        // Performs test.
        $string   = "Immutable String.";
        $original = $this->getInstance($string);
        $other    = $original->padLeft(\strlen($string) + 2);

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
     * Tests that a string is not padded on the left, when the padding length is less than the string's length.
     *
     * @return void
     */
    public function testCanPadOnTheLeftWithoutResult(): void
    {
        // Performs test.
        $string   = "Immutable String.";
        $original = $this->getInstance($string);
        $other    = $original->padLeft(2);

        // Performs assertions.
        $this->assertEquals(
            $string,
            $other->__toString(),
            'Instance values do not match.'
        );
        $this->checkCorrectInstanceType($other);
        $this->checkInstances($original, $other);
    }

    /**
     * Tests that a string can be padded on the left.
     *
     * @return void
     */
    public function testCanPadOnTheLeftExtra(): void
    {
        // Performs test.
        $string   = "Immutable String.";
        $original = $this->getInstance($string);
        $other    = $original->padLeftExtra(2);

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
     * @return void
     */
    public function testCanPaddingOnTheLeftBreaksWithInvalidLength(): void
    {
        // Creates expectation.
        $this->expectException(\InvalidArgumentException::class);

        // Performs test.
        $original = $this->getInstance("Immutable String.");
        $original->padLeft(0);
    }

    /**
     * Tests that padding breaks.
     *
     * @return void
     */
    public function testCanPaddingOnTheLeftBreaksWithInvalidPadString(): void
    {
        // Creates expectation.
        $this->expectException(\InvalidArgumentException::class);

        // Performs test.
        $original = $this->getInstance("Immutable String.");
        $original->padLeft(2, '');
    }

    /**
     * Tests that padding breaks.
     *
     * @return void
     */
    public function testCanPaddingOnTheLeftExtraBreaksWithInvalidLength(): void
    {
        // Creates expectation.
        $this->expectException(\InvalidArgumentException::class);

        // Performs test.
        $original = $this->getInstance("Immutable String.");
        $original->padLeftExtra(0);
    }

    /**
     * Tests that padding breaks.
     *
     * @return void
     */
    public function testCanPaddingOnTheLeftExtraBreaksWithInvalidPadString(): void
    {
        // Creates expectation.
        $this->expectException(\InvalidArgumentException::class);

        // Performs test.
        $original = $this->getInstance("Immutable String.");
        $original->padLeftExtra(2, '');
    }

    /**
     * Tests that a string can be padded on the left.
     *
     * @return void
     */
    public function testCanPadOnTheLeftWidthCharacter(): void
    {
        // Performs test.
        $string   = "Immutable String.";
        $original = $this->getInstance($string);
        $other    = $original->padLeft(\strlen($string) + 2, '_');

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
     * Tests that a string can be padded on the left.
     *
     * @return void
     */
    public function testCanPadOnTheLeftExtraWidthCharacter(): void
    {
        // Performs test.
        $string   = "Immutable String.";
        $original = $this->getInstance($string);
        $other    = $original->padLeftExtra(2, '_');

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
     * @return void
     */
    public function testCanPadOnTheRight(): void
    {
        // Performs test.
        $string   = "Immutable String.";
        $original = $this->getInstance($string);
        $other    = $original->padRight(\strlen($string) + 2);

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
     * Tests that a string can be padded on the right.
     *
     * @return void
     */
    public function testCanPadOnTheRightExtra(): void
    {
        // Performs test.
        $string   = "Immutable String.";
        $original = $this->getInstance($string);
        $other    = $original->padRightExtra(2);

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
     * @return void
     */
    public function testCanPadOnTheRightBreaksWithInvalidLength(): void
    {
        // Creates expectation.
        $this->expectException(\InvalidArgumentException::class);

        // Performs test.
        $original = $this->getInstance("Immutable String.");
        $original->padRight(0);
    }

    /**
     * Tests that padding breaks.
     *
     * @return void
     */
    public function testCanPadOnTheRightBreaksWithInvalidPadString(): void
    {
        // Creates expectation.
        $this->expectException(\InvalidArgumentException::class);

        // Performs test.
        $original = $this->getInstance("Immutable String.");
        $original->padRight(2, '');
    }

    /**
     * Tests that padding breaks.
     *
     * @return void
     */
    public function testCanPadOnTheRightExtraBreaksWithInvalidLength(): void
    {
        // Creates expectation.
        $this->expectException(\InvalidArgumentException::class);

        // Performs test.
        $original = $this->getInstance("Immutable String.");
        $original->padRightExtra(0);
    }

    /**
     * Tests that padding breaks.
     *
     * @return void
     */
    public function testCanPadOnTheRightExtraBreaksWithInvalidPadString(): void
    {
        // Creates expectation.
        $this->expectException(\InvalidArgumentException::class);

        // Performs test.
        $original = $this->getInstance("Immutable String.");
        $original->padRightExtra(2, '');
    }

    /**
     * Tests that a string can be padded on the right.
     *
     * @return void
     */
    public function testCanPadOnTheRightWidthCharacter(): void
    {
        // Performs test.
        $string   = "Immutable String.";
        $original = $this->getInstance($string);
        $other    = $original->padRight(\strlen($string) + 2, '_');

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
     * Tests that a string can be padded on the right.
     *
     * @return void
     */
    public function testCanPadOnTheRightExtraWidthCharacter(): void
    {
        // Performs test.
        $string   = "Immutable String.";
        $original = $this->getInstance($string);
        $other    = $original->padRightExtra(2, '_');

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
     * @return void
     */
    public function testSubStringCanBeRetrieved(): void
    {
        // Performs test.
        $original = $this->getInstance("Immutable String.");
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
     * @return void
     */
    public function testSubStringCanBeRetrievedWithNegativeStart(): void
    {
        // Performs test.
        $original = $this->getInstance("Immutable String.");
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
     * @return void
     */
    public function testSubStringCanBeRetrievedWithLength(): void
    {
        // Performs test.
        $original = $this->getInstance("Immutable String.");
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
     * @return void
     */
    public function testSubStringCanBeRetrievedWithNegativeLength(): void
    {
        // Performs test.
        $original = $this->getInstance("Immutable String.");
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
     * @return void
     */
    public function testSubStringBreaksWithShortStart(): void
    {
        // Creates expectation.
        $this->expectException(\OutOfRangeException::class);

        // Performs test.
        $original = $this->getInstance("Immutable String.");
        $original->subString(-30);
    }

    /**
     * Tests that substring breaks.
     *
     * @return void
     */
    public function testSubStringBreaksWithLongStart(): void
    {
        // Creates expectation.
        $this->expectException(\OutOfRangeException::class);

        // Performs test.
        $original = $this->getInstance("Immutable String.");
        $original->subString(30);
    }

    /**
     * Tests that substring breaks.
     *
     * @return void
     */
    public function testSubStringBreaksWithShortLength(): void
    {
        // Creates expectation.
        $this->expectException(\OutOfRangeException::class);

        // Performs test.
        $original = $this->getInstance("Immutable String.");
        $original->subString(0, -30);
    }

    /**
     * Tests that substring breaks.
     *
     * @return void
     */
    public function testSubStringBreaksWithLongLength(): void
    {
        // Creates expectation.
        $this->expectException(\OutOfRangeException::class);

        // Performs test.
        $original = $this->getInstance("Immutable String.");
        $original->subString(0, 30);
    }

    /**
     * Tests that a simple subLeft can be retrieved.
     *
     * @return void
     */
    public function testSubStringLeftCanBeRetrieved(): void
    {
        // Performs test.
        $original = $this->getInstance("Immutable String.");
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
     * @return void
     */
    public function testSubStringLeftBreaksWithShortLength(): void
    {
        // Creates expectation.
        $this->expectException(\InvalidArgumentException::class);

        // Performs test.
        $original = $this->getInstance("Immutable String.");
        $original->subLeft(-1);
    }

    /**
     * Tests that subLeft() breaks.
     *
     * @return void
     */
    public function testSubStringLeftBreaksWithLongLength(): void
    {
        // Creates expectation.
        $this->expectException(\OutOfRangeException::class);

        // Performs test.
        $original = $this->getInstance("Immutable String.");
        $original->subLeft(30);
    }

    /**
     * Tests that a simple subRight() can be retrieved.
     *
     * @return void
     */
    public function testSubStringRightCanBeRetrieved(): void
    {
        // Performs test.
        $original = $this->getInstance("Immutable String.");
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
     * @return void
     */
    public function testSubStringRightBreaksWithShortLength(): void
    {
        // Creates expectation.
        $this->expectException(\InvalidArgumentException::class);

        // Performs test.
        $original = $this->getInstance("Immutable String.");
        $original->subRight(-1);
    }

    /**
     * Tests that subRight() breaks.
     *
     * @return void
     */
    public function testSubStringRightBreaksWithLongLength(): void
    {
        // Creates expectation.
        $this->expectException(\OutOfRangeException::class);

        // Performs test.
        $original = $this->getInstance("Immutable String.");
        $original->subRight(30);
    }

    /**
     * Tests that a string can be reversed.
     *
     * @return void
     */
    public function testStringCanBeReversed(): void
    {
        // Performs test.
        $original = $this->getInstance("Immutable String.");
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
     * @return void
     */
    public function testTextCanBeReplacedInString(): void
    {
        // Performs test.
        $original = $this->getInstance("Immutable String.");
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
     * @return void
     */
    public function testTextIsNotReplacedIfSearchNotFound(): void
    {
        // Performs test.
        $original = $this->getInstance("Immutable String.");
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
     * @return void
     */
    public function testTextReplaceBreaksIfSearchIsEmpty(): void
    {
        // Creates expectation.
        $this->expectException(\InvalidArgumentException::class);

        // Performs test.
        $original = $this->getInstance("Immutable String.");
        $original->replace('', 'Object');
    }
}
