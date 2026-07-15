<?php

declare(strict_types=1);

namespace HraDigital\Tests\Datatypes\Unit\ValueObjects;

use HraDigital\Datatypes\Exceptions\Datatypes\PositiveIntegerException;
use HraDigital\Datatypes\ValueObjects\Pagination;
use HraDigital\Tests\Datatypes\AbstractBaseTestCase;

/**
 * Pagination Unit testing.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
class PaginationTest extends AbstractBaseTestCase
{
    public function testCreatesWithDefaults(): void
    {
        $pagination = new Pagination();

        $this->assertSame(1, $pagination->getPage());
        $this->assertSame(Pagination::DEFAULT_PAGE_SIZE, $pagination->getPageSize());
        $this->assertSame('ASC', $pagination->getOrder());
    }

    public function testCreatesWithSuppliedValues(): void
    {
        $pagination = new Pagination(3, 50, false);

        $this->assertSame(3, $pagination->getPage());
        $this->assertSame(50, $pagination->getPageSize());
        $this->assertSame('DESC', $pagination->getOrder());
    }

    public function testStartRecordIsZeroOnFirstPage(): void
    {
        $pagination = new Pagination(1, 25);

        $this->assertSame(0, $pagination->getStartRecord());
    }

    public function testStartRecordOffsetsBySizeTimesPreviousPages(): void
    {
        $pagination = new Pagination(4, 25);

        $this->assertSame(75, $pagination->getStartRecord());
    }

    public function testClampsPageSizeToMaxResults(): void
    {
        $pagination = new Pagination(1, Pagination::MAX_RESULTS + 1);

        $this->assertSame(Pagination::MAX_RESULTS, $pagination->getPageSize());
    }

    public function testAcceptsPageSizeAtMaxResults(): void
    {
        $pagination = new Pagination(1, Pagination::MAX_RESULTS);

        $this->assertSame(Pagination::MAX_RESULTS, $pagination->getPageSize());
    }

    public function testClampsPageSoWindowNeverStartsBeyondMaxOffset(): void
    {
        $pagination = new Pagination(9999, 100);

        $this->assertSame(1000, $pagination->getPage());
        $this->assertLessThanOrEqual(
            Pagination::MAX_OFFSET,
            ($pagination->getPage() * $pagination->getPageSize())
        );
    }

    public function testDoesNotClampPageWithinMaxOffset(): void
    {
        $pagination = new Pagination(10, 100);

        $this->assertSame(10, $pagination->getPage());
    }

    public function testThrowsPositiveIntegerExceptionForZeroPage(): void
    {
        $this->expectException(PositiveIntegerException::class);

        new Pagination(0);
    }

    public function testThrowsPositiveIntegerExceptionForNegativePage(): void
    {
        $this->expectException(PositiveIntegerException::class);

        new Pagination(-1);
    }

    public function testThrowsPositiveIntegerExceptionForZeroPageSize(): void
    {
        $this->expectException(PositiveIntegerException::class);

        new Pagination(1, 0);
    }

    public function testThrowsPositiveIntegerExceptionForNegativePageSize(): void
    {
        $this->expectException(PositiveIntegerException::class);

        new Pagination(1, -25);
    }

    public function testNextPageReturnsNewInstanceOnFollowingPage(): void
    {
        $pagination = new Pagination(2, 50, false);
        $next = $pagination->nextPage();

        $this->assertNotSame($pagination, $next);
        $this->assertSame(3, $next->getPage());
        $this->assertSame(50, $next->getPageSize());
        $this->assertSame('DESC', $next->getOrder());
        $this->assertSame(2, $pagination->getPage());
    }

    public function testWithPageSizeReturnsNewInstanceKeepingPageAndOrder(): void
    {
        $pagination = new Pagination(2, 50, false);
        $resized = $pagination->withPageSize(10);

        $this->assertNotSame($pagination, $resized);
        $this->assertSame(2, $resized->getPage());
        $this->assertSame(10, $resized->getPageSize());
        $this->assertSame('DESC', $resized->getOrder());
        $this->assertSame(50, $pagination->getPageSize());
    }

    public function testEqualsReturnsTrueForIdenticalValues(): void
    {
        $a = new Pagination(2, 50, false);
        $b = new Pagination(2, 50, false);

        $this->assertTrue($a->equals($b));
    }

    public function testEqualsReturnsFalseForDifferentOrder(): void
    {
        $a = new Pagination(2, 50, true);
        $b = new Pagination(2, 50, false);

        $this->assertFalse($a->equals($b));
    }

    public function testEqualsReturnsFalseForDifferentPage(): void
    {
        $a = new Pagination(2, 50);
        $b = new Pagination(3, 50);

        $this->assertFalse($a->equals($b));
    }

    public function testToArrayExposesPrimitiveState(): void
    {
        $pagination = new Pagination(2, 50, false);

        $this->assertSame(
            [
                'page'     => 2,
                'pageSize' => 50,
                'order'    => 'DESC',
            ],
            $pagination->toArray()
        );
    }

    public function testJsonSerializesToItsArrayShape(): void
    {
        $pagination = new Pagination(2, 50, false);

        $this->assertSame(
            \json_encode($pagination->toArray()),
            \json_encode($pagination)
        );
    }
}
