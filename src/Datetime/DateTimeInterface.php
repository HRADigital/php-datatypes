<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Datetime;

/**
 * DateTimeInterface contract.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 * @link      https://www.php.net/manual/en/class.datetimeinterface.php
 */
interface DateTimeInterface
{
    const string ATOM = \DateTimeInterface::ATOM;
    const string COOKIE = \DateTimeInterface::COOKIE;
    const string ISO8601 = \DateTimeInterface::ISO8601;
    const string RFC822 = \DateTimeInterface::RFC822;
    const string RFC850 = \DateTimeInterface::RFC850;
    const string RFC1036 = \DateTimeInterface::RFC1036;
    const string RFC1123 = \DateTimeInterface::RFC1123;
    const string RFC7231 = \DateTimeInterface::RFC7231;
    const string RFC2822 = \DateTimeInterface::RFC2822;
    const string RFC3339 = \DateTimeInterface::RFC3339;
    const string RFC3339_EXTENDED = \DateTimeInterface::RFC3339_EXTENDED;
    const string RSS = \DateTimeInterface::RSS;
    const string W3C = \DateTimeInterface::W3C;

    /* Methods
    public diff ( DateTimeInterface $targetObject , bool $absolute = false ) : DateInterval
    public format ( string $format ) : string
    public getOffset ( ) : int
    public getTimestamp ( ) : int
    public getTimezone ( ) : DateTimeZone|false
    public __wakeup ( ) : void
    */
}
