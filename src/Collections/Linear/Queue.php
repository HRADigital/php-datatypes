<?php

/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at https://mozilla.org/MPL/2.0/.
 *
 * Copyright (c) HRADigital - Hugo Rafael Azevedo.
 */

declare(strict_types=1);

namespace HraDigital\Datatypes\Collections\Linear;

use HraDigital\Datatypes\Exceptions\Datatypes\NonEmptyStringException;
use HraDigital\Datatypes\Exceptions\Datatypes\ParameterOutOfRangeException;
use HraDigital\Datatypes\Scalar\Str;
use function array_map;
use function array_shift;
use function strlen;
use function trim;

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
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 * @link      http://php.net/manual/en/class.ds-queue.php
 * @link      https://en.wikipedia.org/wiki/Queue_(abstract_data_type)
 */
class Queue extends AbstractListArray
{
    /**
     * Initializes an instance of a Queue.
     *
     * @param array<int, string> $initial - Initial element list for the Queue. Defaults to empty array.
     */
    public function __construct(array $initial = [])
    {
        foreach ($initial as $element) {
            $this->push($element);
        }
    }

    /**
     * Returns a copy of the current Queue object.
     */
    public function clone(): Queue
    {
        // The List holds Str instances, while the constructor seeds itself from native
        // strings - under strict_types a Str would never be accepted as one.
        return new Queue(
            array_map('strval', $this->toArray())
        );
    }

    /**
     * Returns the next element in the Queue, without removing it.
     *
     * If the Queue has no elements, it will return NULL.
     */
    public function peek(): ?Str
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
     */
    public function pop(): ?Str
    {
        return array_shift($this->list);
    }

    /**
     * Adds a new element to the Queue.
     *
     * @throws NonEmptyStringException - If supplied element is not a non empty string.
     * @throws ParameterOutOfRangeException - If adding element will exceed list's capacity.
     */
    public function push(string $element): void
    {
        if (strlen(trim($element)) === 0) {
            throw NonEmptyStringException::withName('$element');
        }

        if ($this->hasMaxCapacity() && $this->getCapacity() === $this->count()) {
            throw new ParameterOutOfRangeException();
        }

        $this->list[] = Str::create($element);
    }
}
