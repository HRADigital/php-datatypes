<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\ValueObjects\Traits;

/**
 * Gives onLoad event handling capabilities to class.
 *
 * To register an new handler for the onLoad event, declare a protected method starting with "onLoad".
 *
 * onLoad() methods should only be called when instance is created by instantiation.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
trait CanProcessOnLoadEventsTrait
{
    /** Sets the onLoad Mutator method's prefix. */
    private static $ONLOADPREFIX = 'onLoad';

    /**
     * Triggers all onLoad pre-declared events.
     *
     * @return void
     */
    private function triggerOnLoad(): void
    {
        // Loops through all the class' methods, and loads the necessary ones in
        // the corresponding containers.
        $allMethods = \get_class_methods($this);
        foreach ($allMethods as $method) {
            if (\strpos($method, self::$ONLOADPREFIX) === 0 && \strlen($method) > \strlen(self::$ONLOADPREFIX)) {
                $this->$method();
            }
        }
    }
}
