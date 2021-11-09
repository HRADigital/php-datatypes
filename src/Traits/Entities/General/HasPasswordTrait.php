<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Traits\Entities\General;

use HraDigital\Datatypes\Scalar\Str;

/**
 * Gives Password capabilities to an Entity/Value Object.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
trait HasPasswordTrait
{
    /** @var Str|null $password - Record's password value. */
    protected ?Str $password = null;

    /**
     * Sets the password value of an Entity/Value Object.
     *
     * @param  string $password - New password value.
     * @return void
     */
    protected function castPassword(string $password): void
    {
        $this->password = ($password ? Str::create($password) : null);
    }

    /**
     * Returns record's Password value.
     *
     * @return Str|null
     */
    public function getPassword(): ?Str
    {
        return $this->password;
    }
}
