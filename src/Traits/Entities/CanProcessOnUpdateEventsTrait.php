<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Traits\Entities;

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
 * @license   MIT
 */
trait CanProcessOnUpdateEventsTrait
{
    /** Sets the onUpdate Mutator method's prefix. */
    private static $ONUPDATEPREFIX = 'onUpdate';

    /** @var array $onUpdateEvents - List of onUpdate event handlers, defined as closures. */
    private array $onUpdateEvents = [];

    /**
     * Uses an onLoad() event handler, to load any onUpdate() methods available in the class.
     *
     * @return void
     */
    protected function onLoadRegisterOnUpdateEvents(): void
    {
        // Loops through all the class' methods, and loads the necessary ones in
        // the corresponding containers.
        foreach (\get_class_methods($this) as $method) {
            if (\strpos($method, self::$ONUPDATEPREFIX) === 0 && \strlen($method) > \strlen(self::$ONUPDATEPREFIX)) {
                $this->onUpdateEvents[] = $method;
            }
        }
    }

    /**
     * Triggers all onUpdate pre-declared events.
     *
     * @return void
     */
    protected function triggerOnUpdate(): void
    {
        foreach ($this->onUpdateEvents as $onUpdate) {
            $onUpdate();
        }
    }
}
