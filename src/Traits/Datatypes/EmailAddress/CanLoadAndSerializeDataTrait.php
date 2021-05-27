<?php declare(strict_types=1);

namespace Hradigital\Datatypes\Traits\Datatypes\EmailAddress;

use Hradigital\Datatypes\Exceptions\Datatypes\InvalidEmailException;
use Hradigital\Datatypes\Exceptions\Datatypes\NonEmptyStringException;

/**
 * Serialization dedicated methods use in the E-mail Addresses datatypes.
 *
 * This Trait is only meant to be used by the E-mail Address datatype.
 *
 * @package   Hradigital\Datatypes
 * @copyright Hradigital\Datatypes
 * @license   Proprietary
 */
trait CanLoadAndSerializeDataTrait
{
    /** @var string $username - Holds the Username's part of the E-mail address. */
    protected string $username;

    /** @var string $domain - Holds the Domain part of the E-mail address. */
    protected string $domain;

    /** @var string $tld - Holds the Top Level Domain part of the E-mail address. */
    protected string $tld;

    /**
     * Loads supplied $email address string representation into the class.
     *
     * @param  string $email - String representation of the e-mail.
     *
     * @throws NonEmptyStringException - If the supplied email address is empty.
     * @throws InvalidEmailException   - If the supplied email address is invalid.
     *
     * @return void
     */
    private function loadEmail(string $email): void
    {
        // Validate supplied parameter.
        if (\strlen(\trim($email)) === 0) {
            throw new NonEmptyStringException();
        }

        if (!\filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidEmailException();
        }

        // Sanitizes and processes supplied e-mail address.
        $email = \strtolower(\trim($email));
        $parts = \explode('@', $email);
        $this->username = $parts[0];

        // Processes the right side of the e-mail address.
        $host = \explode('.', $parts[1]);
        $this->tld    = \array_pop($host);
        $this->domain = \implode('.', $host);
    }

    /**
     * Serializes the contents of the class.
     *
     * @return string
     *
     * {@inheritDoc}
     * @see \Serializable::serialize()
     */
    public function serialize()
    {
        return \serialize($this->__toString());
    }

    /**
     * Unserializes back the contents of the class.
     *
     * @return void
     *
     * {@inheritDoc}
     * @see \Serializable::unserialize()
     */
    public function unserialize($serialized)
    {
        $this->loadEmail(
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
        return ($this->username . '@' . $this->domain . '.' . $this->tld);
    }
}
