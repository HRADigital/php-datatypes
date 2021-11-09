<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Traits\Entities\General;

use HraDigital\Datatypes\Exceptions\Datatypes\PositiveIntegerException;

/**
 * Trait for a Record's positive integer ID attribute.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
trait HasPositiveIntegerIDTrait
{
    /** @var int|null $id - Positive Integer ID */
    protected ?int $id = null;

    /**
     * Mutator method for setting the value into the Attribute.
     *
     * @param  int $id - Positive Integer ID.
     * @return void
     */
    protected function castId(int $id): void
    {
        if ($id < 1) {
            throw new PositiveIntegerException('$id');
        }

        $this->id = $id;
    }

    /**
     * Returns the Positive Integer ID
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * If record is a new record. Not returned from DB.
     *
     * Validates if the VO/Entity has an ID set.
     *
     * @return bool
     */
    public function isNew(): bool
    {
        return ($this->id === null);
    }
}
