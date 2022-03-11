<?php

declare(strict_types=1);

namespace HraDigital\Tests\Datatypes\Unit\Traits\Entities;

use HraDigital\Datatypes\Exceptions\Datatypes\InvalidStringLengthException;
use HraDigital\Datatypes\Exceptions\Datatypes\NonEmptyStringException;
use HraDigital\Datatypes\Exceptions\Datatypes\NonNegativeNumberException;
use HraDigital\Datatypes\Exceptions\Datatypes\PositiveIntegerException;
use HraDigital\Datatypes\Traits\Entities\General\HasActiveTrait;
use HraDigital\Datatypes\Traits\Entities\General\HasAliasTrait;
use HraDigital\Datatypes\Traits\Entities\General\HasCreatedAtTrait;
use HraDigital\Datatypes\Traits\Entities\General\HasDeletedAtTrait;
use HraDigital\Datatypes\Traits\Entities\General\HasEmailTrait;
use HraDigital\Datatypes\Traits\Entities\General\HasFeatureTrait;
use HraDigital\Datatypes\Traits\Entities\General\HasHitsTrait;
use HraDigital\Datatypes\Traits\Entities\General\HasNameTrait;
use HraDigital\Datatypes\Traits\Entities\General\HasOrderingTrait;
use HraDigital\Datatypes\Traits\Entities\General\HasPasswordTrait;
use HraDigital\Datatypes\Traits\Entities\General\HasPositiveIntegerIDTrait;
use HraDigital\Datatypes\Traits\Entities\General\HasPublishedTrait;
use HraDigital\Datatypes\Traits\Entities\General\HasSeoFieldsTrait;
use HraDigital\Datatypes\Traits\Entities\General\HasTitleTrait;
use HraDigital\Datatypes\Traits\Entities\General\HasUpdatableUpdatedAtTrait;
use HraDigital\Datatypes\Traits\Entities\General\HasUuidTrait;
use HraDigital\Datatypes\ValueObjects\AbstractValueObject;
use HraDigital\Tests\Datatypes\AbstractBaseTestCase;

/**
 * Testing Value Object for General Entity Traits.
 *
 * @package   Hradigital\Datatypes
 * @copyright Hradigital\Datatypes
 * @license   MIT
 */
class GeneralTraitsVOTest extends AbstractBaseTestCase
{
    const DATA = [
        'id' => 54321,
        'active' => true,
        'is_featured' => true,
        'is_published' => true,
        'alias' => 'some_alias',
        'created_at' => '2022-01-20 12:30:00',
        'deleted_at' => null,
        'email' => 'user@domain.tld',
        'hits' => 1999,
        'name' => 'Name of Record',
        'surname' => 'Surname of Record',
        'ordering' => 2,
        'password' => 'usdhciucyneoyhnoerytos8ryt8svyeero8tyvwo8ryt8wryvutt89weysr8ncseryngngc8yeroiyncweryc8f',
        'seo_title' => 'My SEO Title',
        'seo_description' => 'This is a SEO description for the record',
        'seo_keywords' => 'word1, word2, word3',
        'title' => 'Title for the Record',
        'updated_at' => '2022-02-22 12:30:00',
        'deleted_at' => '2022-02-22 12:30:00',
        'uuid' => '123e4567-e89b-12d3-a456-426614174000',
    ];

    public function testLoadsSuccessfully(): void
    {
        $object = new GeneralTraitsVO(self::DATA);

        $this->assertFalse($object->isNew());
        $this->assertTrue($object->isActive());
        $this->assertTrue($object->isFeatured());
        $this->assertTrue($object->isPublished());
        $this->assertTrue($object->isDeleted());

        $this->assertEquals(self::DATA['id'], (string) $object->getId());
        $this->assertEquals(self::DATA['uuid'], (string) $object->getUuid());
        $this->assertEquals(self::DATA['alias'], (string) $object->getAlias());
        $this->assertEquals(self::DATA['email'], (string) $object->getEmail());
        $this->assertEquals(self::DATA['name'], (string) $object->getName());
        $this->assertEquals(self::DATA['surname'], (string) $object->getSurname());
        $this->assertEquals(self::DATA['title'], (string) $object->getTitle());
        $this->assertEquals(self::DATA['password'], (string) $object->getPassword());

        $this->assertEquals(self::DATA['hits'], (string) $object->getHits());
        $this->assertEquals(self::DATA['ordering'], (string) $object->getOrdering());

        $this->assertEquals(self::DATA['seo_title'], (string) $object->getSeoTitle());
        $this->assertEquals(self::DATA['seo_description'], (string) $object->getSeoDescription());
        $this->assertEquals(self::DATA['seo_keywords'], (string) $object->getSeoKeywords());

        $this->assertEquals(self::DATA['created_at'], $object->getCreatedAt()->toDatetimeString());
        $this->assertEquals(self::DATA['updated_at'], $object->getUpdatedAt()->toDatetimeString());
        $this->assertEquals(self::DATA['updated_at'], $object->getDeletedAt()->toDatetimeString());
    }

