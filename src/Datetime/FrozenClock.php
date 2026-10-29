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
 * PSR-20 clock that always gives the same instant. Meant for tests.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 * @link      https://www.php-fig.org/psr/psr-20/
 */
final readonly class FrozenClock implements ClockInterface
{
    public function __construct(private NativeDateTimeImmutable $now)
    {
    }

    public function now(): NativeDateTimeImmutable
    {
        return $this->now;
    }
}
