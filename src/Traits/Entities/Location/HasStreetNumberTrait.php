<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Traits\Entities\Location;

/**
 * Trait for an Entity's Street Number attribute.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
trait HasStreetNumberTrait
{
    /** @var string $street_adicional - Street Number */
    protected string $street_no = '';

    /**
     * Mutator method for setting the value into the Attribute.
     *
     * @param  string $number - Street Number.
     * @return void
     */
    protected function castStreetNo(string $number): void
    {
        $this->street_no = \trim($number);
    }

    /**
     * Returns the Entity's Street Number.
     *
     * @return string
     */
    public function getStreetNumber(): string
    {
        return $this->street_no;
    }
}