    public function testLoadsDefaultsSuccessfully(): void
    {
        $data = self::DATA;
        unset(
            $data['id'],
            $data['ordering'],
            $data['hits'],
            $data['is_featured'],
            $data['is_published'],
            $data['active'],
            $data['updated_at'],
            $data['deleted_at'],
            $data['email']
        );

        $object = new GeneralTraitsVO($data);

        $this->assertTrue($object->isNew());
        $this->assertFalse($object->isActive());
        $this->assertFalse($object->isFeatured());
        $this->assertFalse($object->isPublished());

        $this->assertNull($object->getEmail());

        $this->assertEquals(0, $object->getHits());
        $this->assertEquals(0, $object->getOrdering());

        $this->assertFalse($object->isDeleted());
        $this->assertNull($object->getDeletedAt());
        $this->assertNull($object->getUpdatedAt());
    }

    public function testBreaksIfIdIsNegative(): void
    {
        $this->expectException(PositiveIntegerException::class);

        $data = self::DATA;
        $data['id'] = -1;

        new GeneralTraitsVO($data);
    }

    public function testBreaksIfTitleIsEmpty(): void
    {
        $this->expectException(NonEmptyStringException::class);

        $data = self::DATA;
        $data['title'] = '';

        new GeneralTraitsVO($data);
    }

    public function testBreaksIfNameIsEmpty(): void
    {
        $this->expectException(NonEmptyStringException::class);

        $data = self::DATA;
        $data['name'] = '';

        new GeneralTraitsVO($data);
    }

    public function testBreaksIfAliasIsEmpty(): void
    {
        $this->expectException(NonEmptyStringException::class);

        $data = self::DATA;
        $data['alias'] = '';

        new GeneralTraitsVO($data);
    }

    public function testBreaksIfHitsIsNegative(): void
    {
        $this->expectException(NonNegativeNumberException::class);

        $data = self::DATA;
        $data['hits'] = -1;

        new GeneralTraitsVO($data);
    }

    public function testBreaksIfOrderingIsNegative(): void
    {
        $this->expectException(NonNegativeNumberException::class);

        $data = self::DATA;
        $data['ordering'] = -1;

        new GeneralTraitsVO($data);
    }

    public function testBreaksIfSeoTitleTooLong(): void
    {
        $this->expectException(InvalidStringLengthException::class);

        $data = self::DATA;
        $tenCharacterString = 'sodhgfsodh';
        $data['seo_title'] = str_repeat($tenCharacterString, 7) . 'a';

        new GeneralTraitsVO($data);
    }

    public function testBreaksIfSeoDescriptionTooLong(): void
    {
        $this->expectException(InvalidStringLengthException::class);

        $data = self::DATA;
        $tenCharacterString = 'sodhgfsodh';
        $data['seo_description'] = str_repeat($tenCharacterString, 16) . 'a';

        new GeneralTraitsVO($data);
    }

    public function testBreaksIfSeoKeywordsTooLong(): void
    {
        $this->expectException(InvalidStringLengthException::class);

        $data = self::DATA;
        $tenCharacterString = 'sodhgfsodh';
        $data['seo_keywords'] = str_repeat($tenCharacterString, 25) . 'hgfdsa';

        new GeneralTraitsVO($data);
    }

    public function testLoadsNullValueIfSeoFieldEmptyString(): void
    {
        $data = self::DATA;
        $data['seo_title'] = ' ';
        $data['seo_description'] = ' ';
        $data['seo_keywords'] = ' ';

        $object = new GeneralTraitsVO($data);

        $this->assertNull($object->getSeoTitle());
        $this->assertNull($object->getSeoDescription());
        $this->assertNull($object->getSeoKeywords());
    }

    public function testUpdateDateTimeOnUpdateTrigger(): void
    {
        $object = new GeneralTraitsVO(self::DATA);

        $this->assertEquals(self::DATA['updated_at'], $object->getUpdatedAt()->toDatetimeString());
        $object->simulateUpdate();
        $this->assertNotEquals(self::DATA['updated_at'], $object->getUpdatedAt()->toDatetimeString());
    }
}
