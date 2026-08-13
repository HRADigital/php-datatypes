<?php

/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at https://mozilla.org/MPL/2.0/.
 *
 * Copyright (c) HRADigital - Hugo Rafael Azevedo.
 */

declare(strict_types=1);

namespace HraDigital\Datatypes\Financial;

/**
 * ISO 4217 currency. The backing value is the three letter alphabetic code, which is
 * what a caller persists next to the amount.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 */
enum Currency: string
{
    case AOA = 'AOA';
    case AUD = 'AUD';
    case BRL = 'BRL';
    case CAD = 'CAD';
    case CHF = 'CHF';
    case CNY = 'CNY';
    case CVE = 'CVE';
    case CZK = 'CZK';
    case DKK = 'DKK';
    case EUR = 'EUR';
    case GBP = 'GBP';
    case HKD = 'HKD';
    case INR = 'INR';
    case JPY = 'JPY';
    case MXN = 'MXN';
    case MZN = 'MZN';
    case NOK = 'NOK';
    case NZD = 'NZD';
    case PLN = 'PLN';
    case SEK = 'SEK';
    case SGD = 'SGD';
    case USD = 'USD';
    case ZAR = 'ZAR';

    /**
     * Number of decimal places the currency's minor unit carries. It is the exponent
     * Money uses to convert between its integer minor units and a decimal string.
     */
    public function minorUnits(): int
    {
        return match ($this) {
            self::JPY => 0,
            default   => 2,
        };
    }

    public function getCode(): string
    {
        return $this->value;
    }
}
