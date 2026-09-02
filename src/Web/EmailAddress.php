<?php

/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at https://mozilla.org/MPL/2.0/.
 *
 * Copyright (c) HRADigital - Hugo Rafael Azevedo.
 */

declare(strict_types=1);

namespace HraDigital\Datatypes\Web;

use HraDigital\Datatypes\Exceptions\Datatypes\InvalidEmailException;
use HraDigital\Datatypes\Exceptions\Datatypes\NonEmptyStringException;
use HraDigital\Datatypes\Scalar\Str;
use InvalidArgumentException;
use function array_pop;
use function explode;
use function filter_var;
use function implode;
use function sprintf;

/**
 * E-mail address datatype.
 *
 * Datatype class to hold and validate a single E-mail address value, as
 * an E-mail address is a complex field, with a very specific set of rules.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 */
readonly class EmailAddress
{
    /** @var Str $username - Holds the Username's part of the E-mail address. */
    protected Str $username;

    /** @var Str $domain - Holds the Domain part of the E-mail address. */
    protected Str $domain;

    /** @var Str $tld - Holds the Top Level Domain part of the E-mail address. */
    protected Str $tld;

    /**
     * Loads a new EmailAddress instance from a native string.
     */
    public static function create(string $email): EmailAddress
    {
        return new EmailAddress($email);
    }

    /**
     * Initializes a new instance of an E-mail address.
     *
     * @throws InvalidArgumentException - If the supplied email address is empty or invalid.
     */
    protected function __construct(string $email)
    {
        // Converts supplied primitive to Str.
        $voEmail = Str::create($email)->trim()->toLower();

        // Validate supplied parameter.
        if ($voEmail->getLength() === 0) {
            throw NonEmptyStringException::withName('$email');
        }
        if (!filter_var((string) $email, FILTER_VALIDATE_EMAIL)) {
            throw InvalidEmailException::withName($email);
        }

        // Sanitizes and processes supplied e-mail address.
        $parts = explode('@', (string) $voEmail);
        $this->username = Str::create($parts[0]);

        // Processes the right side of the e-mail address.
        $domain = explode('.', $parts[1]);
        $this->tld    = Str::create(array_pop($domain));
        $this->domain = Str::create(implode('.', $domain));
    }

    /**
     * Returns the String representation of the object.
     */
    public function __toString(): string
    {
        return (string) $this->getAddress();
    }

    /**
     * Returns a string representation for the Email address.
     */
    public function getAddress(): Str
    {
        return Str::create(
            sprintf(
                "%s@%s.%s",
                (string) $this->username,
                (string) $this->domain,
                (string) $this->tld
            )
        );
    }

    /**
     * Return the Username part for the e-mail address.
     */
    public function getUsername(): Str
    {
        return $this->username;
    }

    /**
     * Return the Domain part for the e-mail address.
     */
    public function getDomain(): Str
    {
        return $this->domain;
    }

    /**
     * Return the Top Level Domain part for the e-mail address.
     */
    public function getTld(): Str
    {
        return $this->tld;
    }
}
