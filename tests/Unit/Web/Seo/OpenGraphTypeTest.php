<?php

declare(strict_types=1);

namespace HraDigital\Tests\Datatypes\Unit\Web\Seo;

use HraDigital\Datatypes\Web\Seo\OpenGraphType;
use HraDigital\Tests\Datatypes\AbstractBaseTestCase;

/**
 * OpenGraphType Unit testing.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
class OpenGraphTypeTest extends AbstractBaseTestCase
{
    public function testWebsiteValue(): void
    {
        $this->assertSame('website', OpenGraphType::Website->value);
    }

    public function testArticleValue(): void
    {
        $this->assertSame('article', OpenGraphType::Article->value);
    }

    public function testFromValueReturnsCorrectCase(): void
    {
        $this->assertSame(OpenGraphType::Profile, OpenGraphType::from('profile'));
    }

    public function testAllCasesHaveNonEmptyValues(): void
    {
        foreach (OpenGraphType::cases() as $case) {
            $this->assertNotEmpty($case->value, \sprintf('Case %s has empty value.', $case->name));
        }
    }
}
