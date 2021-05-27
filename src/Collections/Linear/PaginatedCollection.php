<?php declare(strict_types=1);

namespace Hradigital\Datatypes\Collections\Linear;

use Aesir\Domain\Datatypes\Sorting\SortInfo;

/**
 * Paginated aggregate Collection information object.
 *
 * This class is used when a Collection of records is paginated, and we'll need
 * to associated with the Collection all the pagination's information.
 *
 * The initial Collection of records being paginated will still be accessible through
 * the collection() method, but any changes in this Collection will not be
 * reflected in the Pagination information counters.
 *
 * If no pagination information is required, please use regular Collection object.
 *
 * @package   Hradigital\Datatypes
 * @license   MIT
 * @see       EntityCollection
 */
class PaginatedCollection implements \JsonSerializable
{
    /** @var EntityCollection $collection - Collection of records being Paginated. */
    protected ?EntityCollection $collection = null;

    /** @var SortInfo $sortInfo - Sorting information instance. */
    protected ?SortInfo $sortInfo = null;

    /** @var int $total - Total number of records available. */
    protected int $total = 0;

    /** @var int $firstId - Initial record being displayed. NULL if empty Collection. */
    protected ?int $firstId = null;

    /** @var int $lastId - Last record being displayed. NULL if empty Collection. */
    protected ?int $lastId = null;

    /** @var int $currentPage - Current Page for the Paginated records. */
    protected int $currentPage = 0;

    /** @var int $lastPage - Last Page available for Pagination. */
    protected int $lastPage = 0;

    /** @var int $perPage - Number of records being displayed per Page. */
    protected int $perPage = 0;

    /**
     * Initializes the Paginated Collection instance.
     *
     * @param EntityCollection $collection - Collection of records being Paginated.
     * @param SortInfo         $sortInfo   - Sorting information instance.
     * @param int $total       - Total number of records available.
     * @param int $from        - Initial record's ID being displayed. NULL if empty Collection.
     * @param int $to          - Last record's ID being displayed. NULL if empty Collection.
     * @param int $currentPage - Current Page for the Paginated records.
     * @param int $lastPage    - Last Page available for Pagination.
     * @param int $perPage     - Number of records being displayed per Page.
     *
     * @return void
     */
    public function __construct(
        EntityCollection $collection,
        SortInfo $sortInfo,
        int $total,
        int $from = null,
        int $to = null,
        int $currentPage,
        int $lastPage,
        int $perPage
    ) {
        // Sets the actual Collection of records being Paginated.
        $this->collection = $collection;
        $this->sortInfo   = $sortInfo;

        // Sets the counters.
        $this->total   = $total;
        $this->perPage = $perPage;

        // Sets the Page information.
        $this->currentPage = $currentPage;
        $this->lastPage    = $lastPage;
        $this->firstId     = $from;
        $this->lastId      = $to;
    }

    /**
     * Collection of items being paginated.
     *
     * Pagination counters will be calculated at start, and will remain immutable
     * until the object is destroyed.
     *
     * Please note that, adding/removing elements to or from the Collection will
     * not reflect on the Pagination counters being updated.
     *
     * @return EntityCollection
     */
    public function collection(): EntityCollection
    {
        return $this->collection;
    }

    /**
     * Retrieves the sorting information for the Pagination.
     *
     * @return SortInfo
     */
    public function sortInfo(): SortInfo
    {
        return $this->sortInfo;
    }

    /**
     * Number of the first record being displayed in the Paginated results.
     *
     * Please note that, the returned integer is not the record's ID. It represents
     * the record's global displaying order if the the records weren't being paginated.
     *
     * @return int
     */
    public function fromRecord(): int
    {
        return (($this->currentPage - 1) * $this->perPage);
    }

    /**
     * Number of the last record being displayed in the Paginated results.
     *
     * Please note that, the returned integer is not the record's ID. It represents
     * the record's global displaying order if the the records weren't being paginated.
     *
     * @return int
     */
    public function toRecord(): int
    {
        if ($this->collection->count() < $this->perPage) {
            return ($this->fromRecord() + $this->collection->count());
        } else {
            return ($this->fromRecord() + $this->perPage);
        }
    }

    /**
     * Number of the first record's ID being displayed in the Paginated results.
     *
     * If the record Collection is empty, this will return NULL, as
     * there isn't any first or last records.
     *
     * @return int|NULL
     */
    public function firstId(): ?int
    {
        return $this->firstId;
    }

    /**
     * Number of the last record's ID being displayed in the Paginated results.
     *
     * If the record Collection is empty, this will return NULL, as
     * there isn't any first or last records.
     *
     * @return int|NULL
     */
    public function lastId(): ?int
    {
        return $this->lastId;
    }

    /**
     * Total number of records in source.
     *
     * Returns the total number of records from the source dataset, from which the pagination was produced.
     *
     * @return int
     */
    public function totalRecords(): int
    {
        return $this->total;
    }

    /**
     * Total number of available records for Pagination.
     *
     * Returns the total number of records in the selected Page.
     *
     * @return int
     */
    public function total(): int
    {
        return $this->collection->count();
    }

    /**
     * Number of the current Page for the paginated records.
     *
     * @return int
     */
    public function currentPage(): int
    {
        return $this->currentPage;
    }

    /**
     * Number of the calculated last Page for the paginated records.
     *
     * @return int
     */
    public function lastPage(): int
    {
        return $this->lastPage;
    }

    /**
     * Number of records being displayed by Page.
     *
     * @return int
     */
    public function perPage(): int
    {
        return $this->perPage;
    }

    /**
     * Returns an Array representation of the Paginated Collection's object.
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'collection'   => $this->collection,
            'sortinfo'     => $this->sortInfo,
            'fromRecord'   => $this->fromRecord(),
            'toRecord'     => $this->toRecord(),
            'totalRecords' => $this->totalRecords(),
            'currentPage'  => $this->currentPage(),
            'lastPage'     => $this->lastPage(),
            'perPage'      => $this->perPage(),
        ];
    }

    /**
     * Returns an array containing all its item's serialized data.
     *
     * Allows the Collection to be serialized directly by the json_encode() function.
     *
     * {@inheritDoc}
     * @link http://www.php.net/manual/en/jsonserializable.jsonserialize.php
     * @see  \JsonSerializable::jsonSerialize()
     */
    public function jsonSerialize(): array
    {
        return [
            'collection'   => $this->collection->jsonSerialize(),
            'sortinfo'     => $this->sortInfo->jsonSerialize(),
            'fromRecord'   => $this->fromRecord(),
            'toRecord'     => $this->toRecord(),
            'totalRecords' => $this->totalRecords(),
            'currentPage'  => $this->currentPage(),
            'lastPage'     => $this->lastPage(),
            'perPage'      => $this->perPage(),
        ];
    }
}
