<?php
namespace Hradigital\Datatypes\Web;

/**
 * E-mail address datatype.
 *
 * Datatype class to hold and validate a single E-mail address value, as
 * an E-mail address is a complex field, with a very specific set of rules.
 *
 * @package   Hradigital\Datatypes
 * @copyright Hugo Rafael Azevedo <github@hradigital.com>
 * @author    Hugo Rafael Azevedo <github@hradigital.com>
 * @license   MIT
 * @since     1.0.0
 */
class EmailAddress implements \Serializable
{
    /**
     * Loads a new EmailAddress instance from a native string.
     *
     * @param  string $email - E-mail address used to initialize instance.
     *
     * @since  1.0.0
     * @return EmailAddress
     */
    public function fromString(string $email): EmailAddress
    {
        return new EmailAddress($email);
    }

    /**
     * @var string $username - Holds the Username's part of the E-mail address.
     */
    protected $username = null;

    /**
     * @var string $domain - Holds the Domain part of the E-mail address.
     */
    protected $domain = null;

    /**
     * @var string $tld - Holds the Top Level Domain part of the E-mail address.
     */
    protected $tld = null;

    /**
     * Initializes a new instance of an E-mail address.
     *
     * @param  string $email - String representation of the e-mail address.
     *
     * @throws \InvalidArgumentException - If the supplied email address is empty or invalid.
     *
     * @since  1.0.0
     * @return void
     */
    protected function __construct(string $email)
    {
        // Loads data into class.
        $this->loadEmail($email);
    }

    /**
     * Loads supplied $email address string representation into the class.
     *
     * @param  string $email - String representation of the e-mail.
     *
     * @throws \InvalidArgumentException - If the supplied email address is empty or invalid.
     *
     * @since  1.0.0
     * @return void
     */
    private function loadEmail(string $email): void
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
     * Serializes the contents of the class.
     *
     * @since  1.0.0
     * @return string
     *
     * {@inheritDoc}
     * @see \Serializable::serialize()
     */
    public function serialize()
    {
        return \serialize($this->address());
    }

    /**
     * Unserializes back the contents of the class.
     *
     * @since  1.0.0
     * @return void
     *
     * {@inheritDoc}
     * @see \Serializable::unserialize()
     */
    public function unserialize($serialized)
    {
        // Loads unserialized data back to the class.
        $this->loadEmail(
            \unserialize($serialized)
        );
    }

    /**
     * Returns the String representation of the object.
     *
     * @since  1.0.0
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
     * @since  1.0.0
     * @return string
     */
    public function address(): string
    {
        return ($this->username . '@' . $this->domain . '.' . $this->tld);
    }

    /**
     * Return the Username part for the e-mail address.
     *
     * @since  1.0.0
     * @return string
     */
    public function username(): string
    {
        return $this->username;
    }

    /**
     * Return the Domain part for the e-mail address.
     *
     * @since  1.0.0
     * @return string
     */
    public function domain(): string
    {
        return $this->domain;
    }

    /**
     * Return the Top Level Domain part for the e-mail address.
     *
     * @since  1.0.0
     * @return string
     */
    public function tld(): string
    {
        return $this->tld;
    }
}
