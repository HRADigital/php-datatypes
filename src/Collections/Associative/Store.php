<?php

/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at https://mozilla.org/MPL/2.0/.
 *
 * Copyright (c) HRADigital - Hugo Rafael Azevedo.
 */

declare(strict_types=1);

namespace HraDigital\Datatypes\Collections\Associative;

use HraDigital\Datatypes\Exceptions\Datatypes\NonEmptyStringException;
use InvalidArgumentException;
use JsonSerializable;
use function array_key_exists;
use function count;
use function strlen;
use function strtolower;
use function trim;

/**
 * Store Associative Collection.
 *
 * This class will hold and process all data associated with a Store/Set.
 *
 * A Store (Set) can be any Collection of key/values (ex:. session).
 *
 * In computer science, a set is an Abstract Data Type that can store unique values,
 * without any particular order. It is a computer implementation of the mathematical concept
 * of a finite set. Unlike most other Collection types, rather than retrieving a specific
 * element from a set, one typically tests a value for membership in a set.
 *
 * Some set data structures are designed for static or frozen sets that do not change after they
 * are constructed. Static sets allow only query operations on their elements — such as checking
 * whether a given value is in the set, or enumerating the values in some arbitrary order.
 * Other variants, called dynamic or mutable sets, allow also the insertion and deletion of elements
 * from the set.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 * @link      https://en.wikipedia.org/wiki/Set_(abstract_data_type)
 */
class Store implements JsonSerializable
{
    /** @var array<string, string> $store - Store that will hold the values. */
    protected array $store = [];

    /** @var string|NULL $context - Context for the Store's values. */
    protected ?string $context = null;

    /**
     * Initializes a new instance of a Store.
     *
     * @throws NonEmptyStringException - If supplied context is a not a non empty string.
     */
    public function __construct(?string $context = null)
    {
        // Validates provided parameters.
        if ($context !== null && strlen(trim($context)) === 0) {
            throw NonEmptyStringException::withName('$context');
        }

        // Sets the data context.
        $this->context = $context;
    }

    /**
     * Returns number of items in the Store.
     */
    public function count(): int
    {
        return count($this->store);
    }

    /**
     * Retrieves all existing Values from the Store.
     *
     * @return array<string, string>
     */
    public function getValues(): array
    {
        return $this->store;
    }

    /**
     * Retrieves a value from the Store.
     *
     * If the value is not found, the supplied $default value will be returned.
     *
     * @throws InvalidArgumentException - If supplied name is a not a non empty string.
     */
    public function get(string $name, ?string $default = null): ?string
    {
        // Sanitize provided $name/key.
        $name = $this->sanitizeName($name);

        // Validate if the provided key is available in the "store".
        if ($this->has($name)) {
            return $this->store[$this->name($name)];
        }

        return $default;
    }

    /**
     * Returns TRUE of the value exists in the store.
     * FALSE otherwise.
     *
     * @throws InvalidArgumentException - If supplied name is a not a non empty string.
     */
    public function has(string $name): bool
    {
        // Sanitize provided $name/key.
        $name = $this->sanitizeName($name);

        return array_key_exists($this->name($name), $this->store);
    }

    /**
     * Sets a value in the Store.
     *
     * @throws NonEmptyStringException - If supplied name is a not a non empty string.
     */
    public function set(string $name, string $value): void
    {
        // Sanitize provided $name/key.
        $name = $this->sanitizeName($name);

        // Sets the value in the store.
        $this->store[$this->name($name)] = $value;
    }

    /**
     * Adds a non existing value in the Store.
     *
     * @throws NonEmptyStringException - If supplied name is a not a non empty string.
     */
    public function add(string $name, string $value): bool
    {
        // Sanitize provided $name/key.
        $name = $this->sanitizeName($name);

        // Validate if the provided key is available in the "store".
        if ($this->has($name)) {
            return false;
        }

        // Sets the value in the store.
        $this->set($name, $value);

        return true;
    }

    /**
     * Edits an existing value in the Store.
     *
     * @throws NonEmptyStringException - If supplied name is a not a non empty string.
     */
    public function edit(string $name, string $value): bool
    {
        // Sanitize provided $name/key.
        $name = $this->sanitizeName($name);

        // Validate if the provided key is available in the "store".
        if (! $this->has($name)) {
            return false;
        }

        // Sets the value in the store.
        $this->set($name, $value);

        return true;
    }

    /**
     * Removes a given value from the Store.
     *
     * @throws NonEmptyStringException - If supplied name is a not a non empty string.
     */
    public function delete(string $name): bool
    {
        // Sanitize provided $name/key.
        $name = $this->sanitizeName($name);

        // Validate if the provided key is available in the "store".
        if (! $this->has($name)) {
            return false;
        }

        // Removes value from Store.
        unset($this->store[$this->name($name)]);

        return true;
    }

    /**
     * Returns sanitized $name/key.
     *
     * @throws NonEmptyStringException - If supplied name is a not a non empty string.
     */
    protected function sanitizeName(string $name): string
    {
        // Validates provided parameters.
        if (strlen(trim($name)) === 0) {
            throw NonEmptyStringException::withName('$name');
        }

        // Returns sanitized $name/key.
        return strtolower(trim($name));
    }

    /**
     * Returns full name, with namespace included if necessary.
     */
    protected function name(string $name): string
    {
        // Returns sanitized $name/key.
        if ($this->context === null) {
            return $name;
        }

        return ($this->context . '.' . $name);
    }

    /**
     * {@inheritDoc}
     * @return array<string, string>
     */
    public function jsonSerialize(): array
    {
        return $this->getValues();
    }
}
