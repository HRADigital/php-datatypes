<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Traits\Entities;

use Closure;

/**
 * Gives onUpdate event handling capabilities to class.
 *
 * To register an new handler for the onUpdate event, use $this->onUpdate(function() { $this->someCall() });
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   Proprietary
 */
trait CanProcessOnUpdateEventsTrait
{
    /** @var array $onUpdateEvents - List of onUpdate event handlers, defined as closures. */
    private array $onUpdateEvents = [];

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

    /**
     * Adds a new onUpdate event handler to the class.
     *
     * @param  Closure $handler - Closure that will be triggered onUpdate.
     * @return void
     */
    protected function onUpdate(Closure $handler): void
    {
        $this->onUpdateEvents[] = $handler;
    }
}
