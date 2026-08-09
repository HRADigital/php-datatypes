<?php

/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at https://mozilla.org/MPL/2.0/.
 *
 * Copyright (c) HRADigital - Hugo Rafael Azevedo.
 */

declare(strict_types=1);

namespace HraDigital\Datatypes\ValueObjects\Traits;

use function get_class_methods;
use function strlen;
use function strpos;

/**
 * Gives Field Rule processing capabilities to Value Object's
 *
 * If you extend directly AbstractValueObject, you'll already be inheriting this functionality.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 */
trait HasRuleProcessingTrait
{
    /** @var string $RULEPREFIX - Sets the Rule processing method's prefix. */
    private static string $RULEPREFIX = 'rule';

    /** @var array<int, string> $ruleList - Value Object's record rules, executed any time attributes are set. */
    private array $ruleList = [];

    /**
     * Process any existing rules, defined in child Value Object's classes.
     *
     * @param  array<string, mixed> $fields - Array of Fields that require rule validation.
     * @return array<string, mixed>
     */
    final protected function processRules(array $fields): array
    {
        foreach ($this->ruleList as $method) {
            $fields = $this->$method($fields);
        }

        return $fields;
    }

    /**
     * Loads a list of rules and mutator methods, available within the Value Object for processing.
     */
    private function registerAttributeRuleList(): void
    {
        // Loops through all the class' methods, and loads the necessary ones in
        // the corresponding containers.
        foreach (get_class_methods($this) as $method) {
            // Loads mutators/setters and rules.
            if (strpos($method, self::$RULEPREFIX) === 0 && strlen($method) > strlen(self::$RULEPREFIX)) {
                $this->ruleList[] = $method;
            }
        }
    }
}
