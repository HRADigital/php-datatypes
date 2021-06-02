<?php declare(strict_types=1);

namespace Hradigital\Tests\Datatypes\Unit\Scalar;

use Hradigital\Datatypes\Exceptions\Datatypes\NonEmptyStringException;
use Hradigital\Datatypes\Exceptions\Datatypes\ParameterOutOfRangeException;
use Hradigital\Datatypes\Scalar\AbstractBaseString;
use Hradigital\Datatypes\Scalar\NString;
use Hradigital\Tests\Datatypes\AbstractBaseTestCase;

/**
 * Tests shared functionality for all child classes inherting from AbstractBaseString.
 *
 * @package   Hradigital\Datatypes
 * @license   MIT
 */
abstract class AbstractBaseStringTestBase extends AbstractBaseTestCase
{
    /**
     * Initializes and returns a new instance for testing.
     *
     * This method has no return value, due to inheritance overriding.
     *
     * @param  string $initialValue - Instance's initial value.
     *
     * @return AbstractBaseString
     */
    abstract protected function getInstance(string $initialValue): AbstractBaseString;

    /**
     * Asserts that 2 string instances do not match.
     *
     * @param  AbstractBaseString $original - Original String instance.
     * @param  AbstractBaseString $other    - Second instance for comparison.
     *
     * @return void
     */
    abstract protected function checkDifferentInstances(AbstractBaseString $original, AbstractBaseString $other): void;

    /**
     * Asserts that the supplied instance, is from the correct type.
     *
     * @param  AbstractBaseString $instance - Instance to be validated.
     *
     * @return void
     */
    abstract protected function checkCorrectInstanceType(AbstractBaseString $instance): void;

    /**
     * Checks that Instance loads and holds value correctly.
     *
     * @return void
     */
    public function checkLoadsDataCorrectly(): void
    {
        // Performs test.
        $string = "  Immutable string.  ";
        $instance = $this->getInstance($string);

        // Performs assertions.
        $this->assertEquals(
            $string,
            (string) $instance,
            'Instance value does not seam to match.'
        );
        $this->checkCorrectInstanceType($instance);
    }

