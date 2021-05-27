<?php declare(strict_types=1);

namespace Hradigital\Datatypes\Traits\Entities\Location;

/**
 * Trait for an Entity's Postal Code attribute.
 *
 * @package   Hradigital\Datatypes
 * @copyright Hradigital\Datatypes
 * @license   Proprietary
 */
trait HasPostalCodeTrait
{
    /** @var string $postal_code - Postal Code */
    protected string $postal_code = '';

    /**
     * Mutator method for setting the value into the Attribute.
     *
     * @param  string $postalCode - Postal Code.
     * @return void
     */
    protected function castPostalCode(string $postalCode): void
    {
        $this->postal_code = \trim($postalCode);
    }

    /**
     * Returns the Entity's Postal Code.
     *
     * @return string
     */
    public function postalCode(): string
    {
        return $this->postal_code;
    }
}
