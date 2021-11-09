<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Traits\Entities\General;

use HraDigital\Datatypes\Exceptions\Datatypes\NonNegativeNumberException;

/**
 * Gives Hits information to an Entity/Value Object.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   Proprietary
 */
trait HasHitsTrait
{
    /** @var int $hits - Number of HITS in the system. */
    protected int $hits = 0;

    /**
     * Sets the HITS value of an Entity.
     *
     * @param  int $hits - New Hit's value.
     *
     * @throws NonNegativeNumberException - If supplied Hit's counter is negative.
     * @return void
     */
    protected function castHits(int $hits): void
    {
        // Validates supplied $hits value.
        if ($hits < 0) {
            throw new NonNegativeNumberException("Supplid hits counter cannot be a negative integer.");
        }

        // Sets value in class' attribute.
        $this->hits = $hits;
    }

    /**
     * Returns the number of Hits.
     *
     * @return int
     */
    public function getHits(): int
    {
        return $this->hits;
    }
}
