<?php
/**
 * This file is part of bovigo\assert.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
use function bovigo\assert\assert;
use function bovigo\assert\predicate\equals;
use function bovigo\assert\predicate\isFalse;
use function bovigo\assert\predicate\isInstanceOf;
use function bovigo\assert\predicate\isNotEqualTo;
use function bovigo\assert\predicate\isNotInstanceOf;
use function bovigo\assert\predicate\isNotNull;
use function bovigo\assert\predicate\isNotSameAs;
use function bovigo\assert\predicate\isNull;
use function bovigo\assert\predicate\isTrue;
use function bovigo\assert\predicate\isSameAs;
/**
 * asserts that two values are equal
 *
 * @param   mixed   $expected      expected value
 * @param   mixed   $actual        value to test
 * @param   string  $message       optional  additional description for failure message
 * @param   float   $delta         optional  allowed numerical distance between two values to consider them equal
 * @return  bool
 */
function assertEquals($expected, $actual, $message = null, $delta = 0.0)
{
    return assert($actual, equals($expected, $delta), $message);
}

/**
 * asserts that two values are not equal
 *
 * @param   mixed   $expected      expected value
 * @param   mixed   $actual        value to test
 * @param   string  $message       optional  additional description for failure message
 * @param   float   $delta         optional  allowed numerical distance between two values to consider them equal
 * @return  bool
 */
function assertNotEquals($expected, $actual, $message = null, $delta = 0.0)
{
    return assert($actual, isNotEqualTo($expected, $delta), $message);
}

/**
 * asserts that given value is false
 *
 * @param   mixed   $value    value to test
 * @param   string  $message  optional  additional description for failure message
 * @return  bool
 */
function assertFalse($value, $message = null)
{
    return assert($value, isFalse(), $message);
}

/**
 * asserts that given value is an instance of the expected type
 *
 * @param   string  $expectedType  name of expected type
 * @param   mixed   $actual        value to test
 * @param   string  $message       optional  additional description for failure message
 * @return  bool
 */
function assertInstanceOf($expectedType, $actual, $message = null)
{
    return assert($actual, isInstanceOf($expectedType), $message);
}

/**
 * asserts that given value is not an instance of the expected type
 *
 * @param   string  $expectedType  name of expected type
 * @param   mixed   $actual        value to test
 * @param   string  $message       optional  additional description for failure message
 * @return  bool
 */
function assertNotInstanceOf($expectedType, $actual, $message = null)
{
    return assert($actual, isNotInstanceOf($expectedType), $message);
}

/**
 * asserts that given value is null
 *
 * @param   mixed   $value    value to test
 * @param   string  $message  optional  additional description for failure message
 * @return  bool
 */
function assertNull($value, $message = null)
{
    return assert($value, isNull(), $message);
}

/**
 * asserts that given value is not null
 *
 * @param   mixed   $value    value to test
 * @param   string  $message  optional  additional description for failure message
 * @return  bool
 */
function assertNotNull($value, $message = null)
{
    return assert($value, isNotNull(), $message);
}

/**
 * asserts that both expected and actual reference the same value
 *
 * @param   mixed   $expected  expected value
 * @param   mixed   $actual    value to test
 * @param   string  $message   optional  additional description for failure message
 * @return  bool
 */
function assertSame($expected, $actual, $message = null)
{
    return assert($actual, isSameAs($expected), $message);
}

/**
 * asserts that both expected and actual do not reference the same value
 *
 * @param   mixed   $expected  expected value
 * @param   mixed   $actual    value to test
 * @param   string  $message   optional  additional description for failure message
 * @return  bool
 */
function assertNotSame($expected, $actual, $message = null)
{
    return assert($actual, isNotSameAs($expected), $message);
}

/**
 * asserts that given value is true
 *
 * @param   mixed   $value        value to test
 * @param   string  $description  optional  additional description for failure message
 * @return  bool
 */
function assertTrue($value, $description = null)
{
    return assert($value, isTrue(), $description);
}

/**
 * evaluates predicate agains value
 *
 * @param    mixed                                        $value     value to test
 * @param    \bovigo\assert\predicate\Predicate|callable  $expected  predicate or callable to test given value
 * @param    string                                       $message   optional  additional description for failure message
 * @return   bool
 */
function assertThat($value, $expected, $message = null)
{
    return assert($value, $expected, $message);
}