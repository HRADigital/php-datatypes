<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Traits\ValueObjects;

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

    /** @var array $onLoadEvents - List of onLoad event handlers, defined as closures. */
    private array $onLoadEvents = [];

    /**
     * Triggers all onLoad pre-declared events.
     *
     * @return void
     */
    private function triggerOnLoad(): void
    {
        foreach ($this->onLoadEvents as $onLoad) {
            $this->$onLoad();
        }
    }

    private function registerOnLoadEvents(): void
    {
        // Loops through all the class' methods, and loads the necessary ones in
        // the corresponding containers.
        foreach (\get_class_methods($this) as $method) {
            if (\strpos($method, self::$ONLOADPREFIX) === 0 && \strlen($method) > \strlen(self::$ONLOADPREFIX)) {
                $this->onLoadEvents[] = $method;
            }
        }
    }
}
