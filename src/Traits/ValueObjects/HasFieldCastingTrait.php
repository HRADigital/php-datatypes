<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Traits\ValueObjects;

/**
 * Gives Field Casting capabilities to Value Object's
 *
 * If you extend directly AbstractValueObject, you'll already be inheriting this functionality.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   Proprietary
 */
trait HasFieldCastingTrait
{
    /** Sets the Casting Mutator method's prefix. */
    private static $CASTPREFIX = 'cast';

     /** @var array $castList - Instance's record initial mutators, used to set a given value into an Attribute. */
    private array $castList = [];

    /**
     * Loads a list of already mapped Field values into the Value Object's state.
     *
     * @param  array $fields - List of mapped Fields to be loaded.
     * @return void
     */
    private function castAttributesInitialValues(array $fields): void
    {
        // Loops through all the supplied Field's list.
        foreach ($fields as $field => $value) {

            // Builds up the Mutator's name.
            $mutator = $this->createMutatorName(self::$CASTPREFIX, $field);

            // Checks if the mutator exists in the instance, and if so, loads the value into it.
            if (\array_search($mutator, $this->castList) !== false) {
                $this->{$mutator}($value);
            }
        }
    }

    /**
     * Creates and returns a mutator's method name, based on the supplied Prefix and Field's name.
     *
     * @param  string $prefix - Prefix used in mutator's name.
     * @param  string $field  - Name of the Field used as reference for the Mutator's name creation.
     * @return string
     */
    final protected function createMutatorName(string $prefix, string $field): string
    {
        return ($prefix . \str_replace('_', '', \ucwords($field, '_')));
    }

    /**
     * Loads a list of casting mutator methods, available within the Instance for processing.
     *
     * @return void
     */
    private function loadAttributeCastingList(): void
    {
        // Loops through all the class' methods, and loads the necessary ones in
        // the corresponding containers.
        foreach (\get_class_methods($this) as $method) {

            // Loads casting mutators.
            if (\strpos($method, self::$CASTPREFIX) === 0 && \strlen($method) > \strlen(self::$CASTPREFIX)) {
                $this->castList[] = $method;
            }
        }
    }
}
