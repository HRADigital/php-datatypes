<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Collections\Linear;

use HraDigital\Datatypes\Exceptions\Collections\DuplicatedEntryException;
use HraDigital\Datatypes\Exceptions\Datatypes\ParameterOutOfRangeException;
use HraDigital\Datatypes\Exceptions\Datatypes\PositiveIntegerException;
use HraDigital\Datatypes\ValueObjects\AbstractValueObject;

/**
 * Entity Collection class.
 *
 * This class will hold, process, encapsulate and group Entity objects together.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT1
 * @link      https://github.com/opsbears/foundation/tree/master/src/Complex
 */
class EntityCollection implements \Countable, \Iterator, \JsonSerializable
{
    /** @var array $collection - Holds all the Collection's elements. */
    protected array $collection = [];

    /**
     * Returns the full collection of Entities as an Indexed Array.
     *
     * @return array
     */
    public function all(): array
    {
        return \array_values($this->collection);
    }

    /**
     * Returns TRUE if an Entity with the supplied ID exists in the collection.
     *
     * @param  int $id - Entity's ID to search for.
     *
     * @throws PositiveIntegerException - If the supplied ID is not a positive integer.
     * @return bool
     */
    public function has(int $id): bool
    {
        // Validates supplied ID.
        if ($id <= 0) {
            throw PositiveIntegerException::withName('$id');
        }

        // Returns the existence of the Entity in the Collection.
        return \array_key_exists($id, $this->collection);
    }

    /**
     * Retrieves the Collection's Entity with the supplied ID.
     *
     * @param  int $id - Entity's ID to search for.
     *
     * @throws PositiveIntegerException     - If the supplied ID is not a positive integer.
     * @throws ParameterOutOfRangeException - If the supplied ID was not present in the Collection.
     * @return AbstractValueObject
     */
    public function get(int $id): AbstractValueObject
    {
        // Validates supplied ID.
        if ($id <= 0) {
            throw PositiveIntegerException::withName('$id');
        }
        if (!\array_key_exists($id, $this->collection)) {
            throw ParameterOutOfRangeException::withName('$id');
        }

        // Returns the Entity.
        return $this->collection[$id];
    }

    /**
     * Counts the number of elements the Collection contains.
     *
     * @return int
     */
    public function count(): int
    {
        return \count($this->collection);
    }

    /**
     * Clear the Entity Collection from the object.
     *
     * This method supports chaining.
     *
     * @return self
     */
    public function clear(): self
    {
        // Clears Collection's array.
        $this->collection = [];
        $this->rewind();

        // Returns instance.
        return $this;
    }

    /**
     * Returns the list of Entity's IDs loaded in the Collection
     *
     * @return array
     */
    public function ids(): array
    {
        return \array_keys($this->collection);
    }

    /**
     * Adds a new Value Object to the Collection.
     *
     * This method supports chaining.
     *
     * @param  AbstractValueObject $valueObject - Entity to add to the collection.
     *
     * @throws DuplicatedEntryException - If you're trying to add a repeated Entity to the Collection.
     * @return self
     */
    public function add(AbstractValueObject $object): self
    {
        $id = $object->{'getId'}();

        if (\array_key_exists($id, $this->collection)) {
            throw DuplicatedEntryException::withId($id);
        }

        $this->collection[$id] = $object;

        return $this;
    }

    /**
     * Removes an Entity, identified by the supplied ID, from the Collection.
     *
     * Returns TRUE on success, FALSE otherwise.
     *
     * @param  int $id - Entity's ID to search for.
     *
     * @throws PositiveIntegerException     - If the supplied ID is not a positive integer.
     * @throws ParameterOutOfRangeException - If the Entity with the supplied ID doesn't exist in the Collection.
     * @return bool
     */
    public function remove(int $id): bool
    {
        // Validates supplied ID.
        if ($id <= 0) {
            throw PositiveIntegerException::withName('$id');
        }
        if (!\array_key_exists($id, $this->collection)) {
            throw ParameterOutOfRangeException::withName('$id');
        }

        // Removes element and rewinds
        unset($this->collection[$id]);
        $this->previous();

        // Returns success.
        return true;
    }

    /**
     * Rewinds the cursor in the Collection, and returns the first Element for the
     * Collection.
     *
     * {@inheritDoc}
     * @see \Iterator::rewind()
     */
    #[\ReturnTypeWillChange]
    public function rewind(): ?AbstractValueObject
    {
        // Rewinds the cursor and returns the first Element.
        if (($element = \reset($this->collection)) !== false) {
            return $element;
        }

        return null;
    }

    /**
     * Retrieves the current Element for the Collection
     *
     * {@inheritDoc}
     * @see \Iterator::current()
     */
    public function current(): ?AbstractValueObject
    {
        // If retrieving the current element fails, we'll still try to rewind the
        // pointer and return the first element.
        if (($current = \current($this->collection)) === false) {
            return $this->rewind();
        }

        return $current;
    }

    /**
     * Retrieves the current Collection's Element key.
     *
     * {@inheritDoc}
     * @see \Iterator::key()
     */
    public function key(): ?int
    {
        // First, we'll collect the key.
        $key = \key($this->collection);

        if ($key === null || $key === false) {
            return null;
        }

        return (int) $key;
    }

    /**
     * Gets next cursor element in the Collection.
     *
     * {@inheritDoc}
     * @see \Iterator::next()
     */
    public function next(): void
    {
        \next($this->collection);
    }

    /**
     * Gets the previous cursor element in the Collection.
     *
     * Although this method is not actually part of the \Iterator interface, this was added
     * as an add on for consistency with the next() method.
     *
     * @return void
     */
    public function previous(): void
    {
        \prev($this->collection);
    }

    /**
     * Validates if the cursor in the Collection points to a valid element.
     *
     * {@inheritDoc}
     * @see \Iterator::valid()
     */
    public function valid(): bool
    {
        return ($this->key() !== null);
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
        $array = [];

        /** @var AbstractValueObject $valueObject - Type casts record */
        foreach ($this->collection as $valueObject) {
            $array[] = $valueObject->jsonSerialize();
        }

        return $array;
    }
}
