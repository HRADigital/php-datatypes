<?php declare(strict_types=1);

namespace Hradigital\Datatypes\Traits\Datatypes\EmailAddress;

use Hradigital\Datatypes\Datatypes\EmailAddress;

/**
 * Static querying methods for E-mail Address' Adapter class.
 *
 * This Trait is only meant to be used by the E-mail Address datatype.
 *
 * @package   Hradigital\Datatypes
 * @copyright Hradigital\Datatypes
 * @license   Proprietary
 */
trait HasStaticFactoryMethodsTrait
{
    /**
     * Returns a new EmailAddress instance, based on the supplied string.
     *
     * @param  string $email - String representation of the EmailAddress.
     *
     * @return EmailAddress
     */
    public static function fromString(string $email): EmailAddress
    {
        return new EmailAddress($email);
    }
}
