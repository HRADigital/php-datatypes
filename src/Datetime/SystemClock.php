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

use DateTimeImmutable as NativeDateTimeImmutable;
use Psr\Clock\ClockInterface;

/**
 * PSR-20 clock that reads the system time, in the default timezone.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 * @link      https://www.php-fig.org/psr/psr-20/
 */
final class SystemClock implements ClockInterface
{
    public function now(): NativeDateTimeImmutable
    {
        return new NativeDateTimeImmutable('now');
    }
}
