<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Collections\Linear;

/**
 * List Abstract Linear Collection.
 *
 * This class can be used as a base for different types of Array classes,
 * such as Queues, Stacks, other Collections, etc.
 *
 * Primary goal, is to provide shared functionality for this type of child classes.
 *
 * This class should always be extended, and cannot be instantiated directly.
 *
 * From Wikipedia:
 *
 * In a List, the order of data items is significant. Duplicate data items are permitted.
 * Examples of operations on lists are searching for a data item in the list and determining
 * its location (if it is present), removing a data item from the list, adding a data item
 * to the list at a specific location, etc. If the principal operations on the list are to be
 * the addition of data items at one end and the removal of data items at the other, it will
 * generally be called a Queue or FIFO. If the principal operations are the addition
 * and removal of data items at just one end, it will be called a Stack or LIFO.
 * In both cases, data items are maintained within the collection in the same order (unless they
 * are removed and re-inserted somewhere else) and so these are special cases of the list collection.
 * Other specialized operations on lists include sorting, where, again, the order of data items is
 * of great importance.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 * @link      http://php.net/manual/en/class.ds-collection.php
 * @link      https://en.wikipedia.org/wiki/Collection_(abstract_data_type)#Lists
 */
abstract class AbstractListArray implements \Countable, \JsonSerializable
{
    /** @var array $list - Holds the List's Elements. */
    protected array $list = [];

    /** @var int $capacity - Holds the maximum capacity for the List. -1 means "no limit". */
    protected int $capacity = -1;

    /**
     * Returns the value count from the List.
     *
     * @return int
     */
    public function count(): int
    {
        return \count($this->list);
    }

    /**
     * Returns the array List of values.
     *
     * @return array
     */
    public function toArray(): array
    {
        return $this->list;
    }

    /**
     * Clears the List of values.
     *
     * @return void
     */
    public function clear(): void
    {
        $this->list = [];
    }

    /**
     * Returns TRUE if the List is empty.
     *
     * @return bool
     */
    public function isEmpty(): bool
    {
        return ($this->count() === 0);
    }

    /**
     * Returns the total capacity allowed by the List.
     *
     * If the capacity is set to -1, it means the List has no capacity limit.
     *
     * @return int
     */
    public function capacity(): int
    {
        return $this->capacity;
    }

    /**
     * Allocates a capacity limit to the List.
     *
     * @param  int $capacity - Capacity limit to set in the List.
     *
     * @throws \InvalidArgumentException - If provided capacity is not a positive integer.
     * @throws \OutOfRangeException      - The the supplied capacity is less than the current List's value count.
     * @return void
     */
    public function allocate(int $capacity): void
    {
        // Validates provided parameter.
        if ($capacity < 1) {
            throw new \InvalidArgumentException("Supplied capacity must be a positive integer.");
        }
        if ($capacity < $this->count()) {
            throw new \OutOfRangeException("Supplied capacity cannot be less than the current list's capacity.");
        }

        // Sets the capacity in the List.
        $this->capacity = $capacity;
    }

    /**
     * Serializes the List into a JSON string.
     *
     * @return string
     */
    public function jsonSerialize(): string
    {
        return \json_encode($this->list);
    }
}
