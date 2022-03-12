<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Traits\ValueObjects;

/**
 * Implements a \JsonSerializable that will collect all class attributes and returns them.
 *
 * This Trait can be added to classes that do not extend AbstractValueObject class.
 * AbstractValueObject class will already do this for you.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
trait CanSerializeAllToJsonTrait
{
    /**
     * @link http://www.php.net/manual/en/jsonserializable.jsonserialize.php
     * @see  \JsonSerializable::jsonSerialize()
     */
    public function jsonSerialize(): \stdClass
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
            } elseif (\is_object($value) && \method_exists($value, '__toString')) {
                $json[$name] = (string) $value;
            } else {
                $json[$name] = $value;
            }
        }

        return (object) $json;
    }
}
