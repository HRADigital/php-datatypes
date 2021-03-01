<?php declare(strict_types=1);

namespace Hradigital\Tests\Datatypes\Unit\Scalar;

use Hradigital\Datatypes\Scalar\ReadonlyString;
use Hradigital\Tests\Datatypes\AbstractBaseTestCase;

/**
 * Readonly String Unit testing.
 *
 * @package   Hradigital\Datatypes
 * @license   MIT
 */
class ReadonlyStringTest extends AbstractBaseTestCase
{
    /**
     * Tests that a filled string can be loaded successfully.
     *
     * @return void
     */
    public function testCanSuccessfullyLoadFilledString(): void
    {
        // Performs test.
        $test  = "This is a Testing String";
        $value = ReadonlyString::fromString($test);

        // Performs assertions.
        $this->assertEquals(
            $test,
            $value->__toString(),
            'String value does not seam to match.'
        );
        $this->assertEquals(
            \strlen($test),
            $value->length(),
            'String length does not seam to match.'
        );
    }

    /**
     * Tests that an empty string can be loaded successfully.
     *
     * @return void
     */
    public function testCanSuccessfullyLoadEmptyString(): void
    {
        // Performs test.
        $value = ReadonlyString::fromString("");

        // Performs assertions.
        $this->assertEquals(
            "",
            $value->__toString(),
            'String value does not seam to match.'
        );
        $this->assertEquals(
            0,
            $value->length(),
            'String length does not seam to match.'
        );
    }

    /**
     * Tests instance can be cloned.
     *
     * @return void
     */
    public function testCanCopyInstance(): void
    {
        // Performs test.
        $test   = "This is a Testing String";
        $value1 = ReadonlyString::fromString($test);
        $value2 = $value1->toReadonly();

        // Performs assertions.
        $this->assertTrue(
            ($value1->__toString() === $value2->__toString()),
            "Instance's values should have been equal."
        );
        $this->assertFalse(
            ($value1 === $value2),
            "Instances should not have been the same."
        );
    }

    /**
     * Tests that equal strings are marked as equal.
     *
     * @return void
     */
    public function testCanCompareTwoStringsWithSameValue(): void
    {
        // Performs test.
        $text   = "This is a dummy string.";
        $value1 = ReadonlyString::fromString($text);
        $value2 = ReadonlyString::fromString($text);

        // Performs assertions.
        $this->assertTrue(
            $value1->equals($value2),
            'Both strings should have matched.'
        );
    }

    /**
     * Tests that different strings are not marked as equal.
     *
     * @return void
     */
    public function testCanCompareTwoStringsWithDifferentValue(): void
    {
        // Performs test.
        $text   = "This is a dummy string.";
        $value1 = ReadonlyString::fromString($text);
        $value2 = ReadonlyString::fromString($text . $text);

        // Performs assertions.
        $this->assertFalse(
            $value1->equals($value2),
            'Strings should not have matched.'
        );
    }

    /**
     * Tests that the indexOf of a string works properly.
     *
     * @return void
     */
    public function testIndexOfStringRelatedFunctionality(): void
    {
        // Performs test.
        $text  = "This is a dummy string.";
        $value = ReadonlyString::fromString($text);

        // Performs assertions.
        $this->assertEquals(
            10,
            $value->indexOf("dummy"),
            'String index does not match.'
        );
        $this->assertEquals(
            10,
            $value->indexOf("dummy", -14),
            'String index does not match.'
        );
        $this->assertEquals(
            5,
            $value->indexOf("is", 4),
            'String index does not match.'
        );
        $this->assertNull(
            $value->indexOf("another"),
            'indexOf should have returned NULL.'
        );
        $this->assertTrue(
            $value->contains("is"),
            'String should have contained search.'
        );
        $this->assertFalse(
            $value->contains("another"),
            'String should not have contained search.'
        );
        $this->assertTrue(
            $value->startsWith("This"),
            'String should have started with search.'
        );
        $this->assertFalse(
            $value->startsWith("is"),
            'String should not have started with search.'
        );
        $this->assertTrue(
            $value->endsWith("string."),
            'String should have ended with search.'
        );
        $this->assertFalse(
            $value->endsWith("dummy"),
            'String should not have ended with search.'
        );
    }

    /**
     * Tests that indexOf doesn't accept an empty search.
     *
     * @return void
     */
    public function testIndexOfBreaksWithEmptySearch(): void
    {
        // Creates expectation.
        $this->expectException(\InvalidArgumentException::class);

        // Performs test.
        $value = ReadonlyString::fromString("This is a dummy string.");
        $value->indexOf("");
    }

    /**
     * Tests that indexOf doesn't accept an illegal starting search.
     *
     * @return void
     */
    public function testIndexOfBreaksWithInvalidPositiveStart(): void
    {
        // Creates expectation.
        $this->expectException(\OutOfRangeException::class);

        // Performs test.
        $value = ReadonlyString::fromString("This is a dummy string.");
        $value->indexOf("dummy", 30);
    }

    /**
     * Tests that indexOf doesn't accept an illegal starting search.
     *
     * @return void
     */
    public function testIndexOfBreaksWithInvalidNegativeStart(): void
    {
        // Creates expectation.
        $this->expectException(\OutOfRangeException::class);

        // Performs test.
        $value = ReadonlyString::fromString("This is a dummy string.");
        $value->indexOf("dummy", -30);
    }

