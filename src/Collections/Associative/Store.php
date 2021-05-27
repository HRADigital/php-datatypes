<?php declare(strict_types=1);

namespace Hradigital\Datatypes\Collections\Associative;

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
 * @package   Hradigital\Datatypes
 * @license   MIT
 * @link      https://en.wikipedia.org/wiki/Set_(abstract_data_type)
 */
class Store implements \JsonSerializable
{
    /** @var array $store - Store that will hold the values. */
    protected array $store = [];

    /** @var string|NULL $context - Context for the Store's values. */
    protected ?string $context = null;

    /**
     * Initializes a new instance of a Store.
     *
     * @param string|NULL $context - Value's context. Can be used as an inner store.
     *
     * @throws \InvalidArgumentException - If supplied context is a not a non empty string.
     * @return void
     */
    public function __construct(?string $context = null)
    {
        // Validates provided parameters.
        if ($context !== null && \strlen(\trim($context)) === 0) {
            throw new \InvalidArgumentException('Supplied context must be a non empty string.');
        }

        // Sets the data context.
        $this->context = $context;
    }

    /**
     * Retrieves all existing Values from the Store.
     *
     * @return array
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
     * @param string      $name    - Name of the Value to be retrieved.
     * @param string|NULL $default - Default returned value, of not found.
     *
     * @throws \InvalidArgumentException - If supplied name is a not a non empty string.
     * @return string|NULL
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
     * @param string $name - Name of the Value to be searched.
     *
     * @throws \InvalidArgumentException - If supplied name is a not a non empty string.
     * @return bool
     */
    public function has(string $name): bool
    {
        // Sanitize provided $name/key.
        $name = $this->sanitizeName($name);

        return \array_key_exists($this->name($name), $this->store);
    }

    /**
     * Sets a value in the Store.
     *
     * @param string $name  - Name of the Value to be set.
     * @param string $value - Value to be set.
     *
     * @throws \InvalidArgumentException - If supplied name is a not a non empty string.
     * @return bool
     */
    public function set(string $name, string $value): bool
    {
        // Sanitize provided $name/key.
        $name = $this->sanitizeName($name);

        // Sets the value in the store.
        $this->store[$this->name($name)] = $value;

        return true;
    }

    /**
     * Adds a non existing value in the Store.
     *
     * @param string $name  - Name of the Value to be added.
     * @param string $value - Value to be added.
     *
     * @throws \InvalidArgumentException - If supplied name is a not a non empty string.
     * @return bool
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
        return $this->set($name, $value);
    }

    /**
     * Edits an existing value in the Store.
     *
     * @param string $name  - Name of the Value to be edited.
     * @param string $value - Value to be edited.
     *
     * @throws \InvalidArgumentException - If supplied name is a not a non empty string.
     * @return bool
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
        return $this->set($name, $value);
    }

    /**
     * Removes a given value from the Store.
     *
     * @param string $name - Name of the value to be removed from the store.
     *
     * @throws \InvalidArgumentException - If supplied name is a not a non empty string.
     * @return bool
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
     * @param string $name - Name to be sanitized.
     *
     * @throws \InvalidArgumentException - If supplied name is a not a non empty string.
     * @return string
     */
    protected function sanitizeName(string $name): string
    {
        // Validates provided parameters.
        if (\strlen(\trim($name)) === 0) {
            throw new \InvalidArgumentException('Supplied name must be a non empty string.');
        }

        // Returns sanitized $name/key.
        return \strtolower(\trim($name));
    }

    /**
     * Returns full name, with namespace included if necessary.
     *
     * @param string $name - Sanitized name.
     *
     * @return string
     */
    protected function name(string $name): string
    {
        // Returns sanitized $name/key.
        if ($this->context === null) {
            return $name;
        } else {
            return ($this->context . '.' . $name);
        }
    }

    /**
     * {@inheritDoc}
     * @see \JsonSerializable::jsonSerialize()
     */
    public function jsonSerialize(): array
    {
        return $this->getValues();
    }
}
