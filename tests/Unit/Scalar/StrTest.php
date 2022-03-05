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
class StrTest extends AbstractBaseStringTestBase
{
    /** @inheritDoc */
    protected function getInstance(string $initialValue): AbstractBaseString
    {
        return Str::create($initialValue);
    }

    /** @inheritDoc */
    protected function checkDifferentInstances(AbstractBaseString $original, AbstractBaseString $other): void
    {
        $this->assertFalse(
            ($original === $other),
            'Instances are not meant to match.'
        );
    }

    /** @inheritDoc */
    protected function checkCorrectInstanceType(AbstractBaseString $instance): void
    {
        $this->assertInstanceOf(
            Str::class,
            $instance,
            'Instance type, does not match Str.'
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
        $other    = $this->getInstance("  Immutable string.  ");

        // Performs assertions.
        $this->assertTrue(
            $original->equals($other),
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
            $original->contains(
                $this->getInstance('muta')
            ),
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
        $original->contains(
            $this->getInstance('')
        );
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
        $indexOf  = $instance->indexOf(
            $this->getInstance('string')
        );

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
        $indexOf  = $instance->indexOf(
            $this->getInstance('string'),
            15
        );

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
        $indexOf  = $instance->indexOf(
            $this->getInstance('another')
        );

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
        $instance->indexOf($this->getInstance(''));
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
        $true  = $instance->startsWith($this->getInstance("Immu"));
        $false = $instance->startsWith($this->getInstance("string"));

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
        $instance->startsWith($this->getInstance(''));
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
        $true  = $instance->endsWith($this->getInstance("string."));
        $false = $instance->endsWith($this->getInstance("Immu"));

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
        $instance->endsWith($this->getInstance(''));
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
        $count = $instance->count($this->getInstance('string'));

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
        $count = $instance->count($this->getInstance('string'), 15, 29);

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
        $count = $instance->count($this->getInstance('string'), 38, 4);

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
        $instance->count($this->getInstance(''));
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
        $original->padLeft(2, $this->getInstance(''));
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
        $original->padLeftExtra(2, $this->getInstance(''));
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
        $other    = $original->padLeft(\strlen($string) + 2, $this->getInstance('_'));

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
        $other    = $original->padLeftExtra(2, $this->getInstance('_'));

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
        $original->padRight(2, $this->getInstance(''));
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
        $original->padRightExtra(2, $this->getInstance(''));
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
        $other    = $original->padRight(\strlen($string) + 2, $this->getInstance('_'));

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
        $other    = $original->padRightExtra(2, $this->getInstance('_'));

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
        $other    = $original->replace(
            $this->getInstance('String'),
            $this->getInstance('Object')
        );

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
        $other    = $original->replace(
            $this->getInstance('None'),
            $this->getInstance('Object')
        );

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
        $original->replace($this->getInstance(''), $this->getInstance('Object'));
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
        $original->replace($this->getInstance('Object'), $this->getInstance(''));
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
