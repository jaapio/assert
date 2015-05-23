<?php
/**
 * This file is part of bovigo\assert.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace bovigo\assert\predicate;
/**
 * Predicate to test that something is equal.
 *
 * This class can compare any scalar value with an expected value. The
 * value to test has to be of the same type and should have the same
 * content as the expected value.
 */
class Equals extends Predicate
{
    /**
     * the expected password
     *
     * @type  string
     */
    private $expected = null;

    /**
     * constructor
     *
     * @param   scalar|null  $expected
     * @throws  \InvalidArgumentException
     */
    public function __construct($expected)
    {
        if (!is_scalar($expected) && null != $expected) {
            throw new \InvalidArgumentException(
                    'Can only compare scalar values and null.'
            );
        }

        $this->expected = $expected;
    }

    /**
     * test that the given value is eqal in content and type to the expected value
     *
     * @param   scalar|null  $value
     * @return  bool         true if value is equal to expected value, else false
     */
    public function test($value)
    {
        return $this->expected === $value;
    }
}