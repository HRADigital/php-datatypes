<?php declare(strict_types=1);

namespace Hradigital\Datatypes\Collections\Linear;

/**
 * Queue linear Collection.
 *
 * A Queue is a “first in, first out” or “FIFO” collection that only allows
 * access to the value at the front of the queue and iterates in that order, destructively.
 *
 * From Wikipedia:
 *
 * In computer science, a Queue is a particular kind of Aabstract Data Type (ADT)
 * or Collection in which the entities in the collection are kept in order and the
 * principal (or only) operations on the Collection are the addition of entities to the rear
 * terminal position, known as enqueue, and removal of entities from the front terminal position,
 * known as dequeue.
 *
 * This makes the queue a First-In-First-Out (FIFO) data structure. In a FIFO data
 * structure, the first element added to the queue will be the first one to be removed. This is
 * equivalent to the requirement that once a new element is added, all elements that were added
 * before have to be removed before the new element can be removed. Often a peek or front operation
 * is also entered, returning the value of the front element without dequeuing it. A queue is an
 * example of a linear data structure, or more abstractly a sequential Collection.
 *
 * @package   Hradigital\Datatypes
 * @copyright Hradigital\Datatypes
 * @license   MIT
 * @link      http://php.net/manual/en/class.ds-queue.php
 * @link      https://en.wikipedia.org/wiki/Queue_(abstract_data_type)
 */
class Queue extends AbstractListArray
{
    /**
     * Initializes an instance of a Queue.
     *
     * @param array|NULL $initial - Initial element list for the Queue. Can be NULL.
     *
     * @throws \InvalidArgumentException - If supplied array is empty, although not NULL.
     * @return void
     */
    public function __construct(?array $initial = null)
    {
        // Checks initially provided list of elements.
        if ($initial !== null) {

            // Validates supplied parameter.
            if (\count($initial) === 0) {
                throw new \InvalidArgumentException("Supplied array should be a list of string elements.");
            }

            // Fills in the Queue.
            foreach ($initial as $element) {
                $this->push($element);
            }
        }
    }

    /**
     * Returns a copy of the current Queue object.
     *
     * @return Queue
     */
    public function copy(): self
    {
        return new Queue($this->toArray());
    }

    /**
     * Returns the next element in the Queue, without removing it.
     *
     * If the Queue has no elements, it will return NULL.
     *
     * @return string|NULL
     */
    public function peek(): ?string
    {
        // Validates the Queue has elements.
        if ($this->count() === 0) {
            return null;
        }

        return $this->list[0];
    }

    /**
     * Returns the next element in the Queue, while removing it.
     *
     * If the Queue has no elements, it will return NULL.
     *
     * @return string|NULL
     */
    public function pop(): ?string
    {
        return \array_shift($this->list);
    }

    /**
     * Adds a new element to the Queue.
     *
     * @param  string $element - Element to be added to the Queue.
     *
     * @throws \InvalidArgumentException - If supplied element is not a non empty string.
     * @return void
     */
    public function push(string $element): void
    {
        // Validates provided parameter.
        if (\strlen(\trim($element)) === 0) {
            throw new \InvalidArgumentException("Supplied element must be a non empty string.");
        }

        // Adds element to the Queue.
        $this->list[] = $element;
    }
}
