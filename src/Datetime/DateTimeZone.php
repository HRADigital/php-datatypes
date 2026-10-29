<?php

/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at https://mozilla.org/MPL/2.0/.
 *
 * Copyright (c) HRADigital - Hugo Rafael Azevedo.
 */

declare(strict_types=1);

namespace HraDigital\Datatypes\Datetime;

/**
 * DateTimeZone utility class.
 *
 * Extends the native class: DateTime and DateTimeImmutable hand a timezone they receive to the
 * native \DateTimeImmutable they hold, so it has to BE a \DateTimeZone. A standalone class of the
 * same name would only shadow the native one, and blow up the moment it reached the native object.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 * @link      http://carbon.nesbot.com/docs/
 * @link      http://php.net/manual/en/timezones.php
 * @link      https://timezonedb.com/download
 */
class DateTimeZone extends \DateTimeZone
{
    /**
     * Whether both instances are the very same timezone.
     *
     * Compares the name, not the offset: 2 zones with the same offset today can follow
     * different daylight saving rules.
     */
    public function equals(self $other): bool
    {
        return $this->getName() === $other->getName();
    }
}
