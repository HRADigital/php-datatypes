<?php

namespace HraDigital\Datatypes\ValueObjects;

use HraDigital\Datatypes\Exceptions\Entities\RequiredEntityValueMissingException;
use HraDigital\Datatypes\Exceptions\Entities\UnexpectedEntityValueException;
use HraDigital\Datatypes\Traits\ValueObjects\CanProcessOnLoadEventsTrait;
use HraDigital\Datatypes\Traits\ValueObjects\HasConversionToPrimitiveValuesTrait;
use HraDigital\Datatypes\Traits\ValueObjects\HasFieldCastingTrait;
use HraDigital\Datatypes\Traits\ValueObjects\HasGuardedFieldsTrait;
use HraDigital\Datatypes\Traits\ValueObjects\HasMappedFieldsTrait;
use HraDigital\Datatypes\Traits\ValueObjects\HasRequiredFieldsTrait;
use HraDigital\Datatypes\Traits\ValueObjects\HasRuleProcessingTrait;
use Serializable;

/**
 * Abstract Base Value Object class for all Domain Entities.
 *
 * Implementation Value Objects should not need to call parent __construct() method, but they
 * should implement casting and rule processing methods.
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
abstract class AbstractValueObject implements \JsonSerializable, Serializable
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
    protected function loadInstance(array $fields): void
    {
        // Configures Value Object's instance.
        $this->loadUsableFields();
        $this->loadAttributeCastingList();
        $this->loadAttributeRuleList();

        // Translates supplied fields, into existing ones.
        $mapped = $this->translateToMappedFields($fields);

        // Validates and loads supplied data into class.
        $mapped = $this->processRules($mapped);
        $this->validateRequired($mapped);
        $this->castAttributesInitialValues($mapped);
    }

    /**
     * Loads a list of usable attributes, that can hold state in the Value Object.
     *
     * @return void
     */
    private function loadUsableFields(): void
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
            $attrs['attributeList'],
            $attrs['onLoadEvents']
        );

        return $attrs;
    }

    /**
     * Retrieves a list containing all Value Object's fields.
     *
     * Returns an associative array containing all the fields from the Value Object.
     *
     * Arrays will be returned as JSON.
     *
     * Other objects will either be returned as their string representation, or they will
     * be serialized.
     *
     * Primitive types, or unserializable objects, will be returned in their current form.
     *
     * @return array
     */
    public function getAttributes(): array
    {
        // Collects a list of usable Attributes from the Value Object.
        $fields = $this->filterSystemControlFields(
            \get_object_vars($this)
        );

        // Converts all objects into primitives.
        return $this->convertIntoPrimitiveValues($fields);
    }

    /** @inheritDoc */
    public function serialize(): string
    {
        return \serialize(
            $this->getAttributes()
        );
    }

    /** @inheritDoc */
    public function unserialize($serialized): void
    {
        $this->loadInstance(
            \unserialize($serialized)
        );
    }

    /**
     * {@inheritDoc}
     *
     * @link http://www.php.net/manual/en/jsonserializable.jsonserialize.php
     * @see  \JsonSerializable::jsonSerialize()
     */
    public function jsonSerialize(): \stdClass
    {
        return (object) $this->removeGuardedFields(
            $this->getAttributes()
        );
    }
}
