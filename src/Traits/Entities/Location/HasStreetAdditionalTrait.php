<?php declare(strict_types=1);

namespace Hradigital\Datatypes\Traits\Entities\Location;

/**
 * Trait for an Entity's Street Aditional attribute.
 *
 * @package   Hradigital\Datatypes
 * @copyright Hradigital\Datatypes
 * @license   Proprietary
 */
trait HasStreetAdditionalTrait
{
    /** @var string $street_additional - Street Additional */
    protected string $street_additional = '';

    /**
     * Mutator method for setting the value into the Attribute.
     *
     * @param  string $street - Street Additional.
     * @return void
     */
    protected function castStreetAdditional(string $street): void
    {
        $this->street_additional = \trim($street);
    }

    /**
     * Returns the Entity's Street Additional.
     *
     * @return string
     */
    public function streetAdditional(): string
    {
        return $this->street_additional;
    }
}
