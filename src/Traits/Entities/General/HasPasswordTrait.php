<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Traits\Entities\General;

/**
 * Gives Password capabilities to an Entity/Value Object.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   Proprietary
 */
trait HasPasswordTrait
{
    /** @var string|null $password - Record's password value. */
    protected ?string $password = null;

    /**
     * Sets the password value of an Entity/Value Object.
     *
     * @param  string $password - New password value.
     * @return void
     */
    protected function castPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * Returns record's Password value.
     *
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }
}
