<?php declare(strict_types=1);

namespace Hradigital\Datatypes\Aggregates;

/**
 * Abstract Base Aggregate class.
 *
 * Extend this base Aggregate class, in your implementation Aggregate classes.
 *
 * This will add shared common functionality to all Aggregates, without code repetition.
 *
 * @package   Hradigital\Datatypes
 * @license   MIT
 */
abstract class AbstractBaseAggregate implements \JsonSerializable
{
    /**
     * {@inheritDoc}
     *
     * @link http://www.php.net/manual/en/jsonserializable.jsonserialize.php
     * @see  \JsonSerializable::jsonSerialize()
     */
    public function jsonSerialize(): array
    {
        // Collects all Aggregate's attributes.
        $attributes = \get_object_vars($this);

        // Fills in returned array.
        $json = [];
        foreach ($attributes as $name => $value) {

            // If the Attribute's value is json serializable itself,
            // serialize and add it to the returning array.
            // Otherwize, return its holding value.
            if ($value instanceof \JsonSerializable) {
                $json[$name] = $value->jsonSerialize();
            } elseif (\method_exists($value, '__toString')) {
                $json[$name] = $value->__toString();
            } else {
                $json[$name] = $value;
            }
        }

        return $json;
    }
}
