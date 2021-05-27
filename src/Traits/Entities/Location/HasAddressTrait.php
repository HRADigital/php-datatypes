<?php declare(strict_types=1);

namespace Hradigital\Datatypes\Traits\Entities\Location;

/**
 * Trait for an Entity's Address attribute.
 *
 * @package   Hradigital\Datatypes
 * @copyright Hradigital\Datatypes
 * @license   Proprietary
 */
trait HasAddressTrait
{
    /** @var string $address - Address */
    protected string $address = '';

    /**
     * Mutator method for setting the value into the Attribute.
     *
     * @param  string $address - Address.
     * @return void
     */
    protected function castAddress(string $address): void
    {
        $this->address = \trim($address);
    }

    /**
     * Returns the Entity's Address.
     *
     * @return string
     */
    public function address(): string
    {
        return $this->address;
    }
}
