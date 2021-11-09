<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Traits\ValueObjects;

use Closure;

/**
 * Gives onLoad event handling capabilities to class.
 *
 * To register an new handler for the onLoad event, use $this->onLoad(function() { $this->someCall() });
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   Proprietary
 */
trait CanProcessOnLoadEventsTrait
{
    /** @var array $onLoadEvents - List of onLoad event handlers, defined as closures. */
    private array $onLoadEvents = [];

    /**
     * Triggers all onLoad pre-declared events.
     *
     * @return void
     */
    protected function triggerOnLoad(): void
    {
        foreach ($this->onLoadEvents as $onLoad) {
            $onLoad();
        }
    }

    /**
     * Adds a new onLoad event handler to the class.
     *
     * @param  Closure $handler - Closure that will be triggered onLoad.
     * @return void
     */
    protected function onLoad(Closure $handler): void
    {
        $this->onLoadEvents[] = $handler;
    }
}