    /**
     * Checks that String's length retrieval works.
     *
     * @return void
     */
    public function testCanRetrieveLengthCorrectly(): void
    {
        // Performs test.
        $string = "  Immutable string.  ";
        $instance = $this->getInstance($string);

        // Performs assertions.
        $this->assertEquals(
            \strlen($string),
            $instance->length(),
            'Instance character length does not seam to match.'
        );
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
            (string) $other,
            'Instance values do not match.'
        );
        $this->checkCorrectInstanceType($other);
        $this->checkDifferentInstances($original, $other);
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
            (string) $other,
            'Instance values do not match.'
        );
        $this->checkCorrectInstanceType($other);
        $this->checkDifferentInstances($original, $other);
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
            (string) $other,
            'Instance values do not match.'
        );
        $this->checkCorrectInstanceType($other);
        $this->checkDifferentInstances($original, $other);
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
            (string) $other,
            'Instance values do not match.'
        );
        $this->checkCorrectInstanceType($other);
        $this->checkDifferentInstances($original, $other);
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
            (string) $other,
            'Instance values do not match.'
        );
        $this->checkCorrectInstanceType($other);
        $this->checkDifferentInstances($original, $other);
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
            (string) $other,
            'Instance values do not match.'
        );
        $this->checkCorrectInstanceType($other);
        $this->checkDifferentInstances($original, $other);
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
            (string) $other,
            'Instance values do not match.'
        );
        $this->checkCorrectInstanceType($other);
        $this->checkDifferentInstances($original, $other);
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
            (string) $other,
            'Instance values do not match.'
        );
        $this->checkCorrectInstanceType($other);
        $this->checkDifferentInstances($original, $other);
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
            (string) $other,
            'Instance values do not match.'
        );
        $this->checkCorrectInstanceType($other);
        $this->checkDifferentInstances($original, $other);
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
            (string) $other,
            'Instance values do not match.'
        );
        $this->checkCorrectInstanceType($other);
        $this->checkDifferentInstances($original, $other);
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
            (string) $other,
            'Instance values do not match.'
        );
        $this->checkCorrectInstanceType($other);
        $this->checkDifferentInstances($original, $other);
    }

    /**
     * Tests that padding breaks.
     *
     * @return void
     */
    public function testBreaksPaddingOnTheLeftWithInvalidLength(): void
    {
        // Creates expectation.
        $this->expectException(ParameterOutOfRangeException::class);

        // Performs test.
        $original = $this->getInstance("Immutable String.");
        $original->padLeft(0);
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
            (string) $other,
            'Instance values do not match.'
        );
        $this->checkCorrectInstanceType($other);
        $this->checkDifferentInstances($original, $other);
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
            (string) $other,
            'Instance values do not match.'
        );
        $this->checkCorrectInstanceType($other);
        $this->checkDifferentInstances($original, $other);
    }

    /**
     * Tests that padding breaks.
     *
     * @return void
     */
    public function testCanPadOnTheRightBreaksWithInvalidLength(): void
    {
        // Creates expectation.
        $this->expectException(ParameterOutOfRangeException::class);

        // Performs test.
        $original = $this->getInstance("Immutable String.");
        $original->padRight(0);
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
            (string) $other,
            'Instance values do not match.'
        );
        $this->checkCorrectInstanceType($other);
        $this->checkDifferentInstances($original, $other);
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
            (string) $other,
            'Instance values do not match.'
        );
        $this->checkCorrectInstanceType($other);
        $this->checkDifferentInstances($original, $other);
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
            (string) $other,
            'Instance values do not match.'
        );
        $this->checkCorrectInstanceType($other);
        $this->checkDifferentInstances($original, $other);
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
            (string) $other,
            'Instance values do not match.'
        );
        $this->checkCorrectInstanceType($other);
        $this->checkDifferentInstances($original, $other);
    }

    /**
     * Tests that substring breaks.
     *
     * @return void
     */
    public function testBreaksSubStringWithShortStart(): void
    {
        // Creates expectation.
        $this->expectException(ParameterOutOfRangeException::class);

        // Performs test.
        $original = $this->getInstance("Immutable String.");
        $original->subString(-30);
    }

    /**
     * Tests that substring breaks.
     *
     * @return void
     */
    public function testBreaksSubStringWithLongStart(): void
    {
        // Creates expectation.
        $this->expectException(ParameterOutOfRangeException::class);

        // Performs test.
        $original = $this->getInstance("Immutable String.");
        $original->subString(30);
    }

    /**
     * Tests that substring breaks.
     *
     * @return void
     */
    public function testBreaksSubStringWithShortLength(): void
    {
        // Creates expectation.
        $this->expectException(ParameterOutOfRangeException::class);

        // Performs test.
        $original = $this->getInstance("Immutable String.");
        $original->subString(0, -30);
    }

    /**
     * Tests that substring breaks.
     *
     * @return void
     */
    public function testBreaksSubStringWithLongLength(): void
    {
        // Creates expectation.
        $this->expectException(ParameterOutOfRangeException::class);

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
            (string) $other,
            'Instance values do not match.'
        );
        $this->checkCorrectInstanceType($other);
        $this->checkDifferentInstances($original, $other);
    }

    /**
     * Tests that subLeft() breaks.
     *
     * @return void
     */
    public function testBreaksSubStringLeftWithShortLength(): void
    {
        // Creates expectation.
        $this->expectException(ParameterOutOfRangeException::class);

        // Performs test.
        $original = $this->getInstance("Immutable String.");
        $original->subLeft(-1);
    }

    /**
     * Tests that subLeft() breaks.
     *
     * @return void
     */
    public function testBreaksSubStringLeftWithLongLength(): void
    {
        // Creates expectation.
        $this->expectException(ParameterOutOfRangeException::class);

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
            (string) $other,
            'Instance values do not match.'
        );
        $this->checkCorrectInstanceType($other);
        $this->checkDifferentInstances($original, $other);
    }

    /**
     * Tests that subRight() breaks.
     *
     * @return void
     */
    public function testBreaksSubStringRightWithShortLength(): void
    {
        // Creates expectation.
        $this->expectException(ParameterOutOfRangeException::class);

        // Performs test.
        $original = $this->getInstance("Immutable String.");
        $original->subRight(-1);
    }

    /**
     * Tests that subRight() breaks.
     *
     * @return void
     */
    public function testBreaksSubStringRightWithLongLength(): void
    {
        // Creates expectation.
        $this->expectException(ParameterOutOfRangeException::class);

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
            (string) $other,
            'Instance values do not match.'
        );
        $this->checkCorrectInstanceType($other);
        $this->checkDifferentInstances($original, $other);
    }
}
