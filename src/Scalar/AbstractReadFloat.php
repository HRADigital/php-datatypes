<?php
namespace Hradigital\Datatypes\Scalar;

/**
 * Abstract Read Float's Scalar Object class.
 *
 * Use this class is used as a base for all float-like scalar datatypes.
 *
 * @package   Hradigital\Datatypes
 * @copyright Hugo Rafael Azevedo <github@hradigital.com>
 * @author    Hugo Rafael Azevedo <github@hradigital.com>
 * @license   MIT
 * @since     1.0.0
 */
abstract class AbstractReadFloat
{
    /**
     * Returns the <b>maximum</i> float allowed in the system.
     *
     * @since  1.0.0
     * @return float
     */
    public static function max(): float
    {
        return PHP_FLOAT_MAX;
    }

    /**
     * Returns the <b>minimum</i> float allowed in the system.
     *
     * @since  1.0.0
     * @return float
     */
    public static function min(): float
    {
        return PHP_FLOAT_MIN;
    }

    /**
     * @var float $value - Internal float value for the instance.
     */
    protected $value = 0.0;

    /**
     * Initializes a new instance of a <i>Float</i>.
     *
     * @param  float $value - Initial float value.
     *
     * @since  1.0.0
     * @return void
     */
    protected function __construct(float $value)
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
        return $this->value;
    }

    /**
     * Returns the native value of the instance.
     *
     * @since  1.0.0
     * @return float
     */
    public function value(): float
    {
        return $this->value;
    }

    /**
     * Compares two Float instances, and return <b>TRUE</b> if supplied instance is bigger.
     *
     * @param  AbstractReadFloat $compare - Float instance to compare to.
     *
     * @since  1.0.0
     * @return bool
     */
    public function isBigger(AbstractReadFloat $compare): bool
    {
        return (
            $compare->isSmallerNative($this->value) ||
            $compare->equalsNative($this->value)
        );
    }

    /**
     * Compares instance's value, with the supplied native value, and returns <b>TRUE</b> if instance is bigger.
     *
     * @param  float $value - Float native value to compare to.
     *
     * @since  1.0.0
     * @return bool
     */
    public function isBiggerNative(float $value): bool
    {
        return ($this->value > $value);
    }

    /**
     * Compares two Float instances, and return <b>TRUE</b> if supplied instance is smaller.
     *
     * @param  AbstractReadFloat $compare - Float instance to compare to.
     *
     * @since  1.0.0
     * @return bool
     */
    public function isSmaller(AbstractReadFloat $compare): bool
    {
        return (
            $compare->isBiggerNative($this->value) ||
            $compare->equalsNative($this->value)
        );
    }

    /**
     * Compares instance's value, with the supplied native value, and returns <b>TRUE</b> if instance is smaller.
     *
     * @param  float $value - Float native value to compare to.
     *
     * @since  1.0.0
     * @return bool
     */
    public function isSmallerNative(float $value): bool
    {
        return ($this->value < $value);
    }

    /**
     * Compares two Float instances, and return <b>TRUE</b> if supplied instance is equal.
     *
     * @param  AbstractReadFloat $compare - Float instance to compare to.
     *
     * @since  1.0.0
     * @return bool
     */
    public function equals(AbstractReadFloat $compare): bool
    {
        return $compare->equalsNative($this->value);
    }

    /**
     * Compares instance's value, with the supplied native value, and returns <b>TRUE</b> if equal.
     *
     * @param  float $value - Float native value to compare to.
     *
     * @since  1.0.0
     * @return bool
     */
    public function equalsNative(float $value): bool
    {
        return ($this->value === $value);
    }

    /**
     * Returns <b>TRUE</b> if instance contains a negative value.
     *
     * @since  1.0.0
     * @return bool
     */
    public function isNegative(): bool
    {
        return ($this->value < 0.0);
    }
}
