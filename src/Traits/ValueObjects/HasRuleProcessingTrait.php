<?php

declare(strict_types=1);

namespace HraDigital\Datatypes\Traits\ValueObjects;

/**
 * Gives Field Rule processing capabilities to Value Object's
 *
 * If you extend directly AbstractValueObject, you'll already be inheriting this functionality.
 *
 * @package   HraDigital\Datatypes
 * @copyright HraDigital\Datatypes
 * @license   MIT
 */
trait HasRuleProcessingTrait
{
    /** Sets the Rule processing method's prefix. */
    private static $RULEPREFIX = 'rule';

    /** @var array $ruleList - Value Object's record rules, executed any time attributes are set. */
    private array $ruleList = [];

    /**
     * Process any existing rules, defined in child Value Object's classes.
     *
     * @param  array $fields - Array of Fields that require rule validation.
     * @return array
     */
    final protected function processRules(array $fields): array
    {
        foreach ($this->ruleList as $method) {
            $fields = $this->$method($fields);
        }

        return $fields;
    }

    /**
     * Loads a list of rules and mutator methods, available within the Value Object for processing.
     *
     * @return void
     */
    private function loadAttributeRuleList(): void
    {
        // Loops through all the class' methods, and loads the necessary ones in
        // the corresponding containers.
        foreach (\get_class_methods($this) as $method) {

            // Loads mutators/setters and rules.
            if (\strpos($method, self::$RULEPREFIX) === 0 && \strlen($method) > \strlen(self::$RULEPREFIX)) {
                $this->ruleList[] = $method;
            }
        }
    }
}
