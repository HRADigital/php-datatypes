<?php
namespace Hradigital\Datatypes\Scalar;

/**
 * Abstract Read Boolean's Scalar Object class.
 *
 * Use this class is used as a base for all boolean-like scalar datatypes.
 *
 * @package   Hradigital\Datatypes
 * @copyright Hugo Rafael Azevedo <github@hradigital.com>
 * @author    Hugo Rafael Azevedo <github@hradigital.com>
 * @license   MIT
 * @since     1.0.0
 */
abstract class AbstractReadBoolean
{
    /**
     * @var boolean $value - Internal boolean value for the instance.
     */
    protected $value = true;

    /**
     * Initializes a new instance of a <i>Boolean</i>.
     *
     * @param  bool $value - Initial boolean value.
     *
     * @since  1.0.0
     * @return void
     */
    protected function __construct(bool $value)
    {
        $this->value = $value;
    }

    /**
     * Magic method that will print out the native string representation of the instance.
     *
     * @since  1.0.0
     * @return string
     */
    public function __toString(): string
    {
        return ($this->value ? 'true' : 'false');
    }

    /**
     * Compares two Boolean instances, and return <b>TRUE</b> if supplied instance is equal.
     *
     * @param  AbstractReadBoolean $compare - Boolean instance to compare to.
     *
     * @since  1.0.0
     * @return bool
     */
    public function equals(AbstractReadBoolean $compare): bool
    {
        return $compare->equalsNative($this->value);
    }

    /**
     * Compares instance's value, with the supplied native value, and returns <b>TRUE</b> if equal.
     *
     * @param  bool $value - Boolean native value to compare to.
     *
     * @since  1.0.0
     * @return bool
     */
    public function equalsNative(bool $value): bool
    {
        return ($value === $this->value);
    }
}
