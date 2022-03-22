<?php

declare(strict_types=1);

namespace HraDigital\Tests\Datatypes\Unit\Attributes;

use HraDigital\Tests\Datatypes\AbstractBaseTestCase;

/**
 * Testing Value Object for Social Media Entity Traits.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
class SocialMediaTraitsVOTest extends AbstractBaseTestCase
{
    const DATA = [
        'facebook' => 'https://facebook.com/aoihfoiahf',
        'instagram' => 'https://instagram.com/aoihfoiahf',
        'linkedin' => 'https://linkedin.com/aoihfoiahf',
        'twitter' => 'https://twitter.com/aoihfoiahf',
    ];

    public function testLoadsSuccessfully(): void
    {
        $object = new SocialMediaTraitsVO(self::DATA);

        $this->assertEquals(self::DATA['facebook'], (string) $object->getFacebookUrl());
        $this->assertEquals(self::DATA['instagram'], (string) $object->getInstagramUrl());
        $this->assertEquals(self::DATA['linkedin'], (string) $object->getLinkedinUrl());
        $this->assertEquals(self::DATA['twitter'], (string) $object->getTwitterUrl());
        $this->assertTrue($object->hasFacebookProfileUrl());
        $this->assertTrue($object->hasInstagramProfileUrl());
        $this->assertTrue($object->hasLinkedinProfileUrl());
        $this->assertTrue($object->hasTwitterProfileUrl());
    }

    public function testLoadsSuccessfullyWithNoValues(): void
    {
        $object = new SocialMediaTraitsVO([]);

        $this->assertNull($object->getFacebookUrl());
        $this->assertNull($object->getInstagramUrl());
        $this->assertNull($object->getLinkedinUrl());
        $this->assertNull($object->getTwitterUrl());
        $this->assertFalse($object->hasFacebookProfileUrl());
        $this->assertFalse($object->hasInstagramProfileUrl());
        $this->assertFalse($object->hasLinkedinProfileUrl());
        $this->assertFalse($object->hasTwitterProfileUrl());
    }
}
