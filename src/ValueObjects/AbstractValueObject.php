<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\ValueObjects;

use HraDigital\Datatypes\Collections\Linear\EntityCollection;
use HraDigital\Datatypes\Exceptions\Entities\RequiredEntityValueMissingException;
use HraDigital\Datatypes\Exceptions\Entities\UnexpectedEntityValueException;
use HraDigital\Datatypes\ValueObjects\Traits\CanProcessOnLoadEventsTrait;
use HraDigital\Datatypes\ValueObjects\Traits\HasConversionToPrimitiveValuesTrait;
use HraDigital\Datatypes\ValueObjects\Traits\HasFieldCastingTrait;
use HraDigital\Datatypes\ValueObjects\Traits\HasGuardedFieldsTrait;
use HraDigital\Datatypes\ValueObjects\Traits\HasMappedFieldsTrait;
use HraDigital\Datatypes\ValueObjects\Traits\HasRequiredFieldsTrait;
use HraDigital\Datatypes\ValueObjects\Traits\HasRuleProcessingTrait;

/**
 * Abstract Base Value Object class for all Domain Entities/Value Objects.
 *
 * Implementation Value Objects should also provide documented getters() for all class
 * attributes/fields, as well as provide the appropriate accessibility for all attributes.
 *
 * Not all Value Object's attributes need to have their own getter() method associated with them.
 * Getters should be created for the accessible values from outside the object, and they can
 * have a different (more readable) name assigned to them.
 *
 * All class attributes should be defined with a 'protected' visibility, in order for future
 * child classes to override them. Accessor methods should have a 'public' visibility.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
abstract class AbstractValueObject implements \JsonSerializable
{
    use HasMappedFieldsTrait,
        HasRuleProcessingTrait,
        HasRequiredFieldsTrait,
        HasFieldCastingTrait,
        HasGuardedFieldsTrait,
        HasConversionToPrimitiveValuesTrait,
        CanProcessOnLoadEventsTrait;

    /** @var array $attributeList - Value Object's data attribute's list */
    private array $attributeList = [];

    /**
     * Initializes the Abstract Value Object.
     *
     * Loaded parameter should be an associative array, containing the list of
     * fields to be loaded into the Value Object class.
     *
     * @param  array $fields - List of fields to be loaded into the class.
     *
     * @throws RequiredEntityValueMissingException - If any of the required fields are missing.
     * @throws UnexpectedEntityValueException      - If some of the supplied fields are invalid.
     *
     * @return void
     */
    public function __construct(array $fields)
    {
        $this->loadInstance($fields);
        $this->triggerOnLoad();
    }

    /**
     * Loads instance's state, either on instanciation, or de-serialization.
     *
     * @param  array $fields - List of fields to be loaded into the class.
     *
     * @throws RequiredEntityValueMissingException - If any of the required fields are missing.
     * @throws UnexpectedEntityValueException      - If some of the supplied fields are invalid.
     * @return void
     */
    private function loadInstance(array $fields): void
    {
        // Configures Value Object's instance.
        $this->registerUsableFields();
        $this->registerAttributeCastingList();
        $this->registerAttributeRuleList();

        // Translates supplied fields, into existing ones.
        $mapped = $this->translateToMappedFields($fields);

        // Validates and loads supplied data into class.
        $mapped = $this->processRules($mapped);
        $this->validateRequired($mapped);
        $this->castAttributes($mapped);
    }

    /**
     * Loads a list of usable attributes, that can hold state in the Value Object.
     *
     * @return void
     */
    private function registerUsableFields(): void
    {
        $this->attributeList = $this->filterSystemControlFields(
            \get_object_vars($this)
        );
    }

    /**
     * Filters system fields from supplied array, and returns it.
     *
     * @param  array $attrs - Array of fields to be filtered.
     * @return array
     */
    private function filterSystemControlFields(array $attrs): array
    {
        unset(
            $attrs['maps'],
            $attrs['guarded'],
            $attrs['required'],
            $attrs['ruleList'],
            $attrs['castList'],
            $attrs['attributeList']
        );

        return $attrs;
    }

    /**
     * Retrieves a list containing all Value Object's fields.
     *
     * Returns an associative array containing all the fields from the Value Object.
     * Nested Value Objects (records) will be included as a nested associative array.
     * Datatype Value Objects will be converted to their primitive representation.
     *
     * @return array
     */
    public function toArray(): array
    {
        // Collects a list of usable Attributes from the Value Object.
        $fields = $this->filterSystemControlFields(
            \get_object_vars($this)
        );

        // Converts all objects into primitives.
        return $this->convertIntoPrimitiveValues($fields);
    }

    /**
     * Retrieves a list containing all Value Object's fields.
     *
     * Returns an associative array only containing fields which belong directly to record.
     * Nested Value Objects will not be returned.
     * Datatype Value Objects will be converted to their primitive representation.
     *
     * @return array
     */
    public function getAttributes(): array
    {
        // Collects a list of usable Attributes from the Value Object.
        $fields = $this->filterSystemControlFields(
            \get_object_vars($this)
        );

        foreach ($fields as $name => $value) {
            if ($value instanceof AbstractValueObject || $value instanceof EntityCollection) {
                unset($fields[$name]);
            }
        }

        // Converts all objects into primitives.
        return $this->convertIntoPrimitiveValues($fields);
    }

    public function __serialize(): array
    {
        return $this->toArray();
    }

    public function __unserialize(array $data): void
    {
        $this->loadInstance($data);
    }

    /**
     * {@inheritDoc}
     *
     * @link http://www.php.net/manual/en/jsonserializable.jsonserialize.php
     * @see  \JsonSerializable::jsonSerialize()
     */
    public function jsonSerialize(): \stdClass
    {
        // Collects a list of usable Attributes from the Value Object.
        $fields = $this->filterSystemControlFields(
            \get_object_vars($this)
        );

        return (object) $this->removeGuardedFields(
            $this->convertIntoPrimitiveValues($fields, true)
        );
    }

    /**
     * This method is called by var_dump() when dumping an object to get the properties that should be shown.
     *
     * If the method isn't defined on an object, then all public, protected and private properties will be shown.
     *
     * Note: Might not work with xDebug.
     *
     * @link https://www.php.net/manual/en/language.oop5.magic.php#object.debuginfo
     * @return array
     */
    public function __debugInfo(): array
    {
        return $this->toArray();
    }
}
