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
 * Gives onLoad event handling capabilities to class.
 *
 * To register an new handler for the onLoad event, declare a protected method starting with "onLoad".
 *
 * onLoad() methods should only be called when instance is created by instantiation.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 */
trait CanProcessOnLoadEventsTrait
{
    /** @var string $ONLOADPREFIX - Sets the onLoad Mutator method's prefix. */
    private static string $ONLOADPREFIX = 'onLoad';

    /**
     * Triggers all onLoad pre-declared events.
     */
    private function triggerOnLoad(): void
    {
        // Loops through all the class' methods, and loads the necessary ones in
        // the corresponding containers.
        $allMethods = get_class_methods($this);
        foreach ($allMethods as $method) {
            if (strpos($method, self::$ONLOADPREFIX) === 0 && strlen($method) > strlen(self::$ONLOADPREFIX)) {
                $this->$method();
            }
        }
    }
}
