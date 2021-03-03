<?php declare(strict_types=1);

namespace Hradigital\Datatypes\Web;

/**
 * E-mail address datatype.
 *
 * Datatype class to hold and validate a single E-mail address value, as
 * an E-mail address is a complex field, with a very specific set of rules.
 *
 * @package   Hradigital\Datatypes
 * @license   MIT
 */
class EmailAddress implements \Serializable
{
    /** @var string $username - Holds the Username's part of the E-mail address. */
    protected string $username;

    /** @var string $domain - Holds the Domain part of the E-mail address. */
    protected string $domain;

    /** @var string $tld - Holds the Top Level Domain part of the E-mail address. */
    protected string $tld;

    /**
     * Loads a new EmailAddress instance from a native string.
     *
     * @param  string $email - E-mail address used to initialize instance.
     *
     * @return EmailAddress
     */
    public static function fromString(string $email): EmailAddress
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
        $this->loadInitialState($email);
    }

    /**
     * Loads supplied $email address string representation into the class.
     *
     * @param  string $email - String representation of the e-mail.
     *
     * @throws \InvalidArgumentException - If the supplied email address is empty or invalid.
     * @return void
     */
    private function loadInitialState(string $email): void
    {
        // Validate supplied parameter.
        if (\strlen(\trim($email)) === 0) {
            throw new \InvalidArgumentException("Supplied e-mail address must be a non empty string.");
        }
        if (!\filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException("Provided e-mail field does not seam to be a valid e-mail address.");
        }

        // Sanitizes and processes supplied e-mail address.
        $email = \strtolower(\trim($email));
        $parts = \explode('@', $email);
        $this->username = $parts[0];

        // Processes the right side of the e-mail address.
        $domain = \explode('.', $parts[1]);
        $this->tld    = \array_pop($domain);
        $this->domain = \implode('.', $domain);
    }

    /**
     * {@inheritDoc}
     * @see \Serializable::serialize()
     */
    public function serialize()
    {
        return \serialize($this->address());
    }

    /**
     * {@inheritDoc}
     * @see \Serializable::unserialize()
     */
    public function unserialize($serialized)
    {
        $this->loadInitialState(
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
        return $this->address();
    }

    /**
     * Returns a string representation for the Email address.
     *
     * @return string
     */
    public function address(): string
    {
        return ($this->username . '@' . $this->domain . '.' . $this->tld);
    }

    /**
     * Return the Username part for the e-mail address.
     *
     * @return string
     */
    public function username(): string
    {
        return $this->username;
    }

    /**
     * Return the Domain part for the e-mail address.
     *
     * @return string
     */
    public function domain(): string
    {
        return $this->domain;
    }

    /**
     * Return the Top Level Domain part for the e-mail address.
     *
     * @return string
     */
    public function tld(): string
    {
        return $this->tld;
    }
}
