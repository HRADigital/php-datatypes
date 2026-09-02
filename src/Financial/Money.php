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

use InvalidArgumentException;
use JsonSerializable;

use function abs;
use function number_format;
use function preg_match;
use function sprintf;
use function str_pad;
use function substr;
use function trim;

use const STR_PAD_LEFT;
use const STR_PAD_RIGHT;

/**
 * Monetary amount value object.
 *
 * Immutable. The amount is always carried as an integer number of the currency's minor
 * units (cents) - never a float, never a decimal string. Decimal representations only
 * exist at the edges, through fromDecimal()/toDecimal().
 *
 * Designed to be expanded/compressed at persistence boundaries: a caller stores the two
 * parts as two columns - a BIGINT holding the minor units, plus the currency code - and
 * rehydrates a Money on read with fromScalars(). Validation is intentionally minimal -
 * callers enforce their own rules (allowed currencies, sign, ceilings) at their own boundary.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 */
final readonly class Money implements JsonSerializable
{
    public function __construct(
        public readonly int $amount,
        public readonly Currency $currency,
    ) {
    }

    /**
     * Rehydrates from the two persisted scalar columns.
     */
    public static function fromScalars(int $amount, string $currency): self
    {
        return new self($amount, Currency::from($currency));
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            amount:   (int) ($data['amount'] ?? 0),
            currency: Currency::from((string) ($data['currency'] ?? '')),
        );
    }

    /**
     * Builds from a decimal representation, e.g. "12.34". Extra decimal places beyond the
     * currency's minor units are truncated, never rounded.
     */
    public static function fromDecimal(string $amount, Currency $currency): self
    {
        $trimmed = trim($amount);
        $matches = [];

        if (preg_match('/^([+-]?)(\d+)(?:\.(\d+))?$/', $trimmed, $matches) !== 1) {
            throw new InvalidArgumentException(sprintf('Invalid decimal amount: "%s".', $amount));
        }

        $units    = $currency->minorUnits();
        $fraction = str_pad(substr($matches[3] ?? '', 0, $units), $units, '0', STR_PAD_RIGHT);
        $minor    = (int) ($matches[2] . $fraction);

        return new self($matches[1] === '-' ? -$minor : $minor, $currency);
    }

    /**
     * Builds from a float amount, e.g. 12.34. The float is formatted to the currency's
     * minor units before conversion, avoiding binary floating-point rounding artifacts.
     */
    public static function fromFloat(float $amount, Currency $currency): self
    {
        return self::fromDecimal(number_format($amount, $currency->minorUnits(), '.', ''), $currency);
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function getCurrency(): Currency
    {
        return $this->currency;
    }

    public function getCurrencyCode(): string
    {
        return $this->currency->value;
    }

    /**
     * Emits the decimal representation, e.g. "12.34". Always carries the currency's full
     * number of decimal places.
     */
    public function toDecimal(): string
    {
        $units    = $this->currency->minorUnits();
        $sign     = $this->amount < 0 ? '-' : '';
        $absolute = (string) abs($this->amount);

        if ($units === 0) {
            return $sign . $absolute;
        }

        $padded = str_pad($absolute, $units + 1, '0', STR_PAD_LEFT);

        return $sign . substr($padded, 0, -$units) . '.' . substr($padded, -$units);
    }

    public function isEmpty(): bool
    {
        return $this->amount === 0;
    }

    public function equals(self $other): bool
    {
        return $this->amount === $other->amount
            && $this->currency === $other->currency;
    }

    /**
     * @return array{amount: int, currency: string}
     */
    public function toArray(): array
    {
        return [
            'amount'   => $this->amount,
            'currency' => $this->currency->value,
        ];
    }

    /**
     * @return array{amount: int, currency: string}
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
