<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Collections\Linear;

use HraDigital\Datatypes\Exceptions\Datatypes\NonEmptyStringException;
use HraDigital\Datatypes\Exceptions\Datatypes\ParameterOutOfRangeException;
use HraDigital\Datatypes\Scalar\Str;

/**
 * Stack Linear Collection.
 *
 * A Stack is a “last in, first out” or “LIFO” Collection that only allows
 * access to the value at the top of the structure and iterates in that order, destructively.
 *
 * From Wikipedia:
 *
 * In computer science, a Stack is an Abstract Data Type that serves as a Collection
 * of elements, with two principal operations:
 *
 * push, which adds an element to the collection, and
 * pop, which removes the most recently added element that was not yet removed.
 *
 * The order in which elements come off a stack gives rise to its alternative name, LIFO (last in,
 * first out). Additionally, a peek operation may give access to the top without modifying the Stack.
 *
 * The name "Stack" for this type of structure comes from the analogy to a set of physical items stacked
 * on top of each other, which makes it easy to take an item off the top of the Stack, while getting to
 * an item deeper in the stack may require taking off multiple other items first.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 * @link      http://php.net/manual/en/class.ds-stack.php
 * @link      https://en.wikipedia.org/wiki/Stack_(abstract_data_type)
 */
class Stack extends AbstractListArray
{
    /**
     * Initializes an instance of a Stack.
     *
     * @param array $initial - Initial element list for the Stack. Defaults to empty array.
     * @return void
     */
    public function __construct(array $initial = [])
    {
        foreach ($initial as $element) {
            $this->push($element);
        }
    }

    /**
     * Returns a cloned copy of the current Stack object.
     *
     * @return Stack
     */
    public function clone(): Stack
    {
        return new Stack(
            $this->toArray()
        );
    }

    /**
     * Returns the next element in the Stack, without removing it.
     *
     * If the Stack has no elements, it will return NULL.
     *
     * @return Str|NULL
     */
    public function peek(): ?Str
    {
        // Validates the Stack has elements.
        if ($this->count() === 0) {
            return null;
        }

        return $this->list[$this->count() - 1];
    }

    /**
     * Returns the next element in the Stack, while removing it.
     *
     * If the Stack has no elements, it will return NULL.
     *
     * @return Str|NULL
     */
    public function pop(): ?Str
    {
        return \array_pop($this->list);
    }

    /**
     * Adds a new element to the Stack.
     *
     * @param  string $element - Element to be added to the Stack.
     *
     * @throws NonEmptyStringException - If supplied element is not a non empty string.
     * @return void
     */
    public function push(string $element): void
    {
        // Validates provided parameter.
        if (\strlen(\trim($element)) === 0) {
            throw NonEmptyStringException::withName('$element');
        }

        // Adds element to the Stack.
        $this->list[] = Str::create($element);
    }
}
