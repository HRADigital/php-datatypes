<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Traits\Entities\General;

/**
 * Gives Publishing with timestamps capabilities to an Entity.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 * @todo      Finish up Trait, when Datetime datatype is finished.
 */
trait HasPublishedTimestampsTrait
{
    protected $published_from = null;

    protected $published_to = null;
}
