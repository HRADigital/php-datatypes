<?php

declare(strict_types=1);

namespace HraDigital\Tests\Datatypes\Unit\Scalar;

use HraDigital\Datatypes\Exceptions\Datatypes\NonEmptyStringException;
use HraDigital\Datatypes\Exceptions\Datatypes\ParameterOutOfRangeException;
use HraDigital\Datatypes\Scalar\AbstractBaseString;
use HraDigital\Datatypes\Scalar\Str;
use HraDigital\Tests\Datatypes\AbstractBaseTestCase;

/**
 * String's Scalar Native/Primitive Object Unit testing.
 *
 * @package   Hradigital\Datatypes
 * @copyright Hradigital\Datatypes
 * @license   MIT
 */
class StrTest extends AbstractBaseTestCase
{
    /** @inheritDoc */
    protected function getInstance(string $initialValue): Str
    {
        return Str::create($initialValue);
    }

    /** @inheritDoc */
    protected function checkDifferentInstances(Str $original, Str $other): void
    {
        $this->assertFalse(
            ($original === $other),
            'Instances are not meant to match.'
        );
    }

    /** @inheritDoc */
    protected function checkCorrectInstanceType(Str $instance): void
    {
        $this->assertInstanceOf(
            Str::class,
            $instance,
            'Instance type, does not match Str.'
        );
    }

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
            $instance->getLength(),
            'Instance character length does not seam to match.'
        );
    }

    /**
     * Checks that String's word count retrieval works.
     *
     * @return void
     */
    public function testCanRetrieveWordCountCorrectly(): void
    {
        // Performs test.
        $string = "This is my immutable string.";
        $instance = $this->getInstance($string);

        // Performs assertions.
        $this->assertEquals(
            5,
            $instance->getWordCount(),
            'Instance word  count does not seam to match.'
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

    /**
     * Checks Matching between two distinct strings.
     *
     * @return void
     */
    public function testCanCheckMatching(): void
    {
        // Performs test.
        $original = $this->getInstance("  Immutable string.  ");
        $other    = $this->getInstance("  Immutable string.  ");

        // Performs assertions.
        $this->assertTrue(
            $original->match($other),
            'Instance values do not match.'
        );
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

        // Performs assertions.
        $this->assertTrue(
            $original->equals("  Immutable string.  "),
            'Instance values do not match.'
        );
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
    public function testBreaksCheckingIfStringContainsPortionWithEmptyText(): void
    {
        // Performs test.
        $original = $this->getInstance("Immutable string.");

        // Create expectations.
        $this->expectException(NonEmptyStringException::class);

        // Performs test.
        $original->contains('');
    }

    /**
     * Test indexOf() method.
     *
     * @return void
     */
    public function testCanRetrieveIndexOf(): void
    {
        // Performs test.
        $instance = $this->getInstance("Immutable string.");
        $indexOf  = $instance->indexOf('string');

        // Performs assertions.
        $this->assertEquals(
            10,
            $indexOf,
            'Retrieved index is incorrect.'
        );
    }

    /**
     * Test indexOf() method.
     *
     * @return void
     */
    public function testCanRetrieveIndexOfWithStart(): void
    {
        // Performs test.
        $instance = $this->getInstance("Immutable string, or part of another string.");
        $indexOf  = $instance->indexOf('string', 15);

        // Performs assertions.
        $this->assertEquals(
            37,
            $indexOf,
            'Retrieved index is incorrect.'
        );
    }

    /**
     * Test indexOf() method.
     *
     * @return void
     */
    public function testIndexOfReturnsNullIfNotFound(): void
    {
        // Performs test.
        $instance = $this->getInstance("Immutable string.");
        $indexOf  = $instance->indexOf('another');

        // Performs assertions.
        $this->assertNull(
            $indexOf,
            'Retrieved index should have been NULL.'
        );
    }

    /**
     * Test indexOf() breaks with illegal parameters.
     *
     * @return void
     */
    public function testBreaksIndexOfIfEmptySearch(): void
    {
        // Creates expectation.
        $this->expectException(NonEmptyStringException::class);

        // Performs test.
        $instance = $this->getInstance("Immutable string.");
        $instance->indexOf('');
    }

    /**
     * Tests that we can check is a string begins with a given text.
     *
     * @return void
     */
    public function testCanCheckIfStringStartsWithText(): void
    {
        // Performs test.
        $instance = $this->getInstance("Immutable string.");
        $true  = $instance->startsWith("Immu");
        $false = $instance->startsWith("string");

        // Performs assertions.
        $this->assertTrue($true, 'String should have started with searched text.');
        $this->assertFalse($false, 'String should not have started with searched text.');
    }

    /**
     * Tests that we can check is a string begins with a given text.
     *
     * @return void
     */
    public function testBreaksCheckingIfStringStartsWithText(): void
    {
        // Creates expectation.
        $this->expectException(NonEmptyStringException::class);

        // Performs test.
        $instance = $this->getInstance("Immutable string.");
        $instance->startsWith('');
    }

    /**
     * Tests that we can check is a string begins with a given text.
     *
     * @return void
     */
    public function testCanCheckIfStringEndsWithText(): void
    {
        // Performs test.
        $instance = $this->getInstance("Immutable string.");
        $true  = $instance->endsWith("string.");
        $false = $instance->endsWith("Immu");

        // Performs assertions.
        $this->assertTrue($true, 'String should have ended with searched text.');
        $this->assertFalse($false, 'String should not have ended with searched text.');
    }

    /**
     * Tests that we can check is a string begins with a given text.
     *
     * @return void
     */
    public function testBreaksCheckingIfStringEndsWithText(): void
    {
        // Creates expectation.
        $this->expectException(NonEmptyStringException::class);

        // Performs test.
        $instance = $this->getInstance("Immutable string.");
        $instance->endsWith('');
    }

    /**
     * Tests count() method.
     *
     * @return void
     */
    public function testCanCountNumberOccurencesInString(): void
    {
        // Performs test.
        $instance = $this->getInstance("Immutable string, or part of another string.");
        $count = $instance->count('string');

        // Performs assertions.
        $this->assertEquals(
            2,
            $count,
            'Retrieved count is incorrect.'
        );
    }

    /**
     * Tests count() method.
     *
     * @return void
     */
    public function testCanCountNumberOccurencesInStringWithStartAndLength(): void
    {
        // Performs test.
        $instance = $this->getInstance("Immutable string, or part of another string.");
        $count = $instance->count('string', 15, 29);

        // Performs assertions.
        $this->assertEquals(
            1,
            $count,
            'Retrieved count is incorrect.'
        );
    }

    /**
     * Tests count() method.
     *
     * @return void
     */
    public function testCanCountNumberOccurencesInStringIfNoneIsFound(): void
    {
        // Performs test.
        $instance = $this->getInstance("Immutable string, or part of another string.");
        $count = $instance->count('string', 38, 4);

        // Performs assertions.
        $this->assertEquals(
            0,
            $count,
            'Retrieved count is incorrect.'
        );
    }

    /**
     * Tests count() breaks if empty search is supplied.
     *
     * @return void
     */
    public function testBreaksCountNumberOccurencesInStringIfSerachIsEmpty(): void
    {
        // Creates expectation.
        $this->expectException(NonEmptyStringException::class);

        // Performs test.
        $instance = $this->getInstance("Immutable string, or part of another string.");
        $instance->count('');
    }

    /**
     * Tests that padding breaks.
     *
     * @return void
     */
    public function testBreaksPaddingOnTheLeftWithInvalidPadString(): void
    {
        // Creates expectation.
        $this->expectException(NonEmptyStringException::class);

        // Performs test.
        $original = $this->getInstance("Immutable String.");
        $original->padLeft(2, '');
    }

    /**
     * Tests that padding breaks.
     *
     * @return void
     */
    public function testBreaksCanPaddingOnTheLeftExtraWithInvalidPadString(): void
    {
        // Creates expectation.
        $this->expectException(NonEmptyStringException::class);

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
    public function testCanPadOnTheLeftExtraWidthCharacter(): void
    {
        // Performs test.
        $string   = "Immutable String.";
        $original = $this->getInstance($string);
        $other    = $original->padLeftExtra(2, '_');

        // Performs assertions.
        $this->assertEquals(
            '__Immutable String.',
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
    public function testBreaksCanPadOnTheRightWithInvalidPadString(): void
    {
        // Creates expectation.
        $this->expectException(NonEmptyStringException::class);

        // Performs test.
        $original = $this->getInstance("Immutable String.");
        $original->padRight(2, '');
    }

    /**
     * Tests that padding breaks.
     *
     * @return void
     */
    public function testBreaksCanPadOnTheRightExtraWithInvalidPadString(): void
    {
        // Creates expectation.
        $this->expectException(NonEmptyStringException::class);

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
    public function testCanPadOnTheRightExtraWidthCharacter(): void
    {
        // Performs test.
        $string   = "Immutable String.";
        $original = $this->getInstance($string);
        $other    = $original->padRightExtra(2, '_');

        // Performs assertions.
        $this->assertEquals(
            'Immutable String.__',
            (string) $other,
            'Instance values do not match.'
        );
        $this->checkCorrectInstanceType($other);
        $this->checkDifferentInstances($original, $other);
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
            (string) $other,
            'Instance values do not match.'
        );
        $this->checkCorrectInstanceType($other);
        $this->checkDifferentInstances($original, $other);
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
            (string) $original,
            (string) $other,
            'Instance values do not match.'
        );
        $this->checkCorrectInstanceType($other);
        $this->checkDifferentInstances($original, $other);
    }

    /**
     * Tests that text replace breaks.
     *
     * @return void
     */
    public function testBreaksTextReplaceIfSearchIsEmpty(): void
    {
        // Creates expectation.
        $this->expectException(NonEmptyStringException::class);

        // Performs test.
        $original = $this->getInstance("Immutable String.");
        $original->replace('', 'Object');
    }

    /**
     * Tests that text replace breaks.
     *
     * @return void
     */
    public function testBreaksTextReplaceIfReplaceIsEmpty(): void
    {
        // Creates expectation.
        $this->expectException(NonEmptyStringException::class);

        // Performs test.
        $original = $this->getInstance("Immutable String.");
        $original->replace('Object', '');
    }

    /**
     * Tests that text can be exploded into an array.
     *
     * @return void
     */
    public function testTextCanBeExplodedIntoAnArray(): void
    {
        // Performs test.
        $original = $this->getInstance("This is an immutable String.");
        $array = $original->explode(' ');

        // Performs assertions.
        $this->assertIsArray($array);
        $this->assertCount(5, $array);
    }

    /**
     * Tests that text can be exploded into an array.
     *
     * @return void
     */
    public function testTextCanBeExplodedIntoAnArrayWithLimit(): void
    {
        // Performs test.
        $original = $this->getInstance("This is an immutable String.");
        $array = $original->explode(' ', 3);

        // Performs assertions.
        $this->assertIsArray($array);
        $this->assertCount(3, $array);
    }

    /**
     * Tests that text is not replaced if search is not found.
     *
     * @return void
     */
    public function testBreaksIfReplacementIsEmpty(): void
    {
        // Creates expectation.
        $this->expectException(NonEmptyStringException::class);

        // Performs test.
        $original = $this->getInstance("This is an immutable String.");
        $original->explode('');
    }
}