    /**
     * Tests that contains() breaks with an empty Search value.
     *
     * @return void
     */
    public function testContainsBreakWithEmptySearch(): void
    {
        // Creates expectation.
        $this->expectException(\InvalidArgumentException::class);

        // Performs test.
        $value = ReadonlyString::fromString("This is a dummy string.");
        $value->contains("");
    }

    /**
     * Tests that startsWith() breaks with an empty Search value.
     *
     * @return void
     */
    public function testStartsWithBreakWithEmptySearch(): void
    {
        // Creates expectation.
        $this->expectException(\InvalidArgumentException::class);

        // Performs test.
        $value = ReadonlyString::fromString("This is a dummy string.");
        $value->startsWith("");
    }

    /**
     * Tests that endsWith() breaks with an empty Search value.
     *
     * @return void
     */
    public function testEndsWithBreakWithEmptySearch(): void
    {
        // Creates expectation.
        $this->expectException(\InvalidArgumentException::class);

        // Performs test.
        $value = ReadonlyString::fromString("This is a dummy string.");
        $value->endsWith("");
    }

    /**
     * Tests that the number of occurrences of a search, can be counted within the string.
     *
     * @return void
     */
    public function testCanCountNumberOfOccurrencesWithinString(): void
    {
        // Performs test.
        $text  = "This is a dummy string.";
        $value = ReadonlyString::fromString($text);

        // Performs assertions.
        $this->assertEquals(
            0,
            $value->count("none"),
            "String count for 'none' does not match."
        );
        $this->assertEquals(
            1,
            $value->count("dummy"),
            "String count for 'dummy' does not match."
        );
        $this->assertEquals(
            2,
            $value->count("is"),
            "String count for 'is' does not match."
        );
        $this->assertEquals(
            1,
            $value->count("is", 4),
            "String count for 'is' does not match."
        );
        $this->assertEquals(
            0,
            $value->count("This", 4, 5),
            "String count for 'This' does not match."
        );
        $this->assertEquals(
            1,
            $value->count("string", -8),
            "String count for 'string' does not match."
        );
        $this->assertEquals(
            1,
            $value->count("dummy", -14, 6),
            "String count for 'dummy' does not match."
        );
        $this->assertEquals(
            1,
            $value->count("dummy", -14, -2),
            "String count for 'dummy' does not match."
        );
    }

    /**
     * Tests that count() breaks with an empty Search value.
     *
     * @return void
     */
    public function testCountBreakWithEmptySearch(): void
    {
        // Creates expectation.
        $this->expectException(\InvalidArgumentException::class);

        // Performs test.
        $value = ReadonlyString::fromString("This is a dummy string.");
        $value->count("");
    }

    /**
     * Tests that count() breaks with long Start value.
     *
     * @return void
     */
    public function testCountBreaksWithLongStart(): void
    {
        // Creates expectation.
        $this->expectException(\OutOfRangeException::class);

        // Performs test.
        $text  = "This is a dummy string.";
        $value = ReadonlyString::fromString($text);
        $value->count("search", (\strlen($text) + 1));
    }

    /**
     * Tests that count() breaks with long negative Start value.
     *
     * @return void
     */
    public function testCountBreaksWithLongNegativeStart(): void
    {
        // Creates expectation.
        $this->expectException(\OutOfRangeException::class);

        // Performs test.
        $text  = "This is a dummy string.";
        $value = ReadonlyString::fromString($text);
        $value->count("search", (0 - \strlen($text) - 1));
    }

    /**
     * Tests that count() breaks with long Length value.
     *
     * @return void
     */
    public function testCountBreaksWithLongLength(): void
    {
        // Creates expectation.
        $this->expectException(\OutOfRangeException::class);

        // Performs test.
        $text  = "This is a dummy string.";
        $value = ReadonlyString::fromString($text);
        $value->count("search", 0, (\strlen($text) + 1));
    }

    /**
     * Tests that count() breaks with long negative Length value.
     *
     * @return void
     */
    public function testCountBreaksWithLongNegativeLength(): void
    {
        // Creates expectation.
        $this->expectException(\OutOfRangeException::class);

        // Performs test.
        $text  = "This is a dummy string.";
        $value = ReadonlyString::fromString($text);
        $value->count("search", 0, (0 - \strlen($text) - 1));
    }

    /**
     * Tests that count() breaks with out of scope Length value.
     *
     * @return void
     */
    public function testCountBreaksWithOutOfScopeLength(): void
    {
        // Creates expectation.
        $this->expectException(\OutOfRangeException::class);

        // Performs test.
        $text  = "This is a dummy string.";
        $value = ReadonlyString::fromString($text);
        $value->count("search", -5, 6);
    }

    /**
     * Tests that count() breaks with out of scope negative Length value.
     *
     * @return void
     */
    public function testCountBreaksWithOutOfScopeNegativeLength(): void
    {
        // Creates expectation.
        $this->expectException(\OutOfRangeException::class);

        // Performs test.
        $text  = "This is a dummy string.";
        $value = ReadonlyString::fromString($text);
        $value->count("search", -5, -6);
    }
}
