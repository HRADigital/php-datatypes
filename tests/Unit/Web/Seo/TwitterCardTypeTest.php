<?php

declare(strict_types=1);

namespace HraDigital\Tests\Datatypes\Unit\Web\Seo;

use HraDigital\Datatypes\Web\Seo\TwitterCardType;
use HraDigital\Tests\Datatypes\AbstractBaseTestCase;

/**
 * TwitterCardType Unit testing.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
class TwitterCardTypeTest extends AbstractBaseTestCase
{
    public function testSummaryValue(): void
    {
        $this->assertSame('summary', TwitterCardType::Summary->value);
    }

    public function testSummaryLargeImageValue(): void
    {
        $this->assertSame('summary_large_image', TwitterCardType::SummaryLargeImage->value);
    }

    public function testFromValueReturnsCorrectCase(): void
    {
        $this->assertSame(TwitterCardType::App, TwitterCardType::from('app'));
    }

    public function testAllCasesHaveNonEmptyValues(): void
    {
        foreach (TwitterCardType::cases() as $case) {
            $this->assertNotEmpty($case->value, \sprintf('Case %s has empty value.', $case->name));
        }
    }
}
