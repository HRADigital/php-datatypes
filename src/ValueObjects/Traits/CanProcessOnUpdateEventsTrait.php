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
 * Gives onUpdate event handling capabilities to class.
 *
 * To register an new handler for the onUpdate event, declare a protected method starting with "onUpdate".
 *
 * When you Update the state of your object, you should also call triggerOnUpdate(), so that other fields
 * can react to the change.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MPL-2.0
 */
trait CanProcessOnUpdateEventsTrait
{
    /** @var string $ONUPDATEPREFIX - Sets the onUpdate Mutator method's prefix. */
    private static string $ONUPDATEPREFIX = 'onUpdate';

    /** @var array<int, string> $onUpdateEvents - List of onUpdate event handlers, defined as closures. */
    private array $onUpdateEvents = [];

    /**
     * Uses an onLoad() event handler, to load any onUpdate() methods available in the class.
     */
    protected function onLoadRegisterOnUpdateEvents(): void
    {
        // Loops through all the class' methods, and loads the necessary ones in
        // the corresponding containers.
        foreach (get_class_methods($this) as $method) {
            if (strpos($method, self::$ONUPDATEPREFIX) === 0 && strlen($method) > strlen(self::$ONUPDATEPREFIX)) {
                $this->onUpdateEvents[] = $method;
            }
        }
    }

    /**
     * Triggers all onUpdate pre-declared events.
     */
    protected function triggerOnUpdate(): void
    {
        foreach ($this->onUpdateEvents as $onUpdate) {
            $this->$onUpdate();
        }
    }
}
