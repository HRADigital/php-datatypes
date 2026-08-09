<?php

/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at https://mozilla.org/MPL/2.0/.
 *
 * Copyright (c) HRADigital - Hugo Rafael Azevedo.
 */

declare(strict_types=1);

namespace HraDigital\Datatypes\Attributes\General;

use HraDigital\Datatypes\Web\EmailAddress;

/**
 * Trait for a Record's Email attribute.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 */
trait HasEmailTrait
{
    /** @var EmailAddress|null $email - Email Datatype representation. */
    protected ?EmailAddress $email = null;

    /**
     * Mutator method for setting the value into the Attribute
     */
    protected function castEmail(string $email): void
    {
        $this->email = EmailAddress::create($email);
    }

    /**
     * Returns an EmailAddress representation for the record's E-mail Address.
     */
    public function getEmail(): ?EmailAddress
    {
        return $this->email;
    }
}
