<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\ValueObjects;

use HraDigital\Datatypes\Exceptions\Datatypes\PositiveIntegerException;

/**
 * Pagination Value Object for listing queries.
 *
 * Limits the maximum number of records each paginated result can return, through
 * MAX_RESULTS. Also limits the maximum set of records that can be paginated over,
 * through MAX_OFFSET - it will not paginate beyond that number of records.
 *
 * Both limits clamp rather than throw: an out-of-range page size is reduced to
 * MAX_RESULTS, and a page that would read past MAX_OFFSET is pulled back to the
 * last addressable page. Only structurally invalid input (non-positive page or
 * page size) raises.
 *
 * Immutable. nextPage() and withPageSize() return new instances.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
class Pagination implements \JsonSerializable
{
    public const MAX_RESULTS = 1000;
    public const MAX_OFFSET = 100000;
    public const DEFAULT_PAGE_SIZE = 25;

    public readonly int $page;
    public readonly int $pageSize;
    public readonly bool $ascOrder;

    /**
     * @param int  $page     - Page number to retrieve. 1-based.
     * @param int  $pageSize - Number of records per page. Clamped to MAX_RESULTS.
     * @param bool $ascOrder - TRUE for ascending ordering, FALSE for descending.
     *
     * @throws PositiveIntegerException - If $page or $pageSize is not a positive integer.
     */
    public function __construct(
        int $page = 1,
        int $pageSize = self::DEFAULT_PAGE_SIZE,
        bool $ascOrder = true,
    ) {
        if ($page < 1) {
            throw PositiveIntegerException::withName('$page');
        }
        if ($pageSize < 1) {
            throw PositiveIntegerException::withName('$pageSize');
        }

        // Caps the page size to the maximum number of records a single page can carry.
        $pageSize = \min($pageSize, self::MAX_RESULTS);

        // Based on the resolved page size, pulls the page back so the read window
        // never starts beyond MAX_OFFSET.
        if (($page * $pageSize) > self::MAX_OFFSET) {
            $page = \intdiv(self::MAX_OFFSET, $pageSize);
        }

        $this->page = $page;
        $this->pageSize = $pageSize;
        $this->ascOrder = $ascOrder;
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function getPageSize(): int
    {
        return $this->pageSize;
    }

    public function getOrder(): string
    {
        return $this->ascOrder ? 'ASC' : 'DESC';
    }

    /**
     * Zero-based index of the first record in the page.
     */
    public function getStartRecord(): int
    {
        return ($this->pageSize * ($this->page - 1));
    }

    public function nextPage(): self
    {
        return new self(
            $this->page + 1,
            $this->pageSize,
            $this->ascOrder,
        );
    }

    public function withPageSize(int $pageSize): self
    {
        return new self(
            $this->page,
            $pageSize,
            $this->ascOrder,
        );
    }

    public function equals(self $other): bool
    {
        return $this->page === $other->page
            && $this->pageSize === $other->pageSize
            && $this->ascOrder === $other->ascOrder;
    }

    /**
     * @return array{page: int, pageSize: int, order: string}
     */
    public function toArray(): array
    {
        return [
            'page'     => $this->page,
            'pageSize' => $this->pageSize,
            'order'    => $this->getOrder(),
        ];
    }

    /**
     * @return array{page: int, pageSize: int, order: string}
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
