<?php

declare(strict_types=1);

namespace HraDigital\Tests\Datatypes\Unit\Web\Markup;

use HraDigital\Datatypes\Web\Markup\MarkupConfiguration;
use HraDigital\Tests\Datatypes\AbstractBaseTestCase;
use InvalidArgumentException;

/**
 * MarkupConfiguration Unit testing.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
class MarkupConfigurationTest extends AbstractBaseTestCase
{
    public function testCreatesWithPositiveInteger(): void
    {
        $config = new MarkupConfiguration(sentencesPerParagraph: 3);

        $this->assertSame(3, $config->sentencesPerParagraph);
    }

    public function testCreatesWithOne(): void
    {
        $config = new MarkupConfiguration(sentencesPerParagraph: 1);

        $this->assertSame(1, $config->sentencesPerParagraph);
    }

    public function testThrowsWhenSentencesPerParagraphIsZero(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new MarkupConfiguration(sentencesPerParagraph: 0);
    }

    public function testThrowsWhenSentencesPerParagraphIsNegative(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new MarkupConfiguration(sentencesPerParagraph: -1);
    }
}
