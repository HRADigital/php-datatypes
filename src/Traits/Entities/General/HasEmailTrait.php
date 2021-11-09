<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Traits\Entities\General;

use HraDigital\Datatypes\Web\EmailAddress;

/**
 * Trait for a Record's Email attribute.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   Proprietary
 */
trait HasEmailTrait
{
    /** @var EmailAddress|null $email - Email Datatype representation. */
    protected ?EmailAddress $email = null;

    /**
     * Mutator method for setting the value into the Attribute
     *
     * @param  string $email - Email string representation of the value.
     * @return void
     */
    protected function castEmail(string $email): void
    {
        $this->email = EmailAddress::create($email);
    }

    /**
     * Returns an EmailAddress representation for the record's E-mail Address.
     *
     * @return EmailAddress|null
     */
    public function getEmail(): ?EmailAddress
    {
        return $this->email;
    }
}
