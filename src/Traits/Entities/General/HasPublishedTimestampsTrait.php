<?php declare(strict_types=1);

namespace Hradigital\Datatypes\Traits\Entities\General;

/**
 * Gives Publishing with timestamps capabilities to an Entity.
 *
 * @package   Hradigital\Datatypes
 * @copyright Hradigital\Datatypes
 * @license   Proprietary
 * @todo      Finish up Trait, when Datetime datatype is finished.
 */
trait HasPublishedTimestampsTrait
{
    protected $published_from = null;

    protected $published_to = null;
}
