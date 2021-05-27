<?php declare(strict_types=1);

namespace Hradigital\Datatypes\Traits\Entities\Personal;

use Hradigital\Datatypes\Exceptions\Entities\UnexpectedEntityValueException;

/**
 * Trait for an Entity's Gender attribute.
 *
 * @package   Hradigital\Datatypes
 * @copyright Hradigital\Datatypes
 * @license   Proprietary
 */
trait HasGenderTrait
{
    /** @var string $sex - Gender */
    protected string $sex = 'Male';

    /**
     * Mutator method for setting the value into the Attribute.
     *
     * @param  string $sex - Gender.
     * @return void
     */
    protected function castSex(string $sex): void
    {
        // Sanitizes and checks supplied value.
        $sex = \ucfirst(\strtolower($sex));
        if ($sex !== 'Male' && $sex !== 'Female') {
            throw new UnexpectedEntityValueException("Specified gender '{$sex}' is not valid.");
        }

        $this->sex = $sex;
    }

    /**
     * Returns the Entity's Gender.
     *
     * @return string
     */
    public function gender(): string
    {
        return $this->sex;
    }
}
