<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Web;

use HraDigital\Datatypes\Exceptions\Datatypes\InvalidEmailException;
use HraDigital\Datatypes\Exceptions\Datatypes\NonEmptyStringException;
use HraDigital\Datatypes\Scalar\VoString;

/**
 * E-mail address datatype.
 *
 * Datatype class to hold and validate a single E-mail address value, as
 * an E-mail address is a complex field, with a very specific set of rules.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
class EmailAddress implements \Serializable
{
    /** @var VoString $username - Holds the Username's part of the E-mail address. */
    protected VoString $username;

    /** @var VoString $domain - Holds the Domain part of the E-mail address. */
    protected VoString $domain;

    /** @var VoString $tld - Holds the Top Level Domain part of the E-mail address. */
    protected VoString $tld;

    /**
     * Loads a new EmailAddress instance from a native string.
     *
     * @param  string $email - E-mail address used to initialize instance.
     * @return EmailAddress
     */
    public static function create(string $email): EmailAddress
    {
        return new EmailAddress($email);
    }

    /**
     * Initializes a new instance of an E-mail address.
     *
     * @param  string $email - String representation of the e-mail address.
     *
     * @throws \InvalidArgumentException - If the supplied email address is empty or invalid.
     * @return void
     */
    protected function __construct(string $email)
    {
        $this->loadFromPrimitive($email);
    }

    /**
     * Loads supplied $email address string representation into the class.
     *
     * @param  string $email - String representation of the e-mail.
     *
     * @throws \InvalidArgumentException - If the supplied email address is empty or invalid.
     * @return void
     */
    protected function loadFromPrimitive(string $email): void
    {
        // Converts supplied primitive to VoString.
        $voEmail = VoString::create($email)->trim()->toLower();

        // Validate supplied parameter.
        if ($voEmail->length() === 0) {
            throw new NonEmptyStringException('$email');
        }
        if (!\filter_var((string) $email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidEmailException($email);
        }

        // Sanitizes and processes supplied e-mail address.
        $parts = \explode('@', (string) $voEmail);
        $this->username = VoString::create($parts[0]);

        // Processes the right side of the e-mail address.
        $domain = \explode('.', $parts[1]);
        $this->tld    = VoString::create(\array_pop($domain));
        $this->domain = VoString::create(\implode('.', $domain));
    }

    /**
     * {@inheritDoc}
     * @see \Serializable::serialize()
     */
    public function serialize()
    {
        return \serialize(
            (string) $this->address()
        );
    }

    /**
     * {@inheritDoc}
     * @see \Serializable::unserialize()
     */
    public function unserialize($serialized)
    {
        $this->loadFromPrimitive(
            \unserialize($serialized)
        );
    }

    /**
     * Returns the String representation of the object.
     *
     * @return string
     */
    public function __toString(): string
    {
        return (string) $this->address();
    }

    /**
     * Returns a string representation for the Email address.
     *
     * @return string
     */
    public function address(): VoString
    {
        return VoString::create(
            \sprintf(
                "%s@%s.%s",
                (string) $this->username,
                (string) $this->domain,
                (string) $this->tld
            )
        );
    }

    /**
     * Return the Username part for the e-mail address.
     *
     * @return string
     */
    public function username(): VoString
    {
        return $this->username;
    }

    /**
     * Return the Domain part for the e-mail address.
     *
     * @return string
     */
    public function domain(): VoString
    {
        return $this->domain;
    }

    /**
     * Return the Top Level Domain part for the e-mail address.
     *
     * @return string
     */
    public function tld(): VoString
    {
        return $this->tld;
    }
}
