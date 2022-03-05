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
    const ATOM = \DateTimeInterface::ATOM;
    const COOKIE = \DateTimeInterface::COOKIE;
    const ISO8601 = \DateTimeInterface::ISO8601;
    const RFC822 = \DateTimeInterface::RFC822;
    const RFC850 = \DateTimeInterface::RFC850;
    const RFC1036 = \DateTimeInterface::RFC1036;
    const RFC1123 = \DateTimeInterface::RFC1123;
    const RFC7231 = \DateTimeInterface::RFC7231;
    const RFC2822 = \DateTimeInterface::RFC2822;
    const RFC3339 = \DateTimeInterface::RFC3339;
    const RFC3339_EXTENDED = \DateTimeInterface::RFC3339_EXTENDED;
    const RSS = \DateTimeInterface::RSS;
    const W3C = \DateTimeInterface::W3C;
}
