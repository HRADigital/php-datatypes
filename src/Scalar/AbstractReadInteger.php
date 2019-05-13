<?php
namespace Hradigital\Datatypes\Scalar;

/**
 * Abstract Read Integer's Scalar Object class.
 *
 * Use this class is used as a base for all integer-like scalar datatypes.
 *
 * @package   Hradigital\Datatypes
 * @copyright Hugo Rafael Azevedo <github@hradigital.com>
 * @author    Hugo Rafael Azevedo <github@hradigital.com>
 * @license   MIT
 * @since     1.0.0
 */
abstract class AbstractReadInteger
{
    /**
     * Returns the <b>maximum</i> integer allowed in the system.
     *
     * @since  1.0.0
     * @return int
     */
    public static function max(): int
    {
        return PHP_INT_MAX;
    }

    /**
     * Returns the <b>minimum</i> integer allowed in the system.
     *
     * @since  1.0.0
     * @return int
     */
    public static function min(): int
    {
        return PHP_INT_MIN;
    }

    /**
     * @var integer $value - Internal integer value for the instance.
     */
    protected $value = 0;

    /**
     * Initializes a new instance of an <i>Integer</i>.
     *
     * @param  integer $value - Initial integer value.
     *
     * @since  1.0.0
     * @return void
     */
    protected function __construct(int $value)
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
     * @return int
     */
    public function value(): int
    {
        return $this->value;
    }

    /**
     * Compares two Integer instances, and return <b>TRUE</b> if supplied instance is bigger.
     *
     * @param  AbstractReadInteger $compare - Integer instance to compare to.
     *
     * @since  1.0.0
     * @return bool
     */
    public function isBigger(AbstractReadInteger $compare): bool
    {
        return ($compare->value() > $this->value);
    }

    /**
     * Compares two Integer instances, and return <b>TRUE</b> if supplied instance is smaller.
     *
     * @param  AbstractReadInteger $compare - Integer instance to compare to.
     *
     * @since  1.0.0
     * @return bool
     */
    public function isSmaller(AbstractReadInteger $compare): bool
    {
        return ($compare->value() < $this->value);
    }

    /**
     * Compares two Integer instances, and return <b>TRUE</b> if supplied instance is equal.
     *
     * @param  AbstractReadInteger $compare - Integer instance to compare to.
     *
     * @since  1.0.0
     * @return bool
     */
    public function equals(AbstractReadInteger $compare): bool
    {
        return ($compare->value() === $this->value);
    }

    /**
     * Returns <b>TRUE</b> if instance contains a negative value.
     *
     * @since  1.0.0
     * @return bool
     */
    public function isNegative(): bool
    {
        return ($this->value < 0);
    }
}
