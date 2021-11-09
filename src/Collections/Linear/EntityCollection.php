<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Collections\Linear;

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
     * @throws \OutOfRangeException - If the supplied ID is not a positive integer.
     * @return bool
     */
    public function has(int $id): bool
    {
        // Validates supplied ID.
        if ($id <= 0) {
            throw new \OutOfRangeException("Supplied ID should be a positive integer.");
        }

        // Returns the existence of the Entity in the Collection.
        return \array_key_exists($id, $this->collection);
    }

    /**
     * Retrieves the Collection's Entity with the supplied ID.
     *
     * @param  int $id - Entity's ID to search for.
     *
     * @throws \OutOfRangeException  - If the supplied ID is not a positive integer.
     * @throws \OutOfBoundsException - If the supplied ID was not present in the Collection.
     * @return AbstractEntity
     */
    public function get(int $id): AbstractEntity
    {
        // Validates supplied ID.
        if ($id <= 0) {
            throw new \OutOfRangeException("Supplied ID should be a positive integer.");
        }
        if (!\array_key_exists($id, $this->collection)) {
            throw new \OutOfBoundsException("The Entity you are trying to retrieve does not exist in the Collection.");
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
     * Adds a new Entity to the Collection.
     *
     * This method supports chaining.
     *
     * @param  AbstractEntity $entity - Entity to add to the collection.
     *
     * @throws \OverflowException - If you're trying to add a repeated Entity to the Collection.
     * @return self
     */
    public function add(AbstractEntity $entity): self
    {
        // Validates if the given Entity already exists in the Collection.
        if (\array_key_exists($entity->id(), $this->collection)) {
            throw new \OverflowException("The Entity you are trying to add to the Collection already exists.");
        }

        // Adds an Entity to the collection.
        $this->collection[$entity->id()] = $entity;

        // Returns this instance.
        return $this;
    }

    /**
     * Removes an Entity, identified by the supplied ID, from the Collection.
     *
     * Returns TRUE on success, FALSE otherwise.
     *
     * @param  int $id - Entity's ID to search for.
     *
     * @throws \OutOfRangeException  - If the supplied ID is not a positive integer.
     * @throws \OutOfBoundsException - If the Entity with the supplied ID doesn't exist in the Collection.
     * @return bool
     */
    public function remove(int $id): bool
    {
        // Validates supplied ID.
        if ($id <= 0) {
            throw new \OutOfRangeException("Supplied ID should be a positive integer.");
        }
        if (!\array_key_exists($id, $this->collection)) {
            throw new \OutOfBoundsException("The Entity you are trying to delete does not exist in the Collection.");
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
    public function rewind(): ?AbstractEntity
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
    public function current(): ?AbstractEntity
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

        // Then, we'll uniform the returned value.
        if ($key !== null && $key !== false) {
            return ((int) $key);
        } else {
            return null;
        }
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
        // Declares and fills a return array.
        $array = [];
        foreach ($this->collection as $entity) {

            /** @var AbstractEntity $entity - Type casts record */
            $entity  = $entity;
            $array[] = $entity->jsonSerialize();
        }

        return $array;
    }
}
